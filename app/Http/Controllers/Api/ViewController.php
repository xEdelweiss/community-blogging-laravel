<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrackViewRequest;
use App\Models\Post;
use App\Services\ViewService\Viewable;
use App\Services\ViewService\ViewActionDto;
use App\Services\ViewService\ViewService;
use App\Services\ViewService\ViewType;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use ValueError;

class ViewController extends Controller
{
    private ViewService $viewService;
    private Repository $viewableCache;

    public function __construct(ViewService $viewService)
    {
        $this->viewService = $viewService;
        $this->viewableCache = cache()->store('array');
    }

    function track(TrackViewRequest $request)
    {
        $batch = $request->getBatch();
        $newActions = $batch->filter(
            fn (ViewActionDto $action) => !$this->viewService->wasRecentlyTracked($action)
        );


        $this->preloadViewables($newActions);

        $errors = [];
        $skipped = count($batch) - count($newActions);

        foreach ($newActions as $action) {
            try {
                $viewable = $this->getViewable($action);

                if ($action->user && $action->type === ViewType::View) {
                    $viewable->addUniqueView($action->user);
                }

                $viewable->incrementViewStat($action->type);
                $this->viewService->markRecentlyTracked($action);
            } catch (ModelNotFoundException) {
                $errors[] = "Entry [{$action->viewableType}] with id [{$action->viewableId}] not found";
            } catch (ValueError) {
                $errors[] = "Invalid action [{$action->type}] for entry [{$action->viewableType}] with id [{$action->viewableId}]";
            }
        }

        return response()->json([
            'message' => $this->getResponseMessage($batch, $errors, $skipped),
            'errors' => $errors,
        ], $errors ? 400 : 200);
    }

    private function preloadViewables(Collection $actions): void
    {
        $idToCacheKeyByType = $actions
            ->groupBy(fn(ViewActionDto $action) => $action->viewableType)
            ->map(fn($group) => $group
                ->map(fn(ViewActionDto $action) => ['id' => $action->viewableId, 'key' => $action->getViewableKey()])
                ->pluck('key', 'id')
            )->toArray();

        foreach ($idToCacheKeyByType as $type => $idToCacheKey) {
            $ids = array_keys($idToCacheKey);

            $models = match ($type) {
                'post' => Post::withoutEagerLoads()->find($ids),
                default => throw new \InvalidArgumentException("Invalid viewable type [$type]"),
            };

            foreach ($models as $model) {
                $this->viewableCache->put($idToCacheKey[$model->getKey()], $model);
            }
        }
    }


    private function getViewable(ViewActionDto $action): Viewable
    {
        $result = $this->viewableCache->get($action->getViewableKey());

        if ($result === null) {
            throw new ModelNotFoundException();
        }

        return $result;
    }

    private function getResponseMessage(mixed $batch, array $errors, int $skipped): string
    {
        return match (true) {
            empty($batch) => 'No actions provided',
            count($batch) === count($errors) => 'All actions failed',
            count($batch) === $skipped => 'No actions required',
            empty($errors) => 'All actions were successful',
            default => 'Some actions failed',
        };
    }
}

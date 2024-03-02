<?php

namespace App\Http\Requests;

use App\Services\ViewService\ViewActionDto;
use App\Services\ViewService\ViewType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class TrackViewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'batch' => 'required|array',
            'batch.*.viewable_id' => 'required|integer',
            'batch.*.viewable_type' => 'required|string|in:post', // possible: profile
            'batch.*.action' => 'required|string|in:' . implode(',', ViewType::values())
        ];
    }

    /** @return Collection<ViewActionDto> */
    public function getBatch(): Collection
    {
        return collect($this->validated('batch'))
            ->map(fn($item) => new ViewActionDto(
                $item['viewable_type'],
                $item['viewable_id'],
                ViewType::from($item['action']),
                $this->user(),
                $this->ip()
            ));
    }
}

<?php

namespace App\Providers;

use App\Services\PostService\Editor\Extensions\Heading;
use App\Services\PostService\Editor\Extensions\Instagram;
use App\Services\PostService\Editor\Extensions\Reddit;
use App\Services\PostService\Editor\Extensions\Telegram;
use App\Services\PostService\Editor\Extensions\Twitter;
use App\Services\PostService\Editor\Extensions\Vimeo;
use App\Services\PostService\Editor\Extensions\Youtube;
use App\Services\PostService\Editor\PostEditor;
use Illuminate\Support\ServiceProvider;
use Tiptap\Extensions\StarterKit;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            PostEditor::class,
            function () {
                return new PostEditor([
                    'extensions' => [
                        new StarterKit([
                            'heading' => false,
                        ]),
                        new Heading(),
                        new Instagram(),
                        new Reddit(),
                        new Telegram(),
                        new Twitter(),
                        new Vimeo(),
                        new Youtube(),
                    ]
                ]);
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

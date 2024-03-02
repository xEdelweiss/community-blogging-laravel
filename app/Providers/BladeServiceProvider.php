<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('l10n', function () {
            $locale = app()->getLocale();
            $file = lang_path($locale . '.json');
            $translations = file_get_contents($file);

            return sprintf(
                "<script>window.l10n = %s;\nwindow.__ = %s</script>",
                '<?php echo file_get_contents(lang_path(app()->getLocale() . ".json")); ?>',
                "function (key, replace = {}) {
                    let translation = window.l10n[key] || ('__NO_TRANS:' + key + '__');

                    for (let placeholder in replace) {
                        translation = translation.replace(':' + placeholder, replace[placeholder]);
                    }

                    return translation;
                }"
            );
        });
    }
}

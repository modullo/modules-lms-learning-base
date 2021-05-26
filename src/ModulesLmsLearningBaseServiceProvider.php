<?php

namespace Lms\ModulesLmsLearningBase;

use Illuminate\Support\ServiceProvider;

class ModulesLmsLearningBaseServiceProvider  extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'modules-lms-learning-base');

        $this->publishes([
            __DIR__.'/resources/carousel' => public_path('LearningBase'),
        ], 'learning-assets');

        $this->publishes([
            __DIR__.'/resources/js/' => resource_path('js/vendor/modules-lms-learning-base')
        ],'lms-vue');
        $this->publishes([
            __DIR__.'/config/navigation-settings.php' => config_path('navigation-menu.php')
        ],'menu-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/navigation-settings.php', 'navigation-menu'
        );
    }
}

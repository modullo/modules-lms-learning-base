<?php

namespace Modullo\ModulesLmsLearningBase;

use Illuminate\Support\ServiceProvider;

class ModulesLmsLearningBaseServiceProvider  extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'modules-lms-learning-base');

        $this->publishes([
            __DIR__.'/resources/owl-carousel' => public_path('owl-carousel'),
        ], 'modullo-modules');

        $this->publishes([
            __DIR__.'/resources/learning' => public_path('vendor/learning'),
        ], 'modullo-modules');

        $this->publishes([
            __DIR__.'/resources/js/app/' => public_path('/'),
        ], 'modullo-modules');

        // $this->publishes([
        //     __DIR__.'/resources/js/' => resource_path('js/vendor/modules-lms-learning-base')
        // ],'modullo-modules');

        $this->publishes([
            __DIR__.'/resources/js' => public_path('vendor/modules-lms-learning-base'),
        ], 'modullo-modules');

        $this->publishes([
            __DIR__.'/config/modules-lms-learning-base.php' => config_path('modules-lms-learning-base.php')
        ],'modullo-modules');

        $this->publishes([
            __DIR__.'/config/scheduler.php' => config_path('scheduler.php')
        ],'modullo-modules');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/navigation-menu.php', 'modullo-navigation-menu.modules-lms-learning-base'
        );
    }
}

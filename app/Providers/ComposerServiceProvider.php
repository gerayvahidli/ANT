<?php

namespace App\Providers;


use App\ProgramType;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
//use View;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(
            ['frontend.components.leftNavigation', 'frontend.components.rightMenu', 'frontend.profile.partials.programApplicationAndTrackingPanel'],
            'App\Http\ViewComposers\LeftNavigationComposer@compose'
        );

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
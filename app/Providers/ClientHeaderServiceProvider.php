<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ClientHeaderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //dd('hihis');
        view()->composer(
            [
                //'client.partials.header',
                //...more
                // '*' :view name - all views
            ],
            "Modules\Home\Http\ViewComposer\HeaderComposer", // class name
        );
    }
}

<?php

namespace App\Providers;

use App\Channel;
use App\Mode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $user = Auth::check() ? Auth::user() : null;

            $view->with('user', $user);
        });

        View::composer([
            'layouts.app', 'home', 'admin.words.create', 'admin.words.edit',
            'admin.competitions.create', 'admin.competitions.edit', 'admin.channels.create'
        ], function ($view) {
            $modes = Mode::all();
            $channels = Channel::all();

            $view->with(['modes' => $modes, 'channels' => $channels]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

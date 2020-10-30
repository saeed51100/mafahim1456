<?php

namespace App\Providers;
use App\Image;
use App\Post;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('posts', Post::orderBy('created_at', 'asc')->get());
//        View::share('image', Image::orderBy('created_at', 'asc')->get());


    }
}

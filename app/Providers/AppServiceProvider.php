<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Page;
use App\Models\Section;
use App\Models\Setting;
use App\Models\UsefullLink;

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
            //Admin layout.admin page
            View::composer('layouts/admin',function($view){
            $view->with([
            'pages'=>Page::all(),
            'categories'=>Category::all(),
            ]);
            });
            //Front layout.front page
            View::composer('*',function($view){
            $view->with([
            'setting'=>Setting::firstOrFail(),
            'sections'=>Section::where('is_active',1)->get(),
            ]);
            });

        }
}

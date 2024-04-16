<?php

namespace App\Providers;

use App\InstructorSetting;
use App\PromoBanner;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

         Blade::withoutDoubleEncoding();
         Paginator::useBootstrapThree();

//        Cache::forget('menu_categories');
        if(env('APP_CACHE')){
            $menu_categories = Cache::rememberForever('menu_categories', function () {
            return \App\LmsCategory::select(['id','category','image', 'icon','id','slug'])->with('products.accreditedby','products.reviews','children')->where('parent_id', '=', 0)->orderBy('category','ASC')->take(16)->get();
        });
        }else{
            $menu_categories= \App\LmsCategory::select(['category','icon','image','id','slug'])->with('products.accreditedby','products.reviews','children')->where('parent_id', '=', 0)->orderBy('category','ASC')->take(16)->get();

        }

        if(env('APP_CACHE')){
            $menu_currencies = Cache::rememberForever('menu_currencies', function () {
                return \App\Currencies::select(['id','currency_short','rate','currency_symbol','symbol_code'])->where('status', '=', 'Active')->orderBy('id','ASC')->get();
            });
        }else{
            $menu_currencies= \App\Currencies::select(['id','currency_short','rate','currency_symbol','symbol_code'])->where('status', '=', 'Active')->orderBy('id','ASC')->get();
        }



        $lms_allcats = $menu_categories;
        $isetting = InstructorSetting::first();
        $data['Promo']            =  PromoBanner::find(1);
        $data['menu_categories'] = $menu_categories;
        $data['menu_currencies'] = $menu_currencies;
        $data['lms_allcats'] = $lms_allcats;
        $data['isetting'] = $isetting;

        View::share($data);

        session(['currency_rate' => 1,'currency_short' => 'GBP','currency_symbol' => 'fas fa-pound-sign']);



        //View::share('menu_categories', app('menu_categories'));

//        view()->composer('*', function ($view)
//        {
//            $user = request()->user();
//
//           // $view->with('menu_categories', \App\LmsCategory::select(['category','id','slug'])->where('parent_id', '=', 0)->orderBy('category','ASC')->get());
//
//
//
//
//
//        });


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

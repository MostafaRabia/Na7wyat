<?php

namespace App\Providers;

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
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	if (env('APP_ENV')=='production'){
            \URL::forceScheme('https');
        }
        // Start indexArray
        $indexPath = 'public';
        $indexArray = [
            'css' => url($indexPath.'/styles/css'),
            'js' => url($indexPath.'/styles/js'),
            'image' => url($indexPath.'/images'),
            'users' => 'users',
            'admin' => 'admin',
            'panel' => 'panel'
        ];
        foreach ($indexArray as $Key => $Value){
            app()->singleton($Key,function() use ($Value){
                return $Value;
            });
        }
        // End indexArray
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

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

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
        Schema::defaultStringLength(191);
        $pengaturan = DB::table('pengaturan')->first();
        if($pengaturan == null){
            $nama = 'PAUD TERPADU MUSTIKA ILMU';
        }else{
            $nama = $pengaturan->nama;
        }
        View::share('sitename', $nama);
    }
}

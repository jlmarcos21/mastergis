<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

use App\Assignment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $assignments = Assignment::whereMonth('final_date', Carbon::now()->month)
        //                 ->whereYear('final_date', Carbon::now()->year)
        //                 ->where('poll', '=', '0')->get();

        // View::share('view_assignments', $assignments);
    }
}

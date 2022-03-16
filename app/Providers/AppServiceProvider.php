<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cake;
use Illuminate\Support\Facades\Auth;

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
        $year = date('Y');
        $month = 12;
        $day = 21;
        $start = $year . $month . $day;
        $date = mb_substr($start, -2);
        
        $week = [
        '日',
        '月',
        '火',
        '水',
        '木',
        '金',
        '土',
        ];

        $yamazaki_cakes = Cake::where('maker', '=', 'ヤマザキ')->get();
        $siraisi_cakes = Cake::where('maker', '=', 'シライシ')->get();
        $pasco_cakes = Cake::where('maker', '=', 'パスコ')->get();

        view()->share([
            'year' => $year,
            'date' => $date,
            'week' => $week,
            'start' => $start,
            'yamazaki_cakes' => $yamazaki_cakes,
            'siraisi_cakes' => $siraisi_cakes,
            'pasco_cakes' => $pasco_cakes
        ]);
    }
}

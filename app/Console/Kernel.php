<?php

namespace App\Console;

use App\Absensi;
use App\Pegawai;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $pegawai = Pegawai::all();
            $dateNow = Carbon::now()->format('Y-m-d');
            $now = Carbon::now()->format('d');

            foreach ($pegawai as $d) {
                $data = Absensi::where('pegawai_id', $d->id)->where('tanggal', $dateNow)->first();
                if ($data->izin == 3 && $data->sakit == 3 && $data->hadir == 3) {
                    $data->alfa = 1;
                    $data->status = 1;
                    $data->update();
                }
            }

        })->dailyAt('23:25')->timezone('Asia/Singapore');

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

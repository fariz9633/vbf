<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PwaMeetingsAttendanceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pwa_meetings_attendance')->delete();
        
        
        
    }
}
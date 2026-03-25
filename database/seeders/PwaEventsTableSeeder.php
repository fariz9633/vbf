<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PwaEventsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pwa_events')->delete();
        
        
        
    }
}
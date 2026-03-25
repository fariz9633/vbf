<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PwaReferalstatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pwa_referalstatus')->delete();
        
        \DB::table('pwa_referalstatus')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'New',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'In Progress',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Completed',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Closed',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
        ));
        
        
    }
}
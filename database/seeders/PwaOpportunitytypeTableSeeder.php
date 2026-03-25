<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PwaOpportunitytypeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pwa_opportunitytype')->delete();
        
        \DB::table('pwa_opportunitytype')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Business',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Partnership',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Investment',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Collaboration',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
        ));
        
        
    }
}
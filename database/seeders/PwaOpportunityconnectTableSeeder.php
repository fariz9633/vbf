<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PwaOpportunityconnectTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pwa_opportunityconnect')->delete();
        
        \DB::table('pwa_opportunityconnect')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Email',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:35',
                'updated_at' => '2025-12-04 19:03:35',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Phone',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:35',
                'updated_at' => '2025-12-04 19:03:35',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Meeting',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:35',
                'updated_at' => '2025-12-04 19:03:35',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Event',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:35',
                'updated_at' => '2025-12-04 19:03:35',
            ),
        ));
        
        
    }
}
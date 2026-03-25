<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PwaModulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pwa_modules')->delete();
        
        \DB::table('pwa_modules')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Dashboard',
                'icon' => 'home',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Users',
                'icon' => 'users',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Customers',
                'icon' => 'user',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Meetings',
                'icon' => 'calendar',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Documents',
                'icon' => 'file',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Opportunities',
                'icon' => 'briefcase',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Content',
                'icon' => 'edit',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Settings',
                'icon' => 'settings',
                'status' => '1',
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
        ));
        
        
    }
}
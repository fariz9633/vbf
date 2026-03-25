<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PwaAdminTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pwa_admin')->delete();
        
        \DB::table('pwa_admin')->insert(array (
            0 => 
            array (
                'admin_id' => 1,
                'name' => 'Admin',
                'email' => 'admin@vbf.com',
                'password' => 'admin123',
                'phone' => '9876543210',
                'image' => NULL,
                'status' => '1',
                'remember_token' => NULL,
                'created_at' => '2025-12-04 19:03:34',
                'updated_at' => '2025-12-04 19:03:34',
            ),
        ));
        
        
    }
}
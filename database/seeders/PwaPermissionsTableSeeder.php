<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PwaPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pwa_permissions')->delete();
        
        
        
    }
}
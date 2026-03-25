<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PwaDepartmentMemTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pwa_department_mem')->delete();
        
        
        
    }
}
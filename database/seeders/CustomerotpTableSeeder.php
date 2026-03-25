<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomerotpTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customerotp')->delete();
        
        
        
    }
}
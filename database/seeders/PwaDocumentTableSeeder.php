<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PwaDocumentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pwa_document')->delete();
        
        
        
    }
}
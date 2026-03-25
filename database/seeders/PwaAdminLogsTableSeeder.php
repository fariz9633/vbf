<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PwaAdminLogsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pwa_admin_logs')->delete();
        
        \DB::table('pwa_admin_logs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'adminid' => 1,
                'login' => '2025-12-04 19:53:35',
                'logout' => NULL,
                'ip' => '::1',
                'created_at' => '2025-12-04 19:53:36',
            ),
            1 => 
            array (
                'id' => 2,
                'adminid' => 1,
                'login' => '2025-12-09 12:14:21',
                'logout' => NULL,
                'ip' => '::1',
                'created_at' => '2025-12-09 12:14:22',
            ),
            2 => 
            array (
                'id' => 3,
                'adminid' => 1,
                'login' => '2025-12-09 13:10:23',
                'logout' => NULL,
                'ip' => '::1',
                'created_at' => '2025-12-09 13:10:23',
            ),
        ));
        
        
    }
}
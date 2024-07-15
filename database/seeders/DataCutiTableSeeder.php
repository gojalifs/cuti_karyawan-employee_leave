<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DataCutiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_cuti')->delete();
        
        \DB::table('data_cuti')->insert(array (
            0 => 
            array (
                'created_at' => '2024-07-16 01:38:16',
                'cuti_id' => 23,
                'id' => 9,
                'sisa' => 0,
                'updated_at' => '2024-07-16 01:38:16',
                'user_id' => 1,
            ),
            1 => 
            array (
                'created_at' => '2024-07-16 01:39:04',
                'cuti_id' => 10,
                'id' => 10,
                'sisa' => 11,
                'updated_at' => '2024-07-16 02:45:25',
                'user_id' => 2,
            ),
            2 => 
            array (
                'created_at' => '2024-07-16 01:39:04',
                'cuti_id' => 23,
                'id' => 11,
                'sisa' => 0,
                'updated_at' => '2024-07-16 01:39:04',
                'user_id' => 2,
            ),
            3 => 
            array (
                'created_at' => '2024-07-16 01:39:14',
                'cuti_id' => 10,
                'id' => 12,
                'sisa' => 7,
                'updated_at' => '2024-07-16 03:18:15',
                'user_id' => 6,
            ),
        ));
        
        
    }
}
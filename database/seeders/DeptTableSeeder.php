<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DeptTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dept')->delete();
        
        \DB::table('dept')->insert(array (
            0 => 
            array (
                'created_at' => '2024-07-11 10:23:24',
                'id' => 1,
                'nama_dept' => 'Mold',
                'updated_at' => '2024-07-11 10:23:24',
            ),
            1 => 
            array (
                'created_at' => '2024-07-11 10:44:20',
                'id' => 2,
                'nama_dept' => 'Coating',
                'updated_at' => '2024-07-11 10:44:20',
            ),
        ));
        
        
    }
}
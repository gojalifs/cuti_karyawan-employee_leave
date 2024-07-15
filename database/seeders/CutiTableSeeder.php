<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CutiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cuti')->delete();
        
        \DB::table('cuti')->insert(array (
            0 => 
            array (
                'created_at' => '2024-07-11 08:45:45',
                'id' => 10,
                'jumlah' => 12,
                'nama_cuti' => 'Tahunan',
                'satuan' => 'hari',
                'updated_at' => '2024-07-11 09:47:31',
            ),
            1 => 
            array (
                'created_at' => '2024-07-12 19:30:32',
                'id' => 23,
                'jumlah' => 90,
                'nama_cuti' => 'Melahirkan',
                'satuan' => 'hari',
                'updated_at' => '2024-07-12 19:30:32',
            ),
        ));
        
        
    }
}
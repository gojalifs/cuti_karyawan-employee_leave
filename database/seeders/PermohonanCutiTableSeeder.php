<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermohonanCutiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permohonan_cuti')->delete();
        
        \DB::table('permohonan_cuti')->insert(array (
            0 => 
            array (
                'alasan_cuti' => 'libur Akhir Tahun',
                'created_at' => '2024-07-11 01:05:37',
                'id' => 1,
                'jenis_cuti' => 10,
                'status' => 'disetujui',
                'tgl_akhir' => '2021-07-03',
                'tgl_mulai' => '2021-07-01',
                'updated_at' => '2024-07-11 01:05:37',
                'user_id' => 2,
            ),
            1 => 
            array (
                'alasan_cuti' => 'Istri Melahirkan',
                'created_at' => '2024-07-11 01:05:37',
                'id' => 2,
                'jenis_cuti' => 10,
                'status' => 'pending',
                'tgl_akhir' => '2021-07-06',
                'tgl_mulai' => '2021-07-01',
                'updated_at' => '2024-07-11 01:05:37',
                'user_id' => 2,
            ),
            2 => 
            array (
                'alasan_cuti' => 'Istri Melahirkan',
                'created_at' => '2024-07-11 01:05:37',
                'id' => 3,
                'jenis_cuti' => 10,
                'status' => 'ditolak',
                'tgl_akhir' => '2021-07-07',
                'tgl_mulai' => '2021-07-02',
                'updated_at' => '2024-07-11 01:05:37',
                'user_id' => 3,
            ),
            3 => 
            array (
                'alasan_cuti' => 'Menikah',
                'created_at' => '2024-07-11 01:05:37',
                'id' => 4,
                'jenis_cuti' => 10,
                'status' => 'disetujui',
                'tgl_akhir' => '2021-07-07',
                'tgl_mulai' => '2021-07-04',
                'updated_at' => '2024-07-11 01:05:37',
                'user_id' => 3,
            ),
            4 => 
            array (
                'alasan_cuti' => 'Liburan',
                'created_at' => '2024-07-11 01:05:37',
                'id' => 5,
                'jenis_cuti' => 10,
                'status' => 'pending',
                'tgl_akhir' => '2021-07-13',
                'tgl_mulai' => '2021-07-12',
                'updated_at' => '2024-07-11 01:05:37',
                'user_id' => 4,
            ),
            5 => 
            array (
                'alasan_cuti' => 'Liburan',
                'created_at' => '2024-07-11 01:05:37',
                'id' => 6,
                'jenis_cuti' => 10,
                'status' => 'ditolak',
                'tgl_akhir' => '2021-07-13',
                'tgl_mulai' => '2021-07-12',
                'updated_at' => '2024-07-11 01:05:37',
                'user_id' => 4,
            ),
            6 => 
            array (
                'alasan_cuti' => 'Saudara Meniggal',
                'created_at' => '2024-07-11 01:05:37',
                'id' => 7,
                'jenis_cuti' => 10,
                'status' => 'pending',
                'tgl_akhir' => '2021-07-17',
                'tgl_mulai' => '2021-07-15',
                'updated_at' => '2024-07-11 01:05:37',
                'user_id' => 3,
            ),
            7 => 
            array (
                'alasan_cuti' => 'Liburan',
                'created_at' => '2024-07-16 02:06:18',
                'id' => 8,
                'jenis_cuti' => 10,
                'status' => 'disetujui',
                'tgl_akhir' => '2024-07-16',
                'tgl_mulai' => '2024-07-16',
                'updated_at' => '2024-07-16 02:51:50',
                'user_id' => 6,
            ),
            8 => 
            array (
                'alasan_cuti' => 'p',
                'created_at' => '2024-07-16 03:17:57',
                'id' => 9,
                'jenis_cuti' => 10,
                'status' => 'disetujui',
                'tgl_akhir' => '2024-07-18',
                'tgl_mulai' => '2024-07-16',
                'updated_at' => '2024-07-16 03:18:15',
                'user_id' => 6,
            ),
        ));
        
        
    }
}
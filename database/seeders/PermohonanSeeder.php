<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permohonan_Cuti;



class PermohonanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permohonan = Permohonan_Cuti::create([
            'user_id' => 2,
            'alasan_cuti' => 'libur Akhir Tahun',
            'tgl_mulai' => '2021-07-01',
            'tgl_akhir' => '2021-07-03',
            'status' => 'disetujui'
        ]);
        
        $permohonan = Permohonan_Cuti::create([
            'user_id' => 2,
            'alasan_cuti' => 'Istri Melahirkan',
            'tgl_mulai' => '2021-07-01',
            'tgl_akhir' => '2021-07-06',
            'status' => 'pending'
        ]);
        
        $permohonan = Permohonan_Cuti::create([
            'user_id' => 3,
            'alasan_cuti' => 'Istri Melahirkan',
            'tgl_mulai' => '2021-07-02',
            'tgl_akhir' => '2021-07-07',
            'status' => 'ditolak'
        ]);
        
        $permohonan = Permohonan_Cuti::create([
            'user_id' => 3,
            'alasan_cuti' => 'Menikah',
            'tgl_mulai' => '2021-07-04',
            'tgl_akhir' => '2021-07-07',
            'status' => 'disetujui'
        ]);
        
        $permohonan = Permohonan_Cuti::create([
            'user_id' => 4,
            'alasan_cuti' => 'Liburan',
            'tgl_mulai' => '2021-07-12',
            'tgl_akhir' => '2021-07-13',
            'status' => 'pending'
        ]);
        
        $permohonan = Permohonan_Cuti::create([
            'user_id' => 4,
            'alasan_cuti' => 'Liburan',
            'tgl_mulai' => '2021-07-12',
            'tgl_akhir' => '2021-07-13',
            'status' => 'ditolak'
        ]);
        
        $permohonan = Permohonan_Cuti::create([
            'user_id' => 3,
            'alasan_cuti' => 'Saudara Meniggal',
            'tgl_mulai' => '2021-07-15',
            'tgl_akhir' => '2021-07-17',
            'status' => 'pending'
        ]);
    }
}

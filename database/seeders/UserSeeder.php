<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Putri',
            'email' => 'putri@example.com',
            'address' => 'Kalimalang',
            'phone' => '62898564433',
            'jumlah_cuti' => 30,
            'role' => 'Karyawan',
            'password' => Hash::make("putri"),
        ]);

        $user = User::create([
            'name' => 'Lya',
            'email' => 'lya@example.com',
            'address' => 'Cikarang',
            'phone' => '6289856534534',
            'jumlah_cuti' => 40,
            'role' => 'Karyawan',
            'password' => Hash::make("lya"),
        ]);

        // Super Admin

        $user = User::create([
            'name' => 'Nindi',
            'email' => 'nindi@example.com',
            'address' => 'Cikarang',
            'phone' => '628922334534',
            'jumlah_cuti' => 21,
            'password' => Hash::make("nindi"),
            'role' => 'Super Admin',
        ]);

        // staf Hr

        $user = User::create([
            'name' => 'Octa',
            'email' => 'octa@example.com',
            'address' => 'Bekasi',
            'phone' => '0983858344',
            'jumlah_cuti' => 12,
            'role' => 'Staf HR',
            'password' => Hash::make("octa"),
        ]);
    }
}

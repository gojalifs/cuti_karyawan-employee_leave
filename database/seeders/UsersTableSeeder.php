<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'address' => 'Kalimalang',
                'created_at' => '2024-07-11 01:05:37',
                'dept' => 1,
                'email' => 'putri@example.com',
                'email_verified_at' => '2024-07-11 01:05:37',
                'id' => 1,
                'name' => 'Putri',
                'password' => '$2y$10$MgUkJkWVbi.Z6Yeodao1q.alyRgTDRUjzH9RYWM.q3DC106TLtxbq',
                'phone' => '2333223',
                'remember_token' => NULL,
                'role' => 'karyawan',
                'updated_at' => '2024-07-11 01:05:37',
            ),
            1 => 
            array (
                'address' => 'Cikarang',
                'created_at' => '2024-07-11 01:05:37',
                'dept' => 1,
                'email' => 'lya@example.com',
                'email_verified_at' => '2024-07-11 01:05:37',
                'id' => 2,
                'name' => 'Lya',
                'password' => '$2y$10$Q09tMwox1IFe5Xh5EQeQfOfJgBqhH6DTcfGzU8sr4AnZz4llVd2zK',
                'phone' => '6289856534534',
                'remember_token' => NULL,
                'role' => 'karyawan',
                'updated_at' => '2024-07-11 01:05:37',
            ),
            2 => 
            array (
                'address' => 'Cikarang',
                'created_at' => '2024-07-11 01:05:37',
                'dept' => 1,
                'email' => 'nindi@example.com',
                'email_verified_at' => '2024-07-11 01:05:37',
                'id' => 3,
                'name' => 'Nindi',
                'password' => '$2y$10$mmqSyLitemx5YSoS/4cRye4TCHM13N0Fl3KoOy04lkFT/LXXc5Su.',
                'phone' => '628922334534',
                'remember_token' => NULL,
                'role' => 'Super Admin',
                'updated_at' => '2024-07-11 01:05:37',
            ),
            3 => 
            array (
                'address' => 'Bekasi',
                'created_at' => '2024-07-11 01:05:37',
                'dept' => 1,
                'email' => 'octa@example.com',
                'email_verified_at' => '2024-07-11 01:05:37',
                'id' => 4,
                'name' => 'Octa',
                'password' => '$2y$10$bPUiYhEHeYZ94kESIQtJTOExoMIf4ToukP1c0tYLJGNEF6rIJRb/G',
                'phone' => '0983858344',
                'remember_token' => NULL,
                'role' => 'Staf HR',
                'updated_at' => '2024-07-11 01:05:37',
            ),
            4 => 
            array (
                'address' => 'Nekasi',
                'created_at' => '2024-07-11 12:37:27',
                'dept' => 2,
                'email' => 'jono@example.com',
                'email_verified_at' => '2024-07-11 12:37:27',
                'id' => 5,
                'name' => 'Jono',
                'password' => '$2y$10$MMXytYwZ9TCTHGOL8ojIWO/dRviGkeHOK3BVjjGlHtQE3/J5jWqiG',
                'phone' => '1234567890',
                'remember_token' => NULL,
                'role' => 'karyawan',
                'updated_at' => '2024-07-11 12:37:27',
            ),
            5 => 
            array (
                'address' => 'Jakarta',
                'created_at' => '2024-07-16 01:27:04',
                'dept' => 1,
                'email' => 'fajar@example.com',
                'email_verified_at' => '2024-07-16 01:27:04',
                'id' => 6,
                'name' => 'FAJAR SIDIK PRASETIO',
                'password' => '$2y$10$21/G4z4Lst6PcHiseePTPuWjEt3PpxOxoP6KcB18WqLvHscQVG4qe',
                'phone' => '0473483943',
                'remember_token' => NULL,
                'role' => 'karyawan',
                'updated_at' => '2024-07-16 03:18:15',
            ),
        ));
        
        
    }
}
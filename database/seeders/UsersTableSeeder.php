<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use App\Models\Antrian;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role'  => 'perawat'
        ]);
        Role::create([
            'role'  => 'pasien'
        ]);
        Role::create([
            'role'  => 'admin'
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('aaaaaaaa'),
            'role_id' => 3, 
            'tgl_lahir' => '1980-01-01',
            'alamat' => 'Kantor',
            'jenis_kelamin' => 'laki-laki',
            'no_ktp' => '1234567890123456',
            'no_hp' => '081234567890',
            'pekerjaan' => 'Administrator',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Mbak Perawat',
            'email' => 'perawat@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('aaaaaaaa'),
            'role_id' => 1,
            'tgl_lahir' => '1995-05-15',
            'alamat' => 'Alamat e Mbak Perawat',
            'jenis_kelamin' => 'perempuan',
            'no_ktp' => '2345678901234567',
            'no_hp' => '082345678901',
            'pekerjaan' => 'Perawat',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Fitran',
            'email' => 'fitran@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('aaaaaaaa'),
            'role_id' => 2,
            'tgl_lahir' => '2000-08-13',
            'alamat' => 'Desa Gatak',
            'jenis_kelamin' => 'laki-laki',
            'no_ktp' => '1233216968547854',
            'no_hp' => '081564332794',
            'pekerjaan' => 'DJ',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $this->call([
            JadwalDokterSeeder::class,
        ]);
    }
}

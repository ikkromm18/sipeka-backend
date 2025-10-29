<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('555555'),
            'foto_ktp' => 'uploads/foto_ktp/default.jpg',
            'foto_kk' => 'uploads/foto_kk/default.jpg',
            'nik' => '3507123412341234',
            'no_kk' => '3507123412341235',
            'nama_kepala_keluarga' => 'Budi Santoso',
            'alamat' => 'Jl. Melati No. 10',
            'desa' => 'Karanganyar',
            'kecamatan' => 'Buaran',
            'kabupaten' => 'Pekalongan',
            'provinsi' => 'Jawa Tengah',
            'rt' => '02',
            'rw' => '04',
            'kode_pos' => '51171',
            'dusun' => 'Krajan',
            'nomor_hp' => '081234567890',
            'pekerjaan' => 'Karyawan Swasta',
            'tempat_lahir' => 'Pekalongan',
            'foto_profil' => 'uploads/foto_profile/default.jpg',
            'tgl_lahir' => '1998-05-14',
            'role' => 'User',
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Pastikan menggunakan hash
            'role' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //Panggil Seeder
        $this->call([
            JenisSuratSeeder::class,
            FieldSuratSeeder::class,
            // PengajuanSuratSeeder::class,
            SettingsSeeder::class
        ]);
    }
}

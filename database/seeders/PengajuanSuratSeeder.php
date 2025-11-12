<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengajuanSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat Data 
        $data = [
            [
                'nik' => '3507123412341234',
                'name' => 'Test User',
                'email' => 'test@example.com',
                'alamat' => 'Jl. Melati No. 10',
                'jenis_surat_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'nik' => '3507123412341234',
                'name' => 'Test User',
                'email' => 'test@example.com',
                'alamat' => 'Jl. Melati No. 10',
                'jenis_surat_id' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'nik' => '3507123412341234',
                'name' => 'Test User',
                'email' => 'test@example.com',
                'alamat' => 'Jl. Melati No. 10',
                'jenis_surat_id' => 3,
                'created_at' => Carbon::now(),
            ],
            [
                'nik' => '3507123412341234',
                'name' => 'Test User',
                'email' => 'test@example.com',
                'alamat' => 'Jl. Melati No. 10',
                'jenis_surat_id' => 4,
                'created_at' => Carbon::now(),
            ]
        ];

        // Masukkan Data
        DB::table('pengajuan_surats')->insert($data);
    }
}

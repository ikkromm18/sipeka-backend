<?php

namespace Database\Seeders;

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
                'name' => 'Muhammad Ikrom',
                'email' => 'muhammadikkrom749@gmail.com',
                'alamat' => 'pemalanag',
                'jenis_surat_id' => 1
            ]
        ];

        // Masukkan Data
        DB::table('pengajuan_surats')->insert($data);
    }
}

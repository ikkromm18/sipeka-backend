<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // 1
            [
                'nama_camat' => 'Drs. SYAMSUL DEWANTARA',
                'nip_camat' => '1234567890',
                'nomor_admin' => '6282134885973',
            ],




        ];

        DB::table('utilities')->insert($data);
    }
}

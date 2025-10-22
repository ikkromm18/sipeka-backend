<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            // 1
            [
                'nama_jenis' => 'Surat Pindah WNI antar Kecamatan',
                'kode_jenis' => 14,
                'template_surat' => 'templates/surat_pindah_wni_antar_kecamatan.docx',
            ],

            // 2
            [
                'nama_jenis' => 'Surat Pindah WNI antar Provinsi',
                'kode_jenis' => 99,
                'template_surat' => 'templates/surat_pindah_wni_antar_prov.docx',
            ],

            // 3
            [
                'nama_jenis' => 'Surat Dispen Nikah',
                'kode_jenis' => 181,
                'template_surat' => 'templates/surat_dispen_nikah.docx',
            ],
            // 4
            [
                'nama_jenis' => 'Surat Ijin Hajatan',
                'kode_jenis' => 33,
                'template_surat' => 'templates/surat_ijin_hajatan.docx',
            ],


        ];

        DB::table('jenis_surats')->insert($data);
    }
}

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
                'template_surat' => 'templates/surat_pindah_wni_antar_kecamatan.docx',
            ],

            // 2
            [
                'nama_jenis' => 'Surat Pindah WNI antar Provinsi',
                'template_surat' => 'templates/surat_pindah_wni_antar_prov.docx',
            ],

            // 3
            [
                'nama_jenis' => 'Surat Dispen Nikah',
                'template_surat' => 'templates/surat_dispen_nikah.docx',
            ],
            // 4
            [
                'nama_jenis' => 'Surat Ijin Hajatan',
                'template_surat' => 'templates/surat_ijin_hajatan.docx',
            ],


        ];

        DB::table('jenis_surats')->insert($data);
    }
}

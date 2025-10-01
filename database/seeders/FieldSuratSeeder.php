<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'Alasan Pindah',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'Alamat Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'RT Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'RW Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'Dusun Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'Desa Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'Kecamatan Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'Kabupaten Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'Provinsi Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'Kode Pos Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'No Hp Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'Jenis Kepindahan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'Status KK Bagi Yang Tidak Pindah',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'Status KK Bagi Yang Pindah',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'Keluarga Yang Pindah',
                'tipe_field' => 'text',
            ],
        ];

        DB::table('field_surats')->insert($data);
    }
}

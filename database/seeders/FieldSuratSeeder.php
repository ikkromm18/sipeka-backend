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
            // 1
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
                'nama_field' => 'Status Kk Bagi Yang Tidak Pindah',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'Status Kk Bagi Yang Pindah',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 1,
                'nama_field' => 'Keluarga Yang Pindah',
                'tipe_field' => 'text',
            ],
            // 2
            [
                'jenis_surat_id' => 2,
                'nama_field' => 'Alasan Pindah',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 2,
                'nama_field' => 'Alamat Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 2,
                'nama_field' => 'RT Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 2,
                'nama_field' => 'RW Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 2,
                'nama_field' => 'Dusun Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 2,
                'nama_field' => 'Desa Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 2,
                'nama_field' => 'Kecamatan Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 2,
                'nama_field' => 'Kabupaten Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 2,
                'nama_field' => 'Provinsi Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 2,
                'nama_field' => 'Kode Pos Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 2,
                'nama_field' => 'No Hp Tujuan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 2,
                'nama_field' => 'Jenis Kepindahan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 2,
                'nama_field' => 'Status Kk Bagi Yang Tidak Pindah',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 2,
                'nama_field' => 'Status Kk Bagi Yang Pindah',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 2,
                'nama_field' => 'Keluarga Yang Pindah',
                'tipe_field' => 'text',
            ],
            // 3
            [
                'jenis_surat_id' => 3,
                'nama_field' => 'Nomor Surat Desa',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 3,
                'nama_field' => 'Tanggal Surat',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 3,
                'nama_field' => 'Agama',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 3,
                'nama_field' => 'Status',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 3,
                'nama_field' => 'Nama Pasangan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 3,
                'nama_field' => 'Tempat Lahir Pasangan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 3,
                'nama_field' => 'Tanggal Lahir Pasangan',
                'tipe_field' => 'date',
            ],
            [
                'jenis_surat_id' => 3,
                'nama_field' => 'Agama Pasangan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 3,
                'nama_field' => 'Pekerjaan Pasangan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 3,
                'nama_field' => 'Status Pasangan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 3,
                'nama_field' => 'Alamat Pasangan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 3,
                'nama_field' => 'RT Pasangan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 3,
                'nama_field' => 'RW Pasangan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 3,
                'nama_field' => 'Tempat Pernikahan',
                'tipe_field' => 'text',
            ],
            // 4
            [
                'jenis_surat_id' => 4,
                'nama_field' => 'Hari Hajatan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 4,
                'nama_field' => 'Tanggal Hajatan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 4,
                'nama_field' => 'Acara',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 4,
                'nama_field' => 'Hiburan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 4,
                'nama_field' => 'Lokasi Hajatan',
                'tipe_field' => 'text',
            ],
            [
                'jenis_surat_id' => 4,
                'nama_field' => 'Waktu',
                'tipe_field' => 'text',
            ],
        ];

        DB::table('field_surats')->insert($data);
    }
}

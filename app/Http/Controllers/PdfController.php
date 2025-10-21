<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function cetak($id)
    {
        $pengajuan = PengajuanSurat::with([
            'User',
            'JenisSurats',
            'DataPengajuans.FieldSurats'
        ])->findOrFail($id);

        // 1️⃣ Tentukan path template Word
        $templatePath = public_path('storage/' . $pengajuan->JenisSurats->template_surat);
        if (!file_exists($templatePath)) {
            return response()->json(['error' => 'Template tidak ditemukan'], 404);
        }

        // 2️⃣ Load template
        $templateProcessor = new TemplateProcessor($templatePath);

        // Isi field dasar dari pengajuan
        $templateProcessor->setValue('nama', $pengajuan->name);
        $templateProcessor->setValue('nik', $pengajuan->nik);
        $templateProcessor->setValue('email', $pengajuan->email);
        $templateProcessor->setValue('status', $pengajuan->status);

        // tetap
        $templateProcessor->setValue('kode_provinsi', '33');
        $templateProcessor->setValue('nama_provinsi', 'JAWA TENGAH');
        $templateProcessor->setValue('kode_kabupaten', '27');
        $templateProcessor->setValue('nama_kabupaten', 'PEMALANG');
        $templateProcessor->setValue('kode_kecamatan', '2016');
        $templateProcessor->setValue('nama_kecamatan', 'PETARUKAN');
        $templateProcessor->setValue('desa', $pengajuan->user->desa);
        $templateProcessor->setValue('dusun', $pengajuan->user->dusun);



        // Isi field daerah asal (dari user)
        if ($pengajuan->user) {
            $templateProcessor->setValue('no_kk', $pengajuan->user->no_kk);
            $templateProcessor->setValue('nama_kepala_keluarga', $pengajuan->user->nama_kepala_keluarga);
            $templateProcessor->setValue('alamat', $pengajuan->user->alamat);
            $templateProcessor->setValue('rt', $pengajuan->user->rt);
            $templateProcessor->setValue('rw', $pengajuan->user->rw);
            $templateProcessor->setValue('desa', $pengajuan->user->desa);
            $templateProcessor->setValue('dusun', $pengajuan->user->dusun);
            $templateProcessor->setValue('kecamatan', $pengajuan->user->kecamatan);
            $templateProcessor->setValue('kabupaten', $pengajuan->user->kabupaten);
            $templateProcessor->setValue('provinsi', $pengajuan->user->provinsi);
            $templateProcessor->setValue('kode_pos', $pengajuan->user->kode_pos);
            $templateProcessor->setValue('no_hp', $pengajuan->user->nomor_hp);
            $templateProcessor->setValue('tempat_lahir', $pengajuan->user->tempat_lahir);
            $templateProcessor->setValue('tgl_lahir', $pengajuan->user->tgl_lahir);
            $templateProcessor->setValue('pekerjaan', $pengajuan->user->pekerjaan);
        }

        // 4️⃣ Isi data dari pengajuan
        foreach ($pengajuan->DataPengajuans as $dp) {
            $fieldName = strtolower(str_replace(' ', '_', $dp->FieldSurats->nama_field));
            $templateProcessor->setValue($fieldName, $dp->nilai ?? '-');
        }


        // 5️⃣ Simpan hasil ke file Word baru di public path
        $fileName = 'surat_pengajuan_' . $pengajuan->id . '.docx';
        $outputPath = public_path('storage/generated/' . $fileName);

        // Pastikan folder generated ada
        if (!file_exists(public_path('storage/generated'))) {
            mkdir(public_path('storage/generated'), 0777, true);
        }

        $templateProcessor->saveAs($outputPath);

        // 6️⃣ (Opsional) Kembalikan URL publik
        $fileUrl = asset('storage/generated/' . $fileName);

        return response()->json([
            'success' => true,
            'url' => $fileUrl
        ]);
    }
}

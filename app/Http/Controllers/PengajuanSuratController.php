<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use App\Models\DataPengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanSuratController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();

        // Ambil semua pengajuan berdasarkan NIK user
        $pengajuan = PengajuanSurat::with('JenisSurats')
            ->where('nik', $user->nik)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($pengajuan);
    }

    /**
     * Detail pengajuan (dengan data field isian).
     */
    public function show($id, Request $request)
    {
        $user = $request->user();

        $pengajuan = PengajuanSurat::with([
            'JenisSurats',
            'DataPengajuans.FieldSurats'
        ])
            ->where('nik', $user->nik) // hanya milik user
            ->where('id', $id)         // filter berdasarkan id
            ->firstOrFail();

        return response()->json($pengajuan);
    }



    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // 1. Simpan data ke tabel pengajuan_surats
            $pengajuan = PengajuanSurat::create([
                'nik' => $request->nik,
                'name' => $request->name,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'jenis_surat_id' => $request->jenis_surat_id,
                'status' => 'diajukan',
            ]);

            // 2. Simpan ke tabel data_pengajuans
            if ($request->has('fields')) {
                foreach ($request->fields as $fieldId => $nilai) {

                    // cek apakah field berupa file
                    if ($request->hasFile("fields.$fieldId")) {
                        $file = $request->file("fields.$fieldId");

                        // nama file unik
                        $filename = time() . '_' . $fieldId . '.' . $file->getClientOriginalExtension();

                        // pindahkan ke public/upload/pengajuan
                        $file->move(public_path('upload/pengajuan'), $filename);

                        // path yang disimpan ke DB
                        $nilai = 'upload/pengajuan/' . $filename;
                    }

                    DataPengajuan::create([
                        'pengajuan_id' => $pengajuan->id,
                        'field_id' => $fieldId,
                        'nilai' => $nilai,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'message' => '✅ Pengajuan berhasil diajukan',
                'pengajuan_id' => $pengajuan->id,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => '❌ Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function terbaru(Request $request)
    {
        $user = $request->user();

        // Ambil semua pengajuan berdasarkan NIK user
        $pengajuan = PengajuanSurat::with('jenisSurats')
            ->where('nik', $user->nik)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return response()->json($pengajuan);
    }
}

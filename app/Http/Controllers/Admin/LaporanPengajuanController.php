<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use App\Models\JenisSurat;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPengajuanController extends Controller
{
    public function index(Request $request)
    {
        $jenisList = JenisSurat::whereBetween('id', [1, 3])->get();
        return view('admin.laporanpengajuan.index', compact('jenisList'));
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
            'jenis_laporan' => 'required',
        ]);

        $tanggalAwal = Carbon::parse($request->tanggal_awal)->startOfDay();
        $tanggalAkhir = Carbon::parse($request->tanggal_akhir)->endOfDay();

        $query = PengajuanSurat::with('JenisSurats')
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir]);

        $namaJenis = 'Semua Jenis Surat';

        if ($request->jenis_laporan !== 'semua') {
            $query->where('jenis_surat_id', $request->jenis_laporan);

            $jenis = JenisSurat::find($request->jenis_laporan);
            $namaJenis = $jenis ? $jenis->nama_jenis : 'Jenis Tidak Dikenal';
        }

        $data = $query->orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('admin.laporanpengajuan.pdf', [
            'data' => $data,
            'tanggal_awal' => $tanggalAwal->format('d/m/Y'),
            'tanggal_akhir' => $tanggalAkhir->format('d/m/Y'),
            'jenis_laporan' => $namaJenis, // ← Kirim nama jenisnya langsung
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('laporan_pengajuan_surat.pdf');
    }
}

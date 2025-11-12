<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\FieldSurat;
use App\Models\PengajuanSurat;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalJenisSurat = JenisSurat::count();
        $totalFieldSurat = FieldSurat::count();
        $totalPengajuan = PengajuanSurat::count();
        $totalUser = User::count();

        $totalPengajuanPindahAntarKecamatan = PengajuanSurat::where('jenis_surat_id', 1)->count();
        $totalPengajuanPindahAntarProvinsi = PengajuanSurat::where('jenis_surat_id', 2)->count();
        $totalPengajuanDispenNikah = PengajuanSurat::where('jenis_surat_id', 3)->count();
        $totalPengajuanIjinHajatan = PengajuanSurat::where('jenis_surat_id', 4)->count();

        $pengajuanTerbaru = PengajuanSurat::with('JenisSurats', 'user')
            ->latest()
            ->take(5)
            ->get();

        // 🔹 Data untuk grafik
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            // Untuk SQLite
            $pengajuanPerBulan = \App\Models\PengajuanSurat::selectRaw("strftime('%m', created_at) as bulan, COUNT(*) as total")
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->pluck('total', 'bulan');
        } else {
            // Untuk MySQL / MariaDB
            $pengajuanPerBulan = \App\Models\PengajuanSurat::selectRaw("MONTH(created_at) as bulan, COUNT(*) as total")
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->pluck('total', 'bulan');
        }

        // Konversi ke format JS-friendly
        $labels = [];
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = date('M', mktime(0, 0, 0, $i, 1));
            $data[] = $pengajuanPerBulan[$i] ?? 0;
        }

        return view('dashboard', compact(
            'totalJenisSurat',
            'totalFieldSurat',
            'totalPengajuan',
            'totalPengajuanPindahAntarKecamatan',
            'totalPengajuanPindahAntarProvinsi',
            'totalPengajuanDispenNikah',
            'totalPengajuanIjinHajatan',
            'totalUser',
            'pengajuanTerbaru',
            'labels',
            'data'
        ));
    }
}

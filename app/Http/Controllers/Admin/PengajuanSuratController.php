<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\DataPengajuan;
use App\Models\PengajuanSurat;
use App\Models\Utility;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class PengajuanSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\PengajuanSurat::with('JenisSurats');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $pengajuansurats = $query->paginate(8)->withQueryString();

        return view('admin.pengajuan.index-pengajuan', compact('pengajuansurats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengajuan = PengajuanSurat::with('JenisSurats', 'DataPengajuans.FieldSurats')
            ->findOrFail($id);

        // $user = User::where('nik', $pengajuan->nik)->first();

        $details = DataPengajuan::where('pengajuan_id', $pengajuan->id)->get();
        // dd($pengajuan);

        $data = [
            'pengajuan' => $pengajuan,
            'detail' => $details
        ];

        // dd($data);

        return view('admin.pengajuan.show-pengajuan', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateStatus($id, $status)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->status = $status;
        $pengajuan->save();

        return redirect()->back()->with('success', "Status pengajuan berhasil diubah menjadi {$status}.");
    }



    public function cetakAdmin($id)
    {
        $pengajuan = PengajuanSurat::with([
            'User',
            'JenisSurats',
            'DataPengajuans.FieldSurats'
        ])->findOrFail($id);

        $utility = Utility::first();

        // 1️⃣ Path template Word
        $templatePath = public_path('storage/' . $pengajuan->JenisSurats->template_surat);
        if (!file_exists($templatePath)) {
            return back()->with('error', 'Template surat tidak ditemukan: ' . $templatePath);
        }

        // 2️⃣ Load template Word
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);

        // 3️⃣ Isi field dasar
        $templateProcessor->setValue('nama', $pengajuan->name);
        $templateProcessor->setValue('nik', $pengajuan->nik);
        $templateProcessor->setValue('email', $pengajuan->email);
        $templateProcessor->setValue('status', $pengajuan->status);

        // 4️⃣ Data tanggal & kode
        $bulanRomawi = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];
        $bulan = $bulanRomawi[(int) date('n')];
        $tahun = date('Y');

        $templateProcessor->setValue('kode_provinsi', '33');
        $templateProcessor->setValue('nama_provinsi', 'JAWA TENGAH');
        $templateProcessor->setValue('kode_kabupaten', '27');
        $templateProcessor->setValue('nama_kabupaten', 'PEMALANG');
        $templateProcessor->setValue('kode_kecamatan', '2016');
        $templateProcessor->setValue('nama_kecamatan', 'PETARUKAN');
        $templateProcessor->setValue('id_pengajuan', $pengajuan->id);
        $templateProcessor->setValue('kode_jenis', $pengajuan->JenisSurats->kode_jenis);
        $templateProcessor->setValue('bulan', $bulan);
        $templateProcessor->setValue('tahun', $tahun);
        $templateProcessor->setValue('nama_camat', $utility->nama_camat ?? '-');
        $templateProcessor->setValue('nip_camat', $utility->nip_camat ?? '-');


        // 5️⃣ Data user
        if ($pengajuan->user) {
            $u = $pengajuan->user;
            $templateProcessor->setValue('no_kk', $u->no_kk);
            $templateProcessor->setValue('nama_kepala_keluarga', $u->nama_kepala_keluarga);
            $templateProcessor->setValue('alamat', $u->alamat);
            $templateProcessor->setValue('rt', $u->rt);
            $templateProcessor->setValue('rw', $u->rw);
            $templateProcessor->setValue('desa', $u->desa);
            $templateProcessor->setValue('dusun', $u->dusun);
            $templateProcessor->setValue('kecamatan', $u->kecamatan);
            $templateProcessor->setValue('kabupaten', $u->kabupaten);
            $templateProcessor->setValue('provinsi', $u->provinsi);
            $templateProcessor->setValue('kode_pos', $u->kode_pos);
            $templateProcessor->setValue('no_hp', $u->nomor_hp);
            $templateProcessor->setValue('tempat_lahir', $u->tempat_lahir);
            $templateProcessor->setValue('tgl_lahir', $u->tgl_lahir);
            $templateProcessor->setValue('pekerjaan', $u->pekerjaan);
        }

        // 6️⃣ Data tambahan dari DataPengajuans
        foreach ($pengajuan->DataPengajuans as $dp) {
            $fieldName = strtolower(str_replace(' ', '_', $dp->FieldSurats->nama_field));
            $templateProcessor->setValue($fieldName, $dp->nilai ?? '-');
        }

        // 7️⃣ Simpan hasil sementara di storage/app/temp
        $fileName = 'surat_pengajuan_' . $pengajuan->id . '.docx';
        $tempPath = storage_path('app/temp');
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0777, true);
        }
        $outputPath = $tempPath . '/' . $fileName;

        $templateProcessor->saveAs($outputPath);

        // 8️⃣ Download langsung dan hapus setelah dikirim
        return response()->download($outputPath, $fileName)->deleteFileAfterSend(true);
    }
}

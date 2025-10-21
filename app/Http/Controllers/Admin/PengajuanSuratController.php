<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPengajuan;
use App\Models\PengajuanSurat;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function cetak($id)
    {
        $pengajuan = PengajuanSurat::with('JenisSurats', 'DataPengajuans.FieldSurats')->findOrFail($id);

        dd($pengajuan);
        // return PDF view atau halaman cetak
        return view('admin.pengajuan.cetak', compact('pengajuan'));
    }
}

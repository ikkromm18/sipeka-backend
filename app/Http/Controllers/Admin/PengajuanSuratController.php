<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class PengajuanSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // $pengajuansurats = PengajuanSurat::orderBy('updated_at', 'desc')
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(6)->withQueryString();

        // $pengajuansurats = PengajuanSurat::when($search, function ($query, $search) {
        //     $query->where('nama', 'like', "%{$search}%")
        //         ->orWhere('jenis_surat', 'like', "%{$search}%");
        // })
        //     ->orderBy('updated_at', 'desc')
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(6)->withQueryString();

        $pengajuansurats = PengajuanSurat::paginate(7);

        $data = [
            'pengajuansurats' => $pengajuansurats,

        ];

        // dd($data);

        return view('admin.pengajuan.index-pengajuan', $data);
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
    public function show(string $id)
    {
        //
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
}

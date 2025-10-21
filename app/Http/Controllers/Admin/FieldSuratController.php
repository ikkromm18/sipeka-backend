<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FieldSurat;
use App\Models\JenisSurat;
use Illuminate\Http\Request;

class FieldSuratController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $fieldSurats = \App\Models\FieldSurat::with('JenisSurats')
            ->when($search, function ($query, $search) {
                $query->where('nama_field', 'like', "%{$search}%")
                    ->orWhereHas('JenisSurats', function ($q) use ($search) {
                        $q->where('nama_jenis', 'like', "%{$search}%");
                    });
            })
            ->orderBy('id', 'desc')
            ->paginate(8)
            ->appends(['search' => $search]); // supaya query tetap saat ganti halaman

        return view('admin.fieldsurat.index-fieldsurat', compact('fieldSurats', 'search'));
    }


    public function create()
    {
        $jenisSurats = JenisSurat::all();
        return view('admin.fieldsurat.create-fieldsurat', compact('jenisSurats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'nama_field' => 'required|string|max:100',
            'tipe_field' => 'required|in:text,number,date,time,boolean,email,file,select',
            'options' => 'nullable|string',
            'is_required' => 'nullable|boolean',
        ]);

        FieldSurat::create([
            'jenis_surat_id' => $request->jenis_surat_id,
            'nama_field' => $request->nama_field,
            'tipe_field' => $request->tipe_field,
            'options' => $request->tipe_field === 'select'
                ? json_decode($request->options, true)
                : null,
            'is_required' => $request->boolean('is_required'),
        ]);

        return redirect()->route('fieldsurat.index')->with('success', 'Field Surat berhasil ditambahkan.');
    }

    public function edit(FieldSurat $fieldsurat)
    {
        $jenisSurats = JenisSurat::all();
        return view('admin.fieldsurat.edit-fieldsurat', compact('fieldsurat', 'jenisSurats'));
    }

    public function update(Request $request, FieldSurat $fieldsurat)
    {
        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'nama_field' => 'required|string|max:100',
            'tipe_field' => 'required|in:text,number,date,time,boolean,email,file,select',
            'options' => 'nullable|string',
            'is_required' => 'nullable|boolean',
        ]);

        $fieldsurat->update([
            'jenis_surat_id' => $request->jenis_surat_id,
            'nama_field' => $request->nama_field,
            'tipe_field' => $request->tipe_field,
            'options' => $request->tipe_field === 'select'
                ? json_decode($request->options, true)
                : null,
            'is_required' => $request->boolean('is_required'),
        ]);

        return redirect()->route('fieldsurat.index')->with('success', 'Field Surat berhasil diperbarui.');
    }

    public function destroy(FieldSurat $fieldsurat)
    {
        $fieldsurat->delete();
        return redirect()->route('fieldsurat.index')->with('success', 'Field Surat berhasil dihapus.');
    }
}

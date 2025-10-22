<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $jenisSurats = JenisSurat::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_jenis', 'like', '%' . $search . '%');
            })
            ->paginate(7);

        return view('admin.jenissurat.index-jenissurat', compact('jenisSurats', 'search'));
    }

    public function create()
    {
        return view('admin.jenissurat.create-jenissurat');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:100',
            'kode_jenis' => 'required|integer|max:100',
            'template_surat' => 'nullable|file|mimes:doc,docx,pdf',
        ]);

        $data = $request->only(['nama_jenis', 'kode_jenis']);

        if ($request->hasFile('template_surat')) {
            $data['template_surat'] = $request->file('template_surat')->store('templates', 'public');
        }

        JenisSurat::create($data);

        return redirect()->route('jenissurat.index')->with('success', 'Jenis Surat berhasil ditambahkan.');
    }

    public function edit(JenisSurat $jenissurat)
    {
        return view('admin.jenissurat.edit-jenissurat', compact('jenissurat'));
    }

    public function update(Request $request, JenisSurat $jenissurat)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:100',
            'template_surat' => 'nullable|file|mimes:doc,docx,pdf',
        ]);

        $data = $request->only(['nama_jenis', 'kode_jenis']);

        if ($request->hasFile('template_surat')) {
            $data['template_surat'] = $request->file('template_surat')->store('templates', 'public');
        }

        $jenissurat->update($data);

        return redirect()->route('jenissurat.index')->with('success', 'Jenis Surat berhasil diperbarui.');
    }

    public function destroy(JenisSurat $jenissurat)
    {
        $jenissurat->delete();
        return redirect()->route('jenissurat.index')->with('success', 'Jenis Surat berhasil dihapus.');
    }
}

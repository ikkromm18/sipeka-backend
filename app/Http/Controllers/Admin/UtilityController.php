<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Utility;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function index()
    {
        $tes = Utility::first();

        // Ambil baris pertama, kalau belum ada buat otomatis
        $utility = Utility::first() ?? Utility::create([
            'nama_camat' => '',
            'nip_camat' => '',
            'nomor_admin' => '',
        ]);

        return view('admin.settings.index-settings', compact('utility'));
    }

    /**
     * Update pengaturan.
     */
    public function update(Request $request, Utility $setting)
    {
        $request->validate([
            'nama_camat' => 'nullable|string|max:255',
            'nip_camat' => 'nullable|string|max:255',
            'nomor_admin' => 'nullable|string|max:255',
        ]);

        $setting->update($request->only(['nama_camat', 'nip_camat', 'nomor_admin']));

        return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil diperbarui!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');
        // $users = User::where('role', 'User')
        //     ->where('is_active', true) // Menambahkan kondisi is_active = true
        //     ->when($search, function ($query, $search) {
        //         $query->where(function ($q) use ($search) {
        //             $q->where('name', 'like', "%{$search}%")
        //                 ->orWhere('email', 'like', "%{$search}%");
        //         });
        //     })
        //     ->paginate(7)
        //     ->withQueryString();

        $users = User::where('role', 'User')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->paginate(7)
            ->withQueryString();

        $data = [
            'users' => $users
        ];

        // dd($data);

        return view('admin.user.index-user', $data);
    }


    public function create()
    {
        return view('admin.user.add-admin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nomor_hp' => ['nullable'],

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nik' => $request->nik,
            'nomor_hp' => $request->nomor_hp,
            'role' => 'Admin'
        ]);

        event(new Registered($user));


        return redirect()->route('user.admin')->with('success', 'Berhasil Menambahkan Admin');

        return "Berhasil Menambahkan";
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.show-user', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit-user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255',
            'nik'                   => 'nullable|string|max:20',
            'no_kk'                 => 'nullable|string|max:20',
            'nama_kepala_keluarga'  => 'nullable|string|max:255',
            'alamat'                => 'nullable|string|max:500',
            'desa'                  => 'nullable|string|max:255',
            'rt'                    => 'nullable|string|max:10',
            'rw'                    => 'nullable|string|max:10',
            'kecamatan'             => 'nullable|string|max:255',
            'kabupaten'             => 'nullable|string|max:255',
            'provinsi'              => 'nullable|string|max:255',
            'kode_pos'              => 'nullable|string|max:10',
            'dusun'                 => 'nullable|string|max:255',
            'nomor_hp'              => 'nullable|string|max:20',
            'pekerjaan'             => 'nullable|string|max:255',
            'tempat_lahir'          => 'nullable|string|max:255',
            'tgl_lahir'             => 'nullable|date',
            'is_active'             => 'required|boolean',
            'foto_ktp'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_kk'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::findOrFail($id);
        $data = $request->except(['foto_ktp', 'foto_kk']);

        // Upload foto KTP
        if ($request->hasFile('foto_ktp')) {
            if ($user->foto_ktp && Storage::exists('public/' . $user->foto_ktp)) {
                Storage::delete('public/' . $user->foto_ktp);
            }
            $data['foto_ktp'] = $request->file('foto_ktp')->store('uploads/foto_ktp', 'public');
        }

        // Upload foto KK
        if ($request->hasFile('foto_kk')) {
            if ($user->foto_kk && Storage::exists('public/' . $user->foto_kk)) {
                Storage::delete('public/' . $user->foto_kk);
            }
            $data['foto_kk'] = $request->file('foto_kk')->store('uploads/foto_kk', 'public');
        }

        $user->update($data);

        return redirect()
            ->route('user.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasi dihapus');
    }


    public function updatePassword(Request $request, $id)
    {

        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8',
            'konfirmpassword' => 'required|same:newpassword',
        ], [
            'oldpassword.required' => 'Password lama wajib diisi.',
            'newpassword.required' => 'Password baru wajib diisi.',
            'newpassword.min' => 'Password baru minimal 8 karakter.',
            'konfirmpassword.required' => 'Konfirmasi password wajib diisi.',
            'konfirmpassword.same' => 'Konfirmasi password harus sama dengan password baru.',
        ]);

        $user = User::findOrFail($id);


        if (!Hash::check($request->oldpassword, $user->password)) {
            return back()->withErrors(['oldpassword' => 'Password lama tidak sesuai.']);
        }

        $user->password = Hash::make($request->newpassword);
        $user->save();

        return redirect()->route('user.admin')->with('success', 'Password berhasil diperbarui.');
    }

    public function verifikasi(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $data = [
            'is_active' => true
        ];

        $user->update($data);

        // $user->notify(new UserStatusNotification($user, $request->is_active));

        return redirect()->route('user.index')->with('success', 'User Berhasil Diverifikasi');
    }
}

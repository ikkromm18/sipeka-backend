<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|confirmed|min:6',
            'nik'                   => 'nullable|string|max:16',
            'no_kk'                 => 'nullable|string|max:16',
            'nama_kepala_keluarga'  => 'nullable|string|max:255',
            'alamat'                => 'nullable|string|max:255',
            'desa'                  => 'nullable|string|max:255',
            'rt'                    => 'nullable|string|max:10',
            'rw'                    => 'nullable|string|max:10',
            'kode_pos'              => 'nullable|string|max:10',
            'dusun'                 => 'nullable|string|max:255',
            'nomor_hp'              => 'nullable|string|max:20',
            'pekerjaan'             => 'nullable|string|max:255',
            'tempat_lahir'          => 'nullable|string|max:255',
            'tgl_lahir'             => 'nullable|date',
            'foto_ktp'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_kk'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ Upload foto jika ada
        $fotoKtpPath = null;
        $fotoKkPath  = null;

        if ($request->hasFile('foto_ktp')) {
            $fotoKtpPath = $request->file('foto_ktp')->store('uploads/foto_ktp', 'public');
        }
        if ($request->hasFile('foto_kk')) {
            $fotoKkPath = $request->file('foto_kk')->store('uploads/foto_kk', 'public');
        }

        // ✅ Simpan user
        $user = User::create([
            'name'                  => $validated['name'],
            'email'                 => $validated['email'],
            'password'              => Hash::make($validated['password']),
            'nik'                   => $request->nik,
            'no_kk'                 => $request->no_kk,
            'nama_kepala_keluarga'  => $request->nama_kepala_keluarga,
            'alamat'                => $request->alamat,
            'desa'                  => $request->desa,
            'rt'                    => $request->rt,
            'rw'                    => $request->rw,
            'kode_pos'              => $request->kode_pos,
            'dusun'                 => $request->dusun,
            'nomor_hp'              => $request->nomor_hp,
            'pekerjaan'             => $request->pekerjaan,
            'tempat_lahir'          => $request->tempat_lahir,
            'tgl_lahir'             => $request->tgl_lahir,
            'foto_ktp'              => $fotoKtpPath,
            'foto_kk'               => $fotoKkPath,
        ]);

        $token = $user->createToken($user->name)->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'message' => 'Email dan Password tidak Valid'
            ];
        }

        $token = $user->createToken($user->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function logout(Request $request)
    {
        if (!$request->user()) {
            return response()->json(['message' => 'User tidak dikenali'], 401);
        }

        $request->user()->tokens()->delete();

        return [
            'message' => 'Berhasil Log Out'
        ];
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => __($status)], 200);
        }

        return response()->json(['message' => __($status)], 422);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => __($status)], 200);
        }

        return response()->json(['message' => __($status)], 422);
    }

    public function show(Request $request)
    {
        return response()->json($request->user());
    }

    public function update(Request $request)
    {
        $user = $request->user();

        // validasi
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email,' . $user->id,
            'nik'                   => 'nullable|string|max:16',
            'no_kk'                 => 'nullable|string|max:16',
            'nama_kepala_keluarga'  => 'nullable|string|max:255',
            'alamat'                => 'nullable|string|max:255',
            'desa'                  => 'nullable|string|max:255',
            'rt'                    => 'nullable|string|max:10',
            'rw'                    => 'nullable|string|max:10',
            'kode_pos'              => 'nullable|string|max:10',
            'dusun'                 => 'nullable|string|max:255',
            'nomor_hp'              => 'nullable|string|max:20',
            'pekerjaan'             => 'nullable|string|max:255',
            'tempat_lahir'          => 'nullable|string|max:255',
            'tgl_lahir'             => 'nullable|date',
            'foto_ktp'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_kk'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload foto KTP
        if ($request->hasFile('foto_ktp')) {
            if ($user->foto_ktp) {
                Storage::disk('public')->delete($user->foto_ktp);
            }
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('uploads/foto_ktp', 'public');
        }

        // upload foto KK
        if ($request->hasFile('foto_kk')) {
            if ($user->foto_kk) {
                Storage::disk('public')->delete($user->foto_kk);
            }
            $validated['foto_kk'] = $request->file('foto_kk')->store('uploads/foto_kk', 'public');
        }

        // update user
        $user->update($validated);

        return response()->json([
            'message' => 'Profil berhasil diperbarui ✅',
            'user'    => $user
        ]);
    }
}

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Detail User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    {{-- Judul --}}
                    <h3 class="mb-6 text-lg font-semibold text-gray-900">Informasi Pengguna</h3>

                    {{-- Tombol verifikasi --}}
                    @if (!$user->is_active)
                        <div class="flex items-center justify-end mt-4">
                            <form action="{{ route('user.verifikasi', $user->id) }}" method="POST"
                                onsubmit="return confirm('Aktifkan user ini?')">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-semibold text-white bg-green-600 rounded hover:bg-green-700">
                                    ✅ Verifikasi User
                                </button>
                            </form>
                        </div>
                    @endif


                    {{-- Tabel Detail --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left text-gray-700">
                            <tbody>
                                <tr class="border-b">
                                    <th class="w-1/3 px-4 py-3 font-medium text-gray-900 bg-gray-50">Nama</th>
                                    <td class="px-4 py-3">{{ $user->name ?? '-' }}</td>
                                </tr>
                                <tr class="border-b">
                                    <th class="px-4 py-3 font-medium text-gray-900 bg-gray-50">Email</th>
                                    <td class="px-4 py-3">{{ $user->email ?? '-' }}</td>
                                </tr>
                                <tr class="border-b">
                                    <th class="px-4 py-3 font-medium text-gray-900 bg-gray-50">Nomor HP</th>
                                    <td class="px-4 py-3">{{ $user->nomor_hp ?? '-' }}</td>
                                </tr>
                                <tr class="border-b">
                                    <th class="px-4 py-3 font-medium text-gray-900 bg-gray-50">NIK</th>
                                    <td class="px-4 py-3">{{ $user->nik ?? '-' }}</td>
                                </tr>
                                <tr class="border-b">
                                    <th class="px-4 py-3 font-medium text-gray-900 bg-gray-50">Alamat</th>
                                    <td class="px-4 py-3">
                                        {{ $user->alamat ?? '-' }},
                                        {{ $user->desa ?? '' }},
                                        {{ $user->kecamatan ?? '' }},
                                        {{ $user->kabupaten ?? '' }},
                                        {{ $user->provinsi ?? '' }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th class="px-4 py-3 font-medium text-gray-900 bg-gray-50">Tempat, Tanggal Lahir
                                    </th>
                                    <td class="px-4 py-3">
                                        {{ $user->tempat_lahir ?? '-' }},
                                        {{ $user->tgl_lahir ? \Carbon\Carbon::parse($user->tgl_lahir)->format('d M Y') : '-' }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th class="px-4 py-3 font-medium text-gray-900 bg-gray-50">Pekerjaan</th>
                                    <td class="px-4 py-3">{{ $user->pekerjaan ?? '-' }}</td>
                                </tr>
                                <tr class="border-b">
                                    <th class="px-4 py-3 font-medium text-gray-900 bg-gray-50">Role</th>
                                    <td class="px-4 py-3">{{ $user->role }}</td>
                                </tr>
                                <tr>
                                    <th class="px-4 py-3 font-medium text-gray-900 bg-gray-50">Status</th>
                                    <td class="px-4 py-3">
                                        @if ($user->is_active)
                                            <span
                                                class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded">
                                                Aktif
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded">
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Foto (jika ada) --}}
                    @if ($user->foto_ktp || $user->foto_kk || $user->foto_profil)
                        <div class="mt-6">
                            <h3 class="mb-3 font-semibold text-gray-900 text-md">Dokumen</h3>
                            <div class="flex flex-wrap gap-6">

                                @if ($user->foto_ktp)
                                    <div>
                                        <p class="mb-1 text-sm text-gray-700">Foto KTP:</p>
                                        <img src="{{ asset($user->foto_ktp) }}" alt="Foto KTP"
                                            class="w-56 rounded shadow">
                                    </div>
                                @endif
                                @if ($user->foto_kk)
                                    <div>
                                        <p class="mb-1 text-sm text-gray-700">Foto KK:</p>
                                        <img src="{{ asset($user->foto_kk) }}" alt="Foto KK"
                                            class="w-56 rounded shadow">
                                    </div>
                                @endif

                                @if ($user->foto_profil)
                                    <div>
                                        <p class="mb-1 text-sm text-gray-700">Foto Profile:</p>
                                        <img src="{{ asset($user->foto_profil) }}" alt="Foto Profile"
                                            class="w-56 rounded shadow">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Tombol kembali --}}
                    <div class="flex items-center justify-end mt-8">
                        <a href="{{ route('user.index') }}"
                            class="px-4 py-2 text-sm font-semibold text-white bg-gray-700 rounded hover:bg-gray-800">
                            ← Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Detail Pengajuan Surat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    {{-- Judul --}}
                    <h3 class="mb-6 text-lg font-semibold text-gray-900">
                        Informasi Pengajuan
                    </h3>

                    {{-- Informasi utama pengajuan --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left text-gray-700">
                            <tbody>
                                <tr class="border-b">
                                    <th class="w-1/3 px-4 py-3 font-medium text-gray-900 bg-gray-50">NIK</th>
                                    <td class="px-4 py-3">{{ $pengajuan->nik ?? '-' }}</td>
                                </tr>

                                <tr class="border-b">
                                    <th class="px-4 py-3 font-medium text-gray-900 bg-gray-50">Nama Pemohon</th>
                                    <td class="px-4 py-3">{{ $pengajuan->name ?? '-' }}</td>
                                </tr>

                                <tr class="border-b">
                                    <th class="px-4 py-3 font-medium text-gray-900 bg-gray-50">Email</th>
                                    <td class="px-4 py-3">{{ $pengajuan->email ?? '-' }}</td>
                                </tr>

                                <tr class="border-b">
                                    <th class="px-4 py-3 font-medium text-gray-900 bg-gray-50">Alamat</th>
                                    <td class="px-4 py-3">{{ $pengajuan->alamat ?? '-' }}</td>
                                </tr>

                                <tr class="border-b">
                                    <th class="px-4 py-3 font-medium text-gray-900 bg-gray-50">Jenis Surat</th>
                                    <td class="px-4 py-3">{{ $pengajuan->JenisSurats->nama_jenis ?? '-' }}</td>
                                </tr>

                                <tr class="border-b">
                                    <th class="px-4 py-3 font-medium text-gray-900 bg-gray-50">Status</th>
                                    <td class="px-4 py-3">
                                        @switch($pengajuan->status)
                                            @case('diajukan')
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded">Diajukan</span>
                                            @break

                                            @case('diproses')
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded">Diproses</span>
                                            @break

                                            @case('ditolak')
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded">Ditolak</span>
                                            @break

                                            @case('selesai')
                                                <span
                                                    class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded">Selesai</span>
                                            @break

                                            @default
                                                -
                                        @endswitch
                                    </td>
                                </tr>

                                @if ($pengajuan->keterangan)
                                    <tr>
                                        <th class="px-4 py-3 font-medium text-gray-900 bg-gray-50">Keterangan</th>
                                        <td class="px-4 py-3">{{ $pengajuan->keterangan }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- Detail Field Dinamis --}}
                    <div class="mt-8">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900">Detail Data Pengajuan</h3>

                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm text-left text-gray-700 border">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 font-semibold border">Nama Field</th>
                                        <th class="px-4 py-3 font-semibold border">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail as $item)
                                        @php
                                            $field = $item->FieldSurats ?? null;
                                            $isFile = $field && $field->tipe_field === 'file';
                                        @endphp

                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-4 py-3 font-medium text-gray-900 border">
                                                {{ $field->nama_field ?? '-' }}
                                            </td>
                                            <td class="px-4 py-3 border">
                                                @if ($isFile && $item->nilai)
                                                    <a href="{{ asset('storage/' . $item->nilai) }}" target="_blank"
                                                        class="text-blue-600 underline">
                                                        📎 Lihat File
                                                    </a>
                                                @else
                                                    {{ $item->nilai ?? '-' }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex flex-wrap justify-end gap-3 mt-8">

                        {{-- Tombol kembali --}}
                        <a href="{{ route('pengajuansurat.index') }}"
                            class="px-4 py-2 text-sm font-semibold text-white bg-gray-700 rounded hover:bg-gray-800">
                            ← Kembali
                        </a>

                        {{-- Jika status masih diajukan --}}
                        @if ($pengajuan->status === 'diajukan')
                            <form action="{{ route('pengajuansurat.updateStatus', [$pengajuan->id, 'diproses']) }}"
                                method="POST" onsubmit="return confirm('Setujui dan ubah status menjadi Diproses?')">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded hover:bg-blue-700">
                                    ✅ Setujui
                                </button>
                            </form>

                            <form action="{{ route('pengajuansurat.updateStatus', [$pengajuan->id, 'ditolak']) }}"
                                method="POST" onsubmit="return confirm('Yakin ingin menolak pengajuan ini?')">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded hover:bg-red-700">
                                    ❌ Tolak
                                </button>
                            </form>
                        @endif

                        {{-- Jika status sedang diproses --}}
                        @if ($pengajuan->status === 'diproses')
                            <a href="{{ route('pengajuansurat.cetakadmin', $pengajuan->id) }}"
                                class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded hover:bg-indigo-700">
                                🖨 Cetak
                            </a>

                            <form action="{{ route('pengajuansurat.updateStatus', [$pengajuan->id, 'selesai']) }}"
                                method="POST" onsubmit="return confirm('Tandai pengajuan ini sebagai selesai?')">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-semibold text-white bg-green-600 rounded hover:bg-green-700">
                                    ✅ Selesai
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

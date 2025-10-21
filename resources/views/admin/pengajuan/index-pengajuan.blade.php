<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Pengajuan Surat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">

                {{-- Pesan sukses --}}
                @if (session('success'))
                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Toolbar: Search & Tambah --}}
                <div class="flex flex-col items-center justify-between gap-3 p-4 border-b md:flex-row bg-gray-50">
                    <form method="GET" action="{{ route('pengajuansurat.index') }}"
                        class="flex items-center w-full md:w-auto">
                        <x-text-input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama, NIK, atau email..." class="w-full md:w-72" />
                        <x-primary-button class="ml-2">
                            Cari
                        </x-primary-button>
                        @if (request('search'))
                            <a href="{{ route('pengajuansurat.index') }}"
                                class="ml-2 text-sm text-gray-600 hover:underline">Reset</a>
                        @endif
                    </form>

                    <a href="{{ route('pengajuansurat.create') }}">
                        <x-primary-button>
                            + Tambah Pengajuan
                        </x-primary-button>
                    </a>
                </div>

                {{-- Tabel Data User --}}
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">NIK</th>
                                <th scope="col" class="px-6 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Alamat</th>
                                <th scope="col" class="px-6 py-3">Jenis Surat</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengajuansurats as $index => $pengajuan)
                                <tr class="border-b odd:bg-white even:bg-gray-50">
                                    <td class="px-6 py-4">
                                        {{ $pengajuansurats->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $pengajuan->nik }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $pengajuan->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $pengajuan->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $pengajuan->alamat }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $pengajuan->JenisSurats->nama_jenis ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{-- Status tampil warna berbeda --}}
                                        @php
                                            $status = strtolower($pengajuan->status ?? 'menunggu');
                                            $statusClass = match ($status) {
                                                'selesai' => 'bg-green-100 text-green-800',
                                                'diajukan' => 'bg-blue-100 text-blue-800',
                                                'ditolak' => 'bg-red-100 text-red-800',
                                                default => 'bg-yellow-100 text-yellow-800',
                                            };
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-semibold rounded {{ $statusClass }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 space-x-2 text-center">
                                        <a href="{{ route('pengajuansurat.show', $pengajuan->id) }}"
                                            class="text-blue-600 hover:underline">Detail</a>
                                        <a href="{{ route('pengajuansurat.edit', $pengajuan->id) }}"
                                            class="text-yellow-600 hover:underline">Edit</a>
                                        <form action="{{ route('pengajuansurat.destroy', $pengajuan->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus user ini?')"
                                                class="text-red-600 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                        Tidak ada data user.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="p-4">
                    {{ $pengajuansurats->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

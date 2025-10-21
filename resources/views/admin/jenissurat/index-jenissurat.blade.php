<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Daftar Jenis Surat') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-sm sm:rounded-lg">

                {{-- Pesan sukses --}}
                @if (session('success'))
                    <div class="p-3 mb-4 text-sm text-green-700 bg-green-100 border border-green-200 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Pencarian dan tombol tambah --}}
                <div class="flex items-center justify-between mb-4">
                    <form method="GET" action="{{ route('jenissurat.index') }}" class="flex gap-2">
                        <x-text-input name="search" value="{{ $search ?? '' }}" placeholder="Cari jenis surat..." />
                        <x-primary-button>Cari</x-primary-button>
                    </form>

                    <a href="{{ route('jenissurat.create') }}">
                        <x-primary-button>+ Tambah Jenis Surat</x-primary-button>
                    </a>
                </div>

                {{-- Tabel --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700 border border-gray-200 rounded-md">
                        <thead class="text-xs text-gray-800 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nama Jenis</th>
                                <th class="px-4 py-3">Template</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jenisSurats as $index => $jenis)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $jenisSurats->firstItem() + $index }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $jenis->nama_jenis }}</td>
                                    <td class="px-4 py-3">
                                        @if ($jenis->template_surat)
                                            <a href="{{ asset('storage/' . $jenis->template_surat) }}" target="_blank"
                                                class="text-blue-600 hover:underline">Lihat Template</a>
                                        @else
                                            <span class="text-gray-400">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 space-x-3 text-center">
                                        <a href="{{ route('jenissurat.edit', $jenis->id) }}"
                                            class="text-yellow-600 hover:underline">Edit</a>

                                        <form action="{{ route('jenissurat.destroy', $jenis->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus jenis surat ini?')"
                                                class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-3 text-center text-gray-500">
                                        Tidak ada data jenis surat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $jenisSurats->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Field Surat') }}
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

                {{-- Bar atas: Search dan Tombol Tambah --}}
                <div class="flex flex-col items-start justify-between mb-4 space-y-3 md:flex-row md:items-center">
                    <form method="GET" action="{{ route('fieldsurat.index') }}"
                        class="flex items-center w-full md:w-1/3">
                        <x-text-input type="text" name="search" value="{{ $search ?? '' }}"
                            placeholder="Cari nama field atau jenis surat..." class="w-full rounded-l-md" />
                        <x-primary-button type="submit" class="rounded-l-none">
                            Cari
                        </x-primary-button>
                    </form>

                    <a href="{{ route('fieldsurat.create') }}">
                        <x-primary-button>+ Tambah Field Surat</x-primary-button>
                    </a>
                </div>

                {{-- Tabel --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700 border border-gray-200 rounded-md">
                        <thead class="text-xs text-gray-800 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Jenis Surat</th>
                                <th class="px-4 py-3">Nama Field</th>
                                <th class="px-4 py-3">Tipe</th>
                                <th class="px-4 py-3">Wajib?</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fieldSurats as $index => $field)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $fieldSurats->firstItem() + $index }}</td>
                                    <td class="px-4 py-3">{{ $field->JenisSurats->nama_jenis ?? '-' }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $field->nama_field }}</td>
                                    <td class="px-4 py-3">{{ ucfirst($field->tipe_field) }}</td>
                                    <td class="px-4 py-3">
                                        {{ $field->is_required ? 'Ya' : 'Tidak' }}
                                    </td>
                                    <td class="px-4 py-3 space-x-3 text-center">
                                        <a href="{{ route('fieldsurat.edit', $field->id) }}"
                                            class="text-yellow-600 hover:underline">Edit</a>

                                        <form action="{{ route('fieldsurat.destroy', $field->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus field ini?')"
                                                class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                                        Tidak ada field surat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $fieldSurats->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

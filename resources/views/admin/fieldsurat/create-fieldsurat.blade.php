<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Field Surat') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-sm sm:rounded-lg">

                <form method="POST" action="{{ route('fieldsurat.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="jenis_surat_id" value="Jenis Surat" />
                        <select id="jenis_surat_id" name="jenis_surat_id"
                            class="block w-full mt-1 border-gray-300 rounded-md">
                            <option value="">-- Pilih Jenis Surat --</option>
                            @foreach ($jenisSurats as $jenis)
                                <option value="{{ $jenis->id }}"
                                    {{ old('jenis_surat_id') == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('jenis_surat_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="nama_field" value="Nama Field" />
                        <x-text-input id="nama_field" name="nama_field" type="text" class="block w-full mt-1"
                            value="{{ old('nama_field') }}" required />
                        <x-input-error :messages="$errors->get('nama_field')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="tipe_field" value="Tipe Field" />
                        <select id="tipe_field" name="tipe_field" class="block w-full mt-1 border-gray-300 rounded-md">
                            @foreach (['text', 'number', 'date', 'time', 'boolean', 'email', 'file', 'select'] as $tipe)
                                <option value="{{ $tipe }}" {{ old('tipe_field') == $tipe ? 'selected' : '' }}>
                                    {{ ucfirst($tipe) }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('tipe_field')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="options" value="Options (Untuk Select, pisahkan dengan koma)" />
                        <textarea id="options" name="options" rows="3" class="block w-full mt-1 border-gray-300 rounded-md">{{ old('options') }}</textarea>
                        <x-input-error :messages="$errors->get('options')" class="mt-2" />
                    </div>

                    <div class="flex items-center mb-4">
                        <input id="is_required" name="is_required" type="checkbox" value="1"
                            class="border-gray-300 rounded" {{ old('is_required', true) ? 'checked' : '' }}>
                        <label for="is_required" class="ml-2 text-sm text-gray-700">Wajib diisi</label>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <x-secondary-button href="{{ route('fieldsurat.index') }}">Batal</x-secondary-button>
                        <x-primary-button>Simpan</x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>

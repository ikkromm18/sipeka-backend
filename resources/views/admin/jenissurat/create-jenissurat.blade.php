<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Jenis Surat') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-sm sm:rounded-lg">

                <form action="{{ route('jenissurat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="nama_jenis" value="Nama Jenis Surat" />
                        <x-text-input id="nama_jenis" name="nama_jenis" type="text" class="block w-full mt-1"
                            value="{{ old('nama_jenis') }}" required />
                        <x-input-error :messages="$errors->get('nama_jenis')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="template_surat" value="Template Surat (Opsional)" />
                        <input id="template_surat" name="template_surat" type="file"
                            class="block w-full mt-1 text-sm text-gray-700 border-gray-300 rounded-md" />
                        <x-input-error :messages="$errors->get('template_surat')" class="mt-2" />
                    </div>

                    <div class="flex justify-end space-x-2">
                        <x-secondary-button href="{{ route('jenissurat.index') }}">Batal</x-secondary-button>
                        <x-primary-button>Simpan</x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

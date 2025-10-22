<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Jenis Surat') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-sm sm:rounded-lg">

                <form action="{{ route('jenissurat.update', $jenissurat->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="nama_jenis" value="Nama Jenis Surat" />
                        <x-text-input id="nama_jenis" name="nama_jenis" type="text" class="block w-full mt-1"
                            value="{{ old('nama_jenis', $jenissurat->nama_jenis) }}" required />
                        <x-input-error :messages="$errors->get('nama_jenis')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="kode_jenis" value="Nama Jenis Surat" />
                        <x-text-input id="kode_jenis" name="kode_jenis" type="text" class="block w-full mt-1"
                            value="{{ old('kode_jenis', $jenissurat->kode_jenis) }}" required />
                        <x-input-error :messages="$errors->get('kode_jenis')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="template_surat" value="Template Surat (Opsional)" />
                        @if ($jenissurat->template_surat)
                            <p class="mb-2 text-sm text-gray-600">
                                File lama:
                                <a href="{{ asset('storage/' . $jenissurat->template_surat) }}" target="_blank"
                                    class="text-blue-600 hover:underline">Lihat Template</a>
                            </p>
                        @endif
                        <input id="template_surat" name="template_surat" type="file"
                            class="block w-full mt-1 text-sm text-gray-700 border-gray-300 rounded-md" />
                        <x-input-error :messages="$errors->get('template_surat')" class="mt-2" />
                    </div>

                    <div class="flex justify-end space-x-2">
                        <x-secondary-button href="{{ route('jenissurat.index') }}">Batal</x-secondary-button>
                        <x-primary-button>Update</x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Pengaturan Umum') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-6 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <form action="{{ route('settings.update', $utility->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="nama_camat" :value="__('Nama Camat')" />
                        <x-text-input id="nama_camat" name="nama_camat" type="text" class="block w-full mt-1"
                            value="{{ old('nama_camat', $utility->nama_camat) }}" />
                        <x-input-error :messages="$errors->get('nama_camat')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="nip_camat" :value="__('Nomor Admin')" />
                        <x-text-input id="nip_camat" name="nip_camat" type="text" class="block w-full mt-1"
                            value="{{ old('nip_camat', $utility->nip_camat) }}" />
                        <x-input-error :messages="$errors->get('nip_camat')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="nomor_admin" :value="__('Nomor Admin')" />
                        <x-text-input id="nomor_admin" name="nomor_admin" type="text" class="block w-full mt-1"
                            value="{{ old('nomor_admin', $utility->nomor_admin) }}" />
                        <x-input-error :messages="$errors->get('nomor_admin')" class="mt-2" />
                    </div>

                    <div class="flex justify-end">
                        <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

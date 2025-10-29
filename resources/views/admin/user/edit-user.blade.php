<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <h3 class="mb-6 text-lg font-medium text-gray-900">
                        {{ __('Form Edit User') }}
                    </h3>

                    {{-- Alert --}}
                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Error Validation --}}
                    @if ($errors->any())
                        <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded-lg">
                            <ul class="space-y-1 list-disc ps-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            {{-- Nama --}}
                            <div>
                                <x-input-label for="name" :value="__('Nama Lengkap')" />
                                <x-text-input id="name" name="name" type="text" class="block w-full mt-1"
                                    value="{{ old('name', $user->name) }}" required />
                            </div>

                            {{-- Email --}}
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="block w-full mt-1"
                                    value="{{ old('email', $user->email) }}" required />
                            </div>

                            {{-- Nomor HP --}}
                            <div>
                                <x-input-label for="nomor_hp" :value="__('Nomor HP')" />
                                <x-text-input id="nomor_hp" name="nomor_hp" type="text" class="block w-full mt-1"
                                    value="{{ old('nomor_hp', $user->nomor_hp) }}" />
                            </div>

                            {{-- NIK --}}
                            <div>
                                <x-input-label for="nik" :value="__('NIK')" />
                                <x-text-input id="nik" name="nik" type="text" class="block w-full mt-1"
                                    value="{{ old('nik', $user->nik) }}" />
                            </div>

                            {{-- Alamat --}}
                            <div class="md:col-span-2">
                                <x-input-label for="alamat" :value="__('Alamat')" />
                                <textarea id="alamat" name="alamat" rows="3"
                                    class="block w-full mt-1 border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500">{{ old('alamat', $user->alamat) }}</textarea>
                            </div>

                            {{-- Foto KTP --}}
                            <div>
                                <x-input-label for="foto_ktp" :value="__('Foto KTP')" />
                                <input id="foto_ktp" name="foto_ktp" type="file"
                                    class="block w-full mt-1 text-sm text-gray-600 border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500" />
                                @if ($user->foto_ktp)
                                    <img src="{{ asset('storage/' . $user->foto_ktp) }}" alt="KTP Preview"
                                        class="w-auto h-32 mt-3 border rounded-md">
                                @endif
                            </div>

                            {{-- Foto KK --}}
                            <div>
                                <x-input-label for="foto_kk" :value="__('Foto KK')" />
                                <input id="foto_kk" name="foto_kk" type="file"
                                    class="block w-full mt-1 text-sm text-gray-600 border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500" />
                                @if ($user->foto_kk)
                                    <img src="{{ asset('storage/' . $user->foto_kk) }}" alt="KK Preview"
                                        class="w-auto h-32 mt-3 border rounded-md">
                                @endif
                            </div>

                            {{-- Status --}}
                            <div>
                                <x-input-label for="is_active" :value="__('Status Akun')" />
                                <select id="is_active" name="is_active"
                                    class="block w-full mt-1 border-gray-300 rounded-md focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="1" {{ $user->is_active ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>
                        </div>

                        {{-- Tombol --}}
                        <div class="flex justify-end mt-8 space-x-3">
                            <a href="{{ route('user.index') }}"
                                class="px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                                {{ __('Batal') }}
                            </a>

                            <x-primary-button>
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

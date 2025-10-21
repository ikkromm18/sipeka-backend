<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Laporan Pengajuan Surat') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow sm:rounded-lg">

                <form method="GET" action="{{ route('laporanpengajuan.cetak') }}" target="_blank">
                    @csrf

                    {{-- Rentang Tanggal --}}
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <x-input-label for="tanggal_awal" value="Tanggal Awal" />
                            <x-text-input id="tanggal_awal" type="date" name="tanggal_awal" class="block w-full mt-1"
                                required />
                        </div>

                        <div>
                            <x-input-label for="tanggal_akhir" value="Tanggal Akhir" />
                            <x-text-input id="tanggal_akhir" type="date" name="tanggal_akhir"
                                class="block w-full mt-1" required />
                        </div>
                    </div>

                    {{-- Jenis Laporan --}}
                    <div class="mt-4 text-slate-900">
                        <x-input-label for="jenis_laporan" :value="__('Pilih Jenis Laporan')" />
                        <select id="jenis_laporan" name="jenis_laporan"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="semua">Laporan Semua Pengajuan</option>

                            <optgroup label="Laporan Berdasarkan Jenis Surat">
                                @foreach ($jenisList as $jenis)
                                    <option value="{{ $jenis->id }}">
                                        Laporan Pengajuan {{ $jenis->nama_jenis }}
                                    </option>
                                @endforeach
                            </optgroup>
                        </select>
                        <x-input-error :messages="$errors->get('jenis_laporan')" class="mt-2" />
                    </div>

                    {{-- Tombol Cetak --}}
                    <div class="mt-6">
                        <x-primary-button>
                            <i class="mr-1 fa fa-print"></i> Cetak Laporan
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

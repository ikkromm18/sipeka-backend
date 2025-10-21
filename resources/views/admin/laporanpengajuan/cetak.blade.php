<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pengajuan Surat</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="p-8">
    <h1 class="mb-2 text-2xl font-bold text-center">Laporan Pengajuan Surat</h1>
    <p class="mb-6 text-center">
        Periode: {{ $tanggal_awal }} - {{ $tanggal_akhir }} <br>
        Jenis: {{ $jenis_laporan === 'semua' ? 'Semua Jenis Surat' : 'Surat dengan ID 1-3' }}
    </p>

    <table class="w-full text-sm border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-2 py-1 border">No</th>
                <th class="px-2 py-1 border">Tanggal</th>
                <th class="px-2 py-1 border">NIK</th>
                <th class="px-2 py-1 border">Nama</th>
                <th class="px-2 py-1 border">Jenis Surat</th>
                <th class="px-2 py-1 border">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $i => $d)
                <tr class="odd:bg-white even:bg-gray-50">
                    <td class="px-2 py-1 text-center border">{{ $i + 1 }}</td>
                    <td class="px-2 py-1 border">{{ $d->created_at->format('d/m/Y') }}</td>
                    <td class="px-2 py-1 border">{{ $d->nik }}</td>
                    <td class="px-2 py-1 border">{{ $d->name }}</td>
                    <td class="px-2 py-1 border">{{ $d->JenisSurats->nama_jenis ?? '-' }}</td>
                    <td class="px-2 py-1 text-center border">{{ ucfirst($d->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-2 py-2 text-center text-gray-500 border">
                        Tidak ada data pada rentang tanggal ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>

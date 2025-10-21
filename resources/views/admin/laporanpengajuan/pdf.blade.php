<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pengajuan Surat</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #888;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin: 0;
        }
    </style>
</head>

<body>
    <h2>Laporan Pengajuan Surat</h2>
    <p>Periode: {{ $tanggal_awal }} - {{ $tanggal_akhir }}</p>
    <p>
        Jenis: {{ $jenis_laporan }}
    </p>


    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jenis Surat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $i => $d)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $d->created_at->format('d/m/Y') }}</td>
                    <td>{{ $d->nik }}</td>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->JenisSurats->nama_jenis ?? '-' }}</td>
                    <td>{{ ucfirst($d->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br><br>
    <p style="text-align:right; font-size: 11px;">Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
</body>

</html>

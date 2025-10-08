<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Detail Pengajuan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 6px;
        }
    </style>
</head>

<body>
    <h1>Detail Pengajuan Surat</h1>

    <p><strong>Jenis Surat:</strong> {{ $pengajuan->JenisSurats->nama_jenis }}</p>
    <p><strong>Nama:</strong> {{ $pengajuan->name }}</p>
    <p><strong>NIK:</strong> {{ $pengajuan->nik }}</p>
    <p><strong>Email:</strong> {{ $pengajuan->email }}</p>
    <p><strong>Alamat:</strong> {{ $pengajuan->alamat }}</p>
    <p><strong>Status:</strong> {{ $pengajuan->status }}</p>
    @if ($pengajuan->keterangan)
        <p><strong>Keterangan:</strong> {{ $pengajuan->keterangan }}</p>
    @endif
    <p><strong>Dibuat:</strong> {{ $pengajuan->created_at->format('d-m-Y H:i') }}</p>

    <h3>Data Isian</h3>
    <table>
        <thead>
            <tr>
                <th>Field</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengajuan->DataPengajuans as $data)
                <tr>
                    <td>{{ $data->FieldSurats->nama_field }}</td>
                    <td>{{ $data->nilai }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" style="text-align:center;">Tidak ada data tambahan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Ringkasan -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <div class="p-6 bg-white border rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Total Jenis Surat</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalJenisSurat }}</h3>
                </div>

                <div class="p-6 bg-white border rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Total Field Surat</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalFieldSurat }}</h3>
                </div>

                <div class="p-6 bg-white border rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Total Pengajuan Surat</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalPengajuan }}</h3>
                </div>

                <div class="p-6 bg-white border rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Total Pengguna</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalUser }}</h3>
                </div>
            </div>

            <!-- Grafik -->
            <div class="p-6 mt-8 bg-white border rounded-lg shadow-sm">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">Tren Pengajuan Surat per Bulan</h3>
                <canvas id="grafikPengajuan" height="90"></canvas>
            </div>

            <!-- Pengajuan terbaru -->
            <div class="mt-8 bg-white border rounded-lg shadow-sm">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-800">Pengajuan Surat Terbaru</h3>
                </div>

                <div class="p-6 overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700 border border-gray-200 rounded-md">
                        <thead class="text-xs text-gray-800 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Pemohon</th>
                                <th class="px-4 py-3">Jenis Surat</th>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengajuanTerbaru as $index => $pengajuan)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3">{{ $pengajuan->user->name ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $pengajuan->JenisSurats->nama_jenis ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $pengajuan->created_at->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-md
                                            @if ($pengajuan->status == 'selesai') bg-green-100 text-green-700
                                            @elseif($pengajuan->status == 'diajukan') bg-blue-100 text-blue-700

                                            @elseif($pengajuan->status == 'ditolak') bg-red-100 text-red-700
                                            @else bg-yellow-100 text-yellow-700 @endif">
                                            {{ ucfirst($pengajuan->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                        Belum ada pengajuan surat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- CDN Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('grafikPengajuan').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Jumlah Pengajuan',
                    data: @json($data),
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59,130,246,0.2)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>

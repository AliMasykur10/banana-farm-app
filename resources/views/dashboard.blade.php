<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="rounded-lg bg-white p-6 text-center shadow-sm">
                    <p class="text-xs text-gray-500">Pemasukan Bulan Ini</p>
                    <p class="mt-1 text-xl font-bold text-green-600">Rp
                        {{ number_format($totalPemasukanBulanIni, 0, ',', '.') }}</p>
                </div>
                <div class="rounded-lg bg-white p-6 text-center shadow-sm">
                    <p class="text-xs text-gray-500">Pengeluaran Bulan Ini</p>
                    <p class="mt-1 text-xl font-bold text-red-600">Rp
                        {{ number_format($totalPengeluaranBulanIni, 0, ',', '.') }}</p>
                </div>
                <div class="rounded-lg bg-white p-6 text-center shadow-sm">
                    <p class="text-xs text-gray-500">Profit Bulan Ini</p>
                    @php $profitBulanIni = $totalPemasukanBulanIni - $totalPengeluaranBulanIni; @endphp
                    <p class="{{ $profitBulanIni >= 0 ? 'text-green-600' : 'text-red-600' }} mt-1 text-xl font-bold">
                        Rp {{ number_format($profitBulanIni, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <div class="rounded-xl border border-line bg-surface p-6 lg:col-span-2">
                    <h3 class="mb-4 font-medium text-ink">Tren Keuangan 6 Bulan Terakhir</h3>
                    <canvas height="100" id="trendChart"></canvas>
                </div>
                <div class="rounded-xl border border-line bg-surface p-6">
                    <h3 class="mb-4 font-medium text-ink">Pengeluaran Bulan Ini</h3>
                    @if ($breakdownKategori->count() > 0)
                        <canvas height="220" id="kategoriChart"></canvas>
                    @else
                        <p class="py-12 text-center text-sm text-ink-muted">Belum ada pengeluaran bulan ini.</p>
                    @endif
                </div>
            </div>

            <div class="rounded-lg bg-white p-6 shadow-sm">
                <h3 class="mb-4 font-medium">Ringkasan Lahan</h3>
                <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                    @forelse ($lahans as $lahan)
                        <a class="rounded border p-3 text-sm hover:bg-gray-50"
                            href="{{ route('lahans.show', $lahan) }}">
                            <p class="font-medium">{{ $lahan->nama }}</p>
                            <p class="text-gray-500">
                                Fase: {{ str_replace('_', ' ', ucfirst($lahan->fase_saat_ini)) }} —
                                {{ $lahan->transactions_count }} transaksi
                            </p>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500">Belum ada lahan.</p>
                    @endforelse
                </div>
            </div>

            @if ($jadwalTerlewat->count() > 0)
                <div class="rounded-lg border border-red-200 bg-red-50 p-6">
                    <h3 class="mb-4 font-medium text-red-800">⚠ Jadwal Terlewat ({{ $jadwalTerlewat->count() }})</h3>
                    <div class="space-y-2">
                        @foreach ($jadwalTerlewat as $jadwal)
                            <a class="block text-sm hover:underline" href="{{ route('schedules.show', $jadwal) }}">
                                {{ $jadwal->jenis }} — {{ $jadwal->lahan->nama }} (harusnya
                                {{ $jadwal->next_date->format('d M Y') }})
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <h3 class="mb-4 font-medium">Trouble Aktif ({{ $troubleAktif->count() }})</h3>
                    <div class="space-y-2">
                        @forelse ($troubleAktif as $trouble)
                            <a class="block text-sm hover:underline"
                                href="{{ route('trouble-reports.show', $trouble) }}">
                                <span class="font-medium">{{ $trouble->judul }}</span>
                                <span class="text-gray-500">— {{ $trouble->lahan->nama }}
                                    ({{ $trouble->status }})
                                </span>
                            </a>
                        @empty
                            <p class="text-sm text-gray-500">Tidak ada masalah aktif.</p>
                        @endforelse
                    </div>
                    <a class="mt-3 inline-block text-xs text-blue-600 hover:underline"
                        href="{{ route('trouble-reports.index') }}">Lihat semua &rarr;</a>
                </div>

                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <h3 class="mb-4 font-medium">Jadwal Mendatang</h3>
                    <div class="space-y-2">
                        @forelse ($jadwalMendatang as $jadwal)
                            <a class="block text-sm hover:underline" href="{{ route('schedules.show', $jadwal) }}">
                                <span class="font-medium">{{ $jadwal->jenis }}</span>
                                <span class="text-gray-500">— {{ $jadwal->lahan->nama }}
                                    ({{ $jadwal->next_date->format('d M Y') }})
                                </span>
                            </a>
                        @empty
                            <p class="text-sm text-gray-500">Tidak ada jadwal mendatang.</p>
                        @endforelse
                    </div>
                    <a class="mt-3 inline-block text-xs text-blue-600 hover:underline"
                        href="{{ route('schedules.index') }}">Lihat semua &rarr;</a>
                </div>
            </div>

            <div class="rounded-lg bg-white p-6 shadow-sm">
                <h3 class="mb-4 font-medium">Log Perkembangan Terbaru</h3>
                <div class="space-y-2">
                    @forelse ($progressTerbaru as $log)
                        <a class="block text-sm hover:underline" href="{{ route('progress-logs.show', $log) }}">
                            <span class="font-medium">{{ $log->lahan->nama }}</span>
                            <span class="text-gray-500">— {{ $log->tanggal->format('d M Y') }} oleh
                                {{ $log->user->name }}</span>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500">Belum ada log perkembangan.</p>
                    @endforelse
                </div>
                <a class="mt-3 inline-block text-xs text-blue-600 hover:underline"
                    href="{{ route('progress-logs.index') }}">Lihat semua &rarr;</a>
            </div>

        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Grafik tren keuangan
                new Chart(document.getElementById('trendChart'), {
                    type: 'line',
                    data: {
                        labels: @json($trendLabels),
                        datasets: [{
                                label: 'Pemasukan',
                                data: @json($trendPemasukan),
                                borderColor: '#2F7A4D',
                                backgroundColor: '#2F7A4D20',
                                tension: 0.3,
                                fill: true,
                            },
                            {
                                label: 'Pengeluaran',
                                data: @json($trendPengeluaran),
                                borderColor: '#B3413A',
                                backgroundColor: '#B3413A20',
                                tension: 0.3,
                                fill: true,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        },
                        scales: {
                            y: {
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + (value / 1000) + 'rb';
                                    }
                                }
                            }
                        }
                    }
                });

                // Grafik breakdown kategori
                @if ($breakdownKategori->count() > 0)
                    new Chart(document.getElementById('kategoriChart'), {
                        type: 'doughnut',
                        data: {
                            labels: @json($breakdownKategori->keys()),
                            datasets: [{
                                data: @json($breakdownKategori->values()),
                                backgroundColor: ['#2F5233', '#B8863A', '#B3413A', '#6B7268', '#2F7A4D',
                                    '#3B7A9E'
                                ],
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        boxWidth: 12,
                                        font: {
                                            size: 11
                                        }
                                    }
                                }
                            }
                        }
                    });
                @endif
            });
        </script>
    @endpush
</x-app-layout>

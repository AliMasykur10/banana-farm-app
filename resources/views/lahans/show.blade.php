<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $lahan->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">

                <div>
                    <span class="px-2 py-1 text-xs rounded bg-gray-200 dark:bg-gray-700">
                        Fase: {{ str_replace('_', ' ', $lahan->fase_saat_ini) }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div><span class="text-gray-500">Luas:</span> {{ $lahan->luas_panjang_m }} x {{ $lahan->luas_lebar_m }} m</div>
                    <div><span class="text-gray-500">Estimasi Pohon:</span> {{ $lahan->estimasi_jumlah_pohon }}</div>
                    <div><span class="text-gray-500">Jarak Tanam:</span> {{ $lahan->jarak_tanam_m }} m</div>
                    <div><span class="text-gray-500">Jarak Pagar:</span> {{ $lahan->jarak_pagar_m }} m</div>
                </div>

                @if ($lahan->activeAgreement)
                    <div class="border-t pt-4 dark:border-gray-700">
                        <h3 class="font-medium mb-2">Kesepakatan Aktif</h3>
                        <p class="text-sm">Skema: {{ $lahan->activeAgreement->skema }} — Partner: {{ $lahan->activeAgreement->partner->nama ?? '-' }}</p>
                    </div>
                @endif

                @if ($lahan->troubleReports->count() > 0)
                    <div class="border-t pt-4 dark:border-gray-700">
                        <h3 class="font-medium mb-2 text-red-600">Trouble Aktif ({{ $lahan->troubleReports->count() }})</h3>
                        @foreach ($lahan->troubleReports as $trouble)
                            <p class="text-sm">{{ $trouble->judul }} — {{ $trouble->status }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="border-t pt-4 dark:border-gray-700">
                    <a href="{{ route('lahans.index') }}" class="text-blue-600 hover:underline">&larr; Kembali ke daftar</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
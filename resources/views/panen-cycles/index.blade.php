<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Siklus Panen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">

                @if (session('success'))
                    <div class="mb-4 rounded bg-green-100 p-4 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-4 flex justify-end">
                    <a class="rounded bg-gray-800 px-4 py-2 text-white hover:bg-gray-700"
                        href="{{ route('panen-cycles.create') }}">
                        + Catat Panen Baru
                    </a>
                </div>

                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Lahan</th>
                            <th class="py-2">Siklus</th>
                            <th class="py-2">Tanggal Panen</th>
                            <th class="py-2">Pohon Produktif</th>
                            <th class="py-2">Hasil (kg)</th>
                            <th class="py-2">Total Pemasukan</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($panenCycles as $cycle)
                            <tr class="border-b">
                                <td class="py-2">{{ $cycle->lahan->nama }}</td>
                                <td class="py-2">#{{ $cycle->nomor_siklus }}</td>
                                <td class="py-2">{{ $cycle->tanggal_panen->format('d M Y') }}</td>
                                <td class="py-2">{{ $cycle->jumlah_pohon_produktif }}</td>
                                <td class="py-2">{{ number_format($cycle->total_hasil_kg, 1) }} kg</td>
                                <td class="py-2">Rp {{ number_format($cycle->total_pemasukan, 0, ',', '.') }}</td>
                                <td class="space-x-2 py-2">
                                    <a class="text-blue-600 hover:underline"
                                        href="{{ route('panen-cycles.show', $cycle) }}">Lihat</a>
                                    <form action="{{ route('panen-cycles.destroy', $cycle) }}" class="inline"
                                        method="POST"
                                        onsubmit="return confirm('Yakin hapus siklus panen ini? Transaksi terkait juga akan dihapus.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline" type="submit">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-4 text-center text-gray-500" colspan="7">Belum ada siklus panen
                                    tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>

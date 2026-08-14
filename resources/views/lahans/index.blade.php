<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Lahan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-end mb-4">
                    <a href="{{ route('lahans.create') }}" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
                        + Tambah Lahan
                    </a>
                </div>

                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b dark:border-gray-700">
                            <th class="py-2">Nama</th>
                            <th class="py-2">Luas</th>
                            <th class="py-2">Estimasi Pohon</th>
                            <th class="py-2">Fase</th>
                            <th class="py-2">Jumlah Transaksi</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lahans as $lahan)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2">
                                    <a href="{{ route('lahans.show', $lahan) }}" class="text-blue-600 hover:underline">
                                        {{ $lahan->nama }}
                                    </a>
                                </td>
                                <td class="py-2">{{ $lahan->luas_panjang_m }} x {{ $lahan->luas_lebar_m }} m</td>
                                <td class="py-2">{{ $lahan->estimasi_jumlah_pohon }}</td>
                                <td class="py-2">
                                    <span class="px-2 py-1 text-xs rounded bg-gray-200 dark:bg-gray-700">
                                        {{ str_replace('_', ' ', $lahan->fase_saat_ini) }}
                                    </span>
                                </td>
                                <td class="py-2">{{ $lahan->transactions_count }}</td>
                                <td class="py-2 space-x-2">
                                    <a href="{{ route('lahans.edit', $lahan) }}" class="text-yellow-600 hover:underline">Edit</a>
                                    <form action="{{ route('lahans.destroy', $lahan) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus lahan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">Belum ada lahan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
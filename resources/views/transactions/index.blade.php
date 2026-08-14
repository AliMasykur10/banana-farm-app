<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Transaksi Keuangan
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
                    <a href="{{ route('transactions.create') }}" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
                        + Catat Transaksi
                    </a>
                </div>

                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b dark:border-gray-700">
                            <th class="py-2">Tanggal</th>
                            <th class="py-2">Lahan</th>
                            <th class="py-2">Jenis</th>
                            <th class="py-2">Kategori</th>
                            <th class="py-2">Jumlah</th>
                            <th class="py-2">Kas?</th>
                            <th class="py-2">Dicatat oleh</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-2">{{ $transaction->tanggal->format('d M Y') }}</td>
                                <td class="py-2">{{ $transaction->lahan->nama }}</td>
                                <td class="py-2">
                                    <span class="px-2 py-1 text-xs rounded {{ $transaction->jenis === 'pemasukan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($transaction->jenis) }}
                                    </span>
                                </td>
                                <td class="py-2">{{ $transaction->kategori }}</td>
                                <td class="py-2">Rp {{ number_format($transaction->jumlah, 0, ',', '.') }}</td>
                                <td class="py-2">{{ $transaction->is_cash ? 'Ya' : 'Non-kas' }}</td>
                                <td class="py-2">{{ $transaction->user->name }}</td>
                                <td class="py-2 space-x-2">
                                    <a href="{{ route('transactions.edit', $transaction) }}" class="text-yellow-600 hover:underline">Edit</a>
                                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-4 text-center text-gray-500">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $transactions->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
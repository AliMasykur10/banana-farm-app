<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Catat Transaksi Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium">Lahan</label>
                        <select name="lahan_id" class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700">
                            @foreach ($lahans as $lahan)
                                <option value="{{ $lahan->id }}" {{ old('lahan_id') == $lahan->id ? 'selected' : '' }}>
                                    {{ $lahan->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('lahan_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Jenis</label>
                        <select name="jenis" class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700">
                            <option value="pengeluaran" {{ old('jenis') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                            <option value="pemasukan" {{ old('jenis') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                        </select>
                        @error('jenis') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Kategori</label>
                        <input type="text" name="kategori" value="{{ old('kategori') }}" placeholder="mis. pupuk, tenaga kerja, sewa lahan, penjualan panen" class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700">
                        @error('kategori') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Jumlah (Rp)</label>
                        <input type="number" step="0.01" name="jumlah" value="{{ old('jumlah') }}" class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700">
                        @error('jumlah') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700">
                        @error('tanggal') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="hidden" name="is_cash" value="0">
                        <input type="checkbox" name="is_cash" value="1" id="is_cash" {{ old('is_cash', '1') == '1' ? 'checked' : '' }} class="rounded border-gray-300">
                        <label for="is_cash" class="ml-2 text-sm">Transaksi kas (uang benar-benar keluar/masuk)</label>
                    </div>
                    <p class="text-xs text-gray-500 -mt-2">Uncheck kalau ini transaksi non-kas, misal bibit hibah atau anakan yang dipindah ke lahan lain dengan nilai estimasi.</p>

                    <div>
                        <label class="block text-sm font-medium">Keterangan</label>
                        <textarea name="keterangan" rows="3" class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700">{{ old('keterangan') }}</textarea>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('transactions.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
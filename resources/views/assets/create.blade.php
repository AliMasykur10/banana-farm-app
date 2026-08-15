<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Tambah Aset
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">

                <form action="{{ route('assets.store') }}" class="space-y-4" method="POST">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium">Nama Aset</label>
                        <input class="mt-1 block w-full rounded border-gray-300" name="nama"
                            placeholder="mis. Pompa Sibel" type="text" value="{{ old('nama') }}">
                        @error('nama')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Jenis</label>
                        <input class="mt-1 block w-full rounded border-gray-300" name="jenis"
                            placeholder="mis. Pengairan, Alat Semprot" type="text" value="{{ old('jenis') }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Tanggal Beli</label>
                        <input class="mt-1 block w-full rounded border-gray-300" name="tanggal_beli" type="date"
                            value="{{ old('tanggal_beli', date('Y-m-d')) }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Harga Beli (Rp)</label>
                        <input class="mt-1 block w-full rounded border-gray-300" name="harga_beli" step="0.01"
                            type="number" value="{{ old('harga_beli') }}">
                        <p class="mt-1 text-xs text-gray-500">Kalau diisi, otomatis tercatat sebagai transaksi
                            pengeluaran kategori "Aset" di lahan pertama yang dipilih di bawah.</p>
                        @error('harga_beli')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Kondisi</label>
                        <select class="mt-1 block w-full rounded border-gray-300" name="kondisi">
                            <option {{ old('kondisi', 'baik') == 'baik' ? 'selected' : '' }} value="baik">Baik
                            </option>
                            <option {{ old('kondisi') == 'rusak' ? 'selected' : '' }} value="rusak">Rusak</option>
                            <option {{ old('kondisi') == 'perlu_servis' ? 'selected' : '' }} value="perlu_servis">Perlu
                                Servis</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium">Digunakan di Lahan</label>
                        <div class="space-y-1">
                            @foreach ($lahans as $lahan)
                                <label class="flex items-center text-sm">
                                    <input {{ in_array($lahan->id, old('lahan_ids', [])) ? 'checked' : '' }}
                                        class="mr-2 rounded border-gray-300" name="lahan_ids[]" type="checkbox"
                                        value="{{ $lahan->id }}">
                                    {{ $lahan->nama }}
                                </label>
                            @endforeach
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Kalau dipilih lebih dari satu, porsi pemakaian otomatis
                            dibagi rata.</p>
                        @error('lahan_ids')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a class="rounded bg-gray-200 px-4 py-2" href="{{ route('assets.index') }}">Batal</a>
                        <button class="rounded bg-gray-800 px-4 py-2 text-white hover:bg-gray-700"
                            type="submit">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

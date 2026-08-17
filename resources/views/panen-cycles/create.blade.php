<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Catat Panen Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">

                <form action="{{ route('panen-cycles.store') }}" class="space-y-6" method="POST" x-data="{ adaAnakan: false, jenisNasib: [] }">
                    @csrf

                    <div>
                        <h3 class="mb-3 font-medium">Data Panen</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium">Lahan</label>
                                <select class="mt-1 block w-full rounded border-gray-300" name="lahan_id">
                                    @foreach ($lahans as $lahan)
                                        <option {{ old('lahan_id') == $lahan->id ? 'selected' : '' }}
                                            value="{{ $lahan->id }}">
                                            {{ $lahan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('lahan_id')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium">Nomor Siklus</label>
                                    <input class="mt-1 block w-full rounded border-gray-300" min="1"
                                        name="nomor_siklus" type="number" value="{{ old('nomor_siklus', 1) }}">
                                    @error('nomor_siklus')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium">Tanggal Panen</label>
                                    <input class="mt-1 block w-full rounded border-gray-300" name="tanggal_panen"
                                        type="date" value="{{ old('tanggal_panen', date('Y-m-d')) }}">
                                    @error('tanggal_panen')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium">Jumlah Pohon Produktif Siklus Ini</label>
                                <input class="mt-1 block w-full rounded border-gray-300" min="0"
                                    name="jumlah_pohon_produktif" type="number"
                                    value="{{ old('jumlah_pohon_produktif') }}">
                                @error('jumlah_pohon_produktif')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium">Total Hasil (kg)</label>
                                    <input class="mt-1 block w-full rounded border-gray-300" name="total_hasil_kg"
                                        step="0.1" type="number" value="{{ old('total_hasil_kg') }}">
                                    @error('total_hasil_kg')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium">Harga per Kg (Rp)</label>
                                    <input class="mt-1 block w-full rounded border-gray-300" name="harga_per_kg"
                                        step="0.01" type="number" value="{{ old('harga_per_kg') }}">
                                    @error('harga_per_kg')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <p class="text-xs text-gray-500">Total pemasukan dihitung otomatis (hasil kg × harga per kg)
                                dan langsung tercatat sebagai transaksi.</p>
                        </div>
                    </div>

                    <div class="border-t pt-6">
                        <label class="mb-3 flex items-center">
                            <input class="mr-2 rounded border-gray-300" type="checkbox" x-model="adaAnakan">
                            <span class="font-medium">Ada data anakan untuk siklus ini</span>
                        </label>

                        <div class="space-y-4 border-l-2 pl-2" x-show="adaAnakan">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium">Jumlah Anakan Muncul</label>
                                    <input class="mt-1 block w-full rounded border-gray-300" min="0"
                                        name="jumlah_muncul" type="number" value="{{ old('jumlah_muncul') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium">Disisakan (siklus berikutnya)</label>
                                    <input class="mt-1 block w-full rounded border-gray-300" min="0"
                                        name="jumlah_disisakan" type="number" value="{{ old('jumlah_disisakan') }}">
                                </div>
                            </div>

                            <div class="space-y-2 rounded border p-3">
                                <p class="text-sm font-medium">Dijual sebagai bibit</p>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs text-gray-500">Jumlah Dijual</label>
                                        <input class="mt-1 block w-full rounded border-gray-300 text-sm" min="0"
                                            name="jumlah_dijual" type="number" value="{{ old('jumlah_dijual') }}">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500">Harga per Batang (Rp)</label>
                                        <input class="mt-1 block w-full rounded border-gray-300 text-sm"
                                            name="harga_jual_per_batang" step="0.01" type="number"
                                            value="{{ old('harga_jual_per_batang') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2 rounded border p-3">
                                <p class="text-sm font-medium">Dipindah ke lahan lain</p>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs text-gray-500">Jumlah Dipindah</label>
                                        <input class="mt-1 block w-full rounded border-gray-300 text-sm" min="0"
                                            name="jumlah_dipindah_lahan_lain" type="number"
                                            value="{{ old('jumlah_dipindah_lahan_lain') }}">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-500">Nilai Estimasi per Batang
                                            (Rp)</label>
                                        <input class="mt-1 block w-full rounded border-gray-300 text-sm"
                                            name="nilai_estimasi_per_batang" step="0.01" type="number"
                                            value="{{ old('nilai_estimasi_per_batang') }}">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-500">Lahan Tujuan</label>
                                    <select class="mt-1 block w-full rounded border-gray-300 text-sm"
                                        name="lahan_tujuan_id">
                                        <option value="">- Pilih lahan tujuan -</option>
                                        @foreach ($lahans as $lahan)
                                            <option {{ old('lahan_tujuan_id') == $lahan->id ? 'selected' : '' }}
                                                value="{{ $lahan->id }}">
                                                {{ $lahan->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="text-xs text-gray-500">Ini akan tercatat sebagai transaksi non-kas (nilai
                                    estimasi) di lahan tujuan.</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium">Jumlah Dibuang / Jadi Pupuk</label>
                                <input class="mt-1 block w-full rounded border-gray-300" min="0"
                                    name="jumlah_dibuang" type="number" value="{{ old('jumlah_dibuang') }}">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2 border-t pt-6">
                        <a class="rounded bg-gray-200 px-4 py-2" href="{{ route('panen-cycles.index') }}">Batal</a>
                        <button class="rounded bg-gray-800 px-4 py-2 text-white hover:bg-gray-700"
                            type="submit">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

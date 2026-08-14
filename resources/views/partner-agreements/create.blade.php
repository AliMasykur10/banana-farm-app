<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Kesepakatan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('partner-agreements.store') }}" method="POST" class="space-y-4" x-data="{ skema: 'sewa' }">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium">Partner</label>
                        <select name="partner_id" class="mt-1 block w-full rounded border-gray-300">
                            @foreach ($partners as $partner)
                                <option value="{{ $partner->id }}" {{ old('partner_id', request('partner_id')) == $partner->id ? 'selected' : '' }}>
                                    {{ $partner->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('partner_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Lahan</label>
                        <select name="lahan_id" class="mt-1 block w-full rounded border-gray-300">
                            @foreach ($lahans as $lahan)
                                <option value="{{ $lahan->id }}" {{ old('lahan_id') == $lahan->id ? 'selected' : '' }}>
                                    {{ $lahan->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('lahan_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Skema</label>
                        <select name="skema" x-model="skema" class="mt-1 block w-full rounded border-gray-300">
                            <option value="sewa">Sewa</option>
                            <option value="bagi_hasil">Bagi Hasil</option>
                        </select>
                        @error('skema') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div x-show="skema === 'sewa'">
                        <label class="block text-sm font-medium">Nominal Sewa (Rp)</label>
                        <input type="number" step="0.01" name="nominal_sewa" value="{{ old('nominal_sewa') }}" class="mt-1 block w-full rounded border-gray-300">
                        @error('nominal_sewa') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div x-show="skema === 'bagi_hasil'">
                        <label class="block text-sm font-medium">Persentase Bagi Hasil (%)</label>
                        <input type="number" step="0.01" name="persentase_bagi_hasil" value="{{ old('persentase_bagi_hasil') }}" class="mt-1 block w-full rounded border-gray-300">
                        @error('persentase_bagi_hasil') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', date('Y-m-d')) }}" class="mt-1 block w-full rounded border-gray-300">
                        @error('tanggal_mulai') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <p class="text-xs text-gray-500">Catatan: kalau lahan yang dipilih sudah punya kesepakatan aktif sebelumnya, kesepakatan lama akan otomatis ditandai berakhir dan digantikan yang baru ini.</p>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Tambah Jadwal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">

                <form action="{{ route('schedules.store') }}" class="space-y-4" method="POST">
                    @csrf

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

                    <div>
                        <label class="block text-sm font-medium">Jenis Kegiatan</label>
                        <input class="mt-1 block w-full rounded border-gray-300" name="jenis"
                            placeholder="mis. Pemupukan, Semprot Obat, Cek Rutin" type="text"
                            value="{{ old('jenis') }}">
                        @error('jenis')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Pola Berulang (opsional)</label>
                        <select class="mt-1 block w-full rounded border-gray-300" name="recurring_pattern">
                            <option value="">Tidak berulang (sekali saja)</option>
                            <option {{ old('recurring_pattern') == 'harian' ? 'selected' : '' }} value="harian">Harian
                            </option>
                            <option {{ old('recurring_pattern') == 'mingguan' ? 'selected' : '' }} value="mingguan">
                                Mingguan</option>
                            <option {{ old('recurring_pattern') == 'dua_mingguan' ? 'selected' : '' }}
                                value="dua_mingguan">2 Mingguan</option>
                            <option {{ old('recurring_pattern') == 'bulanan' ? 'selected' : '' }} value="bulanan">
                                Bulanan</option>
                        </select>
                        @error('recurring_pattern')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Tanggal Jadwal Berikutnya</label>
                        <input class="mt-1 block w-full rounded border-gray-300" name="next_date" type="date"
                            value="{{ old('next_date', date('Y-m-d')) }}">
                        @error('next_date')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a class="rounded bg-gray-200 px-4 py-2" href="{{ route('schedules.index') }}">Batal</a>
                        <button class="rounded bg-gray-800 px-4 py-2 text-white hover:bg-gray-700"
                            type="submit">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Tambah Lahan Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">

                <form action="{{ route('lahans.store') }}" class="space-y-4" method="POST">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium">Nama Lahan</label>
                        <input class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700" name="nama"
                            type="text" value="{{ old('nama') }}">
                        @error('nama')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Panjang (m)</label>
                            <input class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700"
                                name="luas_panjang_m" step="0.01" type="number" value="{{ old('luas_panjang_m') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Lebar (m)</label>
                            <input class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700"
                                name="luas_lebar_m" step="0.01" type="number" value="{{ old('luas_lebar_m') }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Jarak Tanam (m)</label>
                            <input class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700"
                                name="jarak_tanam_m" step="0.01" type="number" value="{{ old('jarak_tanam_m') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Jarak dari Pagar (m)</label>
                            <input class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700"
                                name="jarak_pagar_m" step="0.01" type="number" value="{{ old('jarak_pagar_m') }}">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Estimasi Jumlah Pohon</label>
                        <input class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700"
                            name="estimasi_jumlah_pohon" type="number" value="{{ old('estimasi_jumlah_pohon') }}">
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a class="rounded bg-gray-200 px-4 py-2 dark:bg-gray-700"
                            href="{{ route('lahans.index') }}">Batal</a>
                        <button class="rounded bg-gray-800 px-4 py-2 text-white hover:bg-gray-700"
                            type="submit">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

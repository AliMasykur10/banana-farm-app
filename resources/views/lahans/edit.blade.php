<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Lahan: {{ $lahan->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('lahans.update', $lahan) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium">Nama Lahan</label>
                        <input type="text" name="nama" value="{{ old('nama', $lahan->nama) }}" class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700">
                        @error('nama') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Panjang (m)</label>
                            <input type="number" step="0.01" name="luas_panjang_m" value="{{ old('luas_panjang_m', $lahan->luas_panjang_m) }}" class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Lebar (m)</label>
                            <input type="number" step="0.01" name="luas_lebar_m" value="{{ old('luas_lebar_m', $lahan->luas_lebar_m) }}" class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Jarak Tanam (m)</label>
                            <input type="number" step="0.01" name="jarak_tanam_m" value="{{ old('jarak_tanam_m', $lahan->jarak_tanam_m) }}" class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Jarak dari Pagar (m)</label>
                            <input type="number" step="0.01" name="jarak_pagar_m" value="{{ old('jarak_pagar_m', $lahan->jarak_pagar_m) }}" class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Estimasi Jumlah Pohon</label>
                        <input type="number" name="estimasi_jumlah_pohon" value="{{ old('estimasi_jumlah_pohon', $lahan->estimasi_jumlah_pohon) }}" class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700">
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('lahans.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
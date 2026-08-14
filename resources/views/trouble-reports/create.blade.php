<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lapor Masalah
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('trouble-reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

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
                        <label class="block text-sm font-medium">Judul Masalah</label>
                        <input type="text" name="judul" value="{{ old('judul') }}" placeholder="mis. Hama daun, pompa mati, tanaman layu" class="mt-1 block w-full rounded border-gray-300">
                        @error('judul') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Tingkat Urgensi</label>
                        <select name="urgensi" class="mt-1 block w-full rounded border-gray-300">
                            <option value="rendah" {{ old('urgensi') == 'rendah' ? 'selected' : '' }}>Rendah</option>
                            <option value="sedang" {{ old('urgensi', 'sedang') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="tinggi" {{ old('urgensi') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                        </select>
                        @error('urgensi') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" class="mt-1 block w-full rounded border-gray-300">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Foto (bisa lebih dari satu)</label>
                        <input type="file" name="foto[]" multiple accept="image/*" class="mt-1 block w-full">
                        @error('foto.*') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('trouble-reports.index') }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">Kirim Laporan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
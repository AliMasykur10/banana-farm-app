<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Partner
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('partners.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium">Tipe Partner</label>
                        <select name="tipe" class="mt-1 block w-full rounded border-gray-300">
                            <option value="penyedia_pembeli" {{ old('tipe') == 'penyedia_pembeli' ? 'selected' : '' }}>Penyedia Bibit & Pembeli</option>
                            <option value="pemilik_lahan" {{ old('tipe') == 'pemilik_lahan' ? 'selected' : '' }}>Pemilik Lahan</option>
                        </select>
                        @error('tipe') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" class="mt-1 block w-full rounded border-gray-300">
                        @error('nama') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Kontak</label>
                        <input type="text" name="kontak" value="{{ old('kontak') }}" placeholder="No. HP / email" class="mt-1 block w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Catatan</label>
                        <textarea name="catatan" rows="3" class="mt-1 block w-full rounded border-gray-300">{{ old('catatan') }}</textarea>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('partners.index') }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Aset
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">

                <form action="{{ route('assets.update', $asset) }}" class="space-y-4" method="POST">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium">Nama Aset</label>
                        <input class="mt-1 block w-full rounded border-gray-300" name="nama" type="text"
                            value="{{ old('nama', $asset->nama) }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Jenis</label>
                        <input class="mt-1 block w-full rounded border-gray-300" name="jenis" type="text"
                            value="{{ old('jenis', $asset->jenis) }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Kondisi</label>
                        <select class="mt-1 block w-full rounded border-gray-300" name="kondisi">
                            <option {{ old('kondisi', $asset->kondisi) == 'baik' ? 'selected' : '' }} value="baik">
                                Baik</option>
                            <option {{ old('kondisi', $asset->kondisi) == 'rusak' ? 'selected' : '' }} value="rusak">
                                Rusak</option>
                            <option {{ old('kondisi', $asset->kondisi) == 'perlu_servis' ? 'selected' : '' }}
                                value="perlu_servis">Perlu Servis</option>
                        </select>
                    </div>

                    <p class="text-xs text-gray-500">Harga beli dan alokasi lahan tidak bisa diubah di sini — hapus dan
                        buat ulang aset kalau perlu koreksi besar.</p>

                    <div class="flex justify-end space-x-2">
                        <a class="rounded bg-gray-200 px-4 py-2" href="{{ route('assets.index') }}">Batal</a>
                        <button class="rounded bg-gray-800 px-4 py-2 text-white hover:bg-gray-700"
                            type="submit">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

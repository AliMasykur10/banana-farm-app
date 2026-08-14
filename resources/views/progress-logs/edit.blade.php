<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Log Perkembangan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('progress-logs.update', $progressLog) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium">Lahan</label>
                        <select name="lahan_id" class="mt-1 block w-full rounded border-gray-300">
                            @foreach ($lahans as $lahan)
                                <option value="{{ $lahan->id }}" {{ old('lahan_id', $progressLog->lahan_id) == $lahan->id ? 'selected' : '' }}>
                                    {{ $lahan->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $progressLog->tanggal->format('Y-m-d')) }}" class="mt-1 block w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Keterangan</label>
                        <textarea name="keterangan" rows="4" class="mt-1 block w-full rounded border-gray-300">{{ old('keterangan', $progressLog->keterangan) }}</textarea>
                    </div>

                    @if (!empty($progressLog->foto_urls))
                        <div>
                            <label class="block text-sm font-medium mb-1">Foto Saat Ini</label>
                            <div class="flex gap-2 flex-wrap">
                                @foreach ($progressLog->foto_urls as $foto)
                                    <img src="{{ Storage::url($foto) }}" class="w-20 h-20 object-cover rounded border">
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium">Tambah Foto Baru (opsional)</label>
                        <input type="file" name="foto[]" multiple accept="image/*" class="mt-1 block w-full">
                        <p class="text-xs text-gray-500 mt-1">Foto baru akan ditambahkan, foto lama tetap tersimpan.</p>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('progress-logs.index') }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
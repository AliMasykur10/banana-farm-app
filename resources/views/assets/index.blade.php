<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Aset
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">

                @if (session('success'))
                    <div class="mb-4 rounded bg-green-100 p-4 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-4 flex justify-end">
                    <a class="rounded bg-gray-800 px-4 py-2 text-white hover:bg-gray-700"
                        href="{{ route('assets.create') }}">
                        + Tambah Aset
                    </a>
                </div>

                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Nama</th>
                            <th class="py-2">Jenis</th>
                            <th class="py-2">Harga Beli</th>
                            <th class="py-2">Kondisi</th>
                            <th class="py-2">Digunakan di Lahan</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($assets as $asset)
                            <tr class="border-b">
                                <td class="py-2">
                                    <a class="text-blue-600 hover:underline"
                                        href="{{ route('assets.show', $asset) }}">{{ $asset->nama }}</a>
                                </td>
                                <td class="py-2">{{ $asset->jenis ?? '-' }}</td>
                                <td class="py-2">Rp {{ number_format($asset->harga_beli ?? 0, 0, ',', '.') }}</td>
                                <td class="py-2">
                                    <span @class([
                                        'px-2 py-1 text-xs rounded',
                                        'bg-green-100 text-green-800' => $asset->kondisi === 'baik',
                                        'bg-red-100 text-red-800' => $asset->kondisi === 'rusak',
                                        'bg-yellow-100 text-yellow-800' => $asset->kondisi === 'perlu_servis',
                                    ])>
                                        {{ str_replace('_', ' ', ucfirst($asset->kondisi)) }}
                                    </span>
                                </td>
                                <td class="py-2">
                                    {{ $asset->allocations->pluck('lahan.nama')->join(', ') }}
                                </td>
                                <td class="space-x-2 py-2">
                                    <a class="text-yellow-600 hover:underline"
                                        href="{{ route('assets.edit', $asset) }}">Edit</a>
                                    <form action="{{ route('assets.destroy', $asset) }}" class="inline" method="POST"
                                        onsubmit="return confirm('Yakin hapus aset ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline" type="submit">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-4 text-center text-gray-500" colspan="6">Belum ada aset.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>

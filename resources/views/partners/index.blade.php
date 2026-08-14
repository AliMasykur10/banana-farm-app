<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Partner
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-end mb-4">
                    <a href="{{ route('partners.create') }}" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
                        + Tambah Partner
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse ($partners as $partner)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-medium">{{ $partner->nama }}</p>
                                    <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-800">
                                        {{ $partner->tipe === 'penyedia_pembeli' ? 'Penyedia Bibit & Pembeli' : 'Pemilik Lahan' }}
                                    </span>
                                    @if ($partner->kontak)
                                        <p class="text-sm text-gray-500 mt-1">{{ $partner->kontak }}</p>
                                    @endif
                                </div>
                                <div class="space-x-2 text-sm">
                                    <a href="{{ route('partners.show', $partner) }}" class="text-blue-600 hover:underline">Lihat</a>
                                    <a href="{{ route('partners.edit', $partner) }}" class="text-yellow-600 hover:underline">Edit</a>
                                    <form action="{{ route('partners.destroy', $partner) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus partner ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </div>

                            @if ($partner->agreements->where('is_active', true)->count() > 0)
                                <div class="mt-3 pt-3 border-t text-sm">
                                    <p class="text-gray-500 mb-1">Kesepakatan aktif:</p>
                                    @foreach ($partner->agreements->where('is_active', true) as $agreement)
                                        <p>
                                            {{ $agreement->lahan->nama }} —
                                            {{ $agreement->skema === 'sewa' ? 'Sewa Rp ' . number_format($agreement->nominal_sewa, 0, ',', '.') : 'Bagi hasil ' . $agreement->persentase_bagi_hasil . '%' }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">Belum ada partner.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Nominal Kesepakatan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-4 text-sm text-gray-500">
                    <p>Lahan: {{ $partnerAgreement->lahan->nama }}</p>
                    <p>Partner: {{ $partnerAgreement->partner->nama }}</p>
                    <p>Skema: {{ $partnerAgreement->skema === 'sewa' ? 'Sewa' : 'Bagi Hasil' }}</p>
                </div>

                <form action="{{ route('partner-agreements.update', $partnerAgreement) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    @if ($partnerAgreement->skema === 'sewa')
                        <div>
                            <label class="block text-sm font-medium">Nominal Sewa (Rp)</label>
                            <input type="number" step="0.01" name="nominal_sewa" value="{{ old('nominal_sewa', $partnerAgreement->nominal_sewa) }}" class="mt-1 block w-full rounded border-gray-300">
                            @error('nominal_sewa') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>
                    @else
                        <div>
                            <label class="block text-sm font-medium">Persentase Bagi Hasil (%)</label>
                            <input type="number" step="0.01" name="persentase_bagi_hasil" value="{{ old('persentase_bagi_hasil', $partnerAgreement->persentase_bagi_hasil) }}" class="mt-1 block w-full rounded border-gray-300">
                            @error('persentase_bagi_hasil') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>
                    @endif

                    <p class="text-xs text-gray-500">Kalau skema kesepakatan berubah total (misal dari sewa jadi bagi hasil), buat kesepakatan baru lewat halaman Partner, bukan edit di sini — supaya riwayat kesepakatan lama tetap tersimpan.</p>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('partners.show', $partnerAgreement->partner) }}" class="px-4 py-2 bg-gray-200 rounded">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Progress Tracking
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
                    <a href="{{ route('progress-logs.create') }}" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
                        + Tambah Log
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse ($progressLogs as $log)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-medium">{{ $log->lahan->nama }} — {{ $log->tanggal->format('d M Y') }}</p>
                                    <p class="text-sm text-gray-500">Dicatat oleh {{ $log->user->name }}</p>
                                </div>
                                <div class="space-x-2 text-sm">
                                    <a href="{{ route('progress-logs.show', $log) }}" class="text-blue-600 hover:underline">Lihat</a>
                                    <a href="{{ route('progress-logs.edit', $log) }}" class="text-yellow-600 hover:underline">Edit</a>
                                    <form action="{{ route('progress-logs.destroy', $log) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus log ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </div>

                            @if ($log->keterangan)
                                <p class="mt-2 text-sm">{{ $log->keterangan }}</p>
                            @endif

                            @if (!empty($log->foto_urls))
                                <div class="mt-3 flex gap-2 flex-wrap">
                                    @foreach ($log->foto_urls as $foto)
                                        <img src="{{ Storage::url($foto) }}" class="w-20 h-20 object-cover rounded border">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">Belum ada log perkembangan.</p>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $progressLogs->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
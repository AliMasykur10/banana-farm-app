<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Trouble Report
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
                        href="{{ route('trouble-reports.create') }}">
                        + Lapor Masalah
                    </a>
                </div>

                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Lahan</th>
                            <th class="py-2">Judul</th>
                            <th class="py-2">Urgensi</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Dilaporkan oleh</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($troubleReports as $report)
                            <tr class="border-b">
                                <td class="py-2">{{ $report->lahan->nama }}</td>
                                <td class="py-2">
                                    <a class="text-blue-600 hover:underline"
                                        href="{{ route('trouble-reports.show', $report) }}">
                                        {{ $report->judul }}
                                    </a>
                                </td>
                                <td class="py-2">
                                    <span @class([
                                        'px-2 py-1 text-xs rounded',
                                        'bg-red-100 text-red-800' => $report->urgensi === 'tinggi',
                                        'bg-yellow-100 text-yellow-800' => $report->urgensi === 'sedang',
                                        'bg-gray-100 text-gray-800' => $report->urgensi === 'rendah',
                                    ])>
                                        {{ ucfirst($report->urgensi) }}
                                    </span>
                                </td>
                                <td class="py-2">
                                    <span @class([
                                        'px-2 py-1 text-xs rounded',
                                        'bg-gray-200 text-gray-800' => $report->status === 'dilaporkan',
                                        'bg-blue-100 text-blue-800' => $report->status === 'ditindaklanjuti',
                                        'bg-green-100 text-green-800' => $report->status === 'selesai',
                                    ])>
                                        {{ ucfirst(str_replace('_', ' ', $report->status)) }}
                                    </span>
                                </td>
                                <td class="py-2">{{ $report->user->name }}</td>
                                <td class="space-x-2 py-2">
                                    <a class="text-yellow-600 hover:underline"
                                        href="{{ route('trouble-reports.edit', $report) }}">Edit</a>
                                    <form action="{{ route('trouble-reports.destroy', $report) }}" class="inline"
                                        method="POST" onsubmit="return confirm('Yakin hapus laporan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline" type="submit">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-4 text-center text-gray-500" colspan="6">Belum ada laporan masalah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $troubleReports->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Jadwal & Reminder
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
                @if (session('error'))
                    <div class="mb-4 rounded bg-red-100 p-4 text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-4 flex justify-end">
                    <a class="rounded bg-gray-800 px-4 py-2 text-white hover:bg-gray-700"
                        href="{{ route('schedules.create') }}">
                        + Tambah Jadwal
                    </a>
                </div>

                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Lahan</th>
                            <th class="py-2">Jenis</th>
                            <th class="py-2">Pola Berulang</th>
                            <th class="py-2">Jadwal Berikutnya</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedule)
                            <tr
                                class="{{ $schedule->next_date->isPast() && $schedule->status === 'aktif' ? 'bg-red-50' : '' }} border-b">
                                <td class="py-2">{{ $schedule->lahan->nama }}</td>
                                <td class="py-2">{{ $schedule->jenis }}</td>
                                <td class="py-2">
                                    {{ match ($schedule->recurring_pattern) {
                                        'harian' => 'Harian',
                                        'mingguan' => 'Mingguan',
                                        'dua_mingguan' => '2 Mingguan',
                                        'bulanan' => 'Bulanan',
                                        default => '-',
                                    } }}
                                </td>
                                <td class="py-2">
                                    {{ $schedule->next_date->format('d M Y') }}
                                    @if ($schedule->next_date->isPast() && $schedule->status === 'aktif')
                                        <span class="text-xs text-red-600">(terlewat)</span>
                                    @endif
                                </td>
                                <td class="py-2">
                                    <span @class([
                                        'px-2 py-1 text-xs rounded',
                                        'bg-blue-100 text-blue-800' => $schedule->status === 'aktif',
                                        'bg-green-100 text-green-800' => $schedule->status === 'selesai',
                                        'bg-gray-100 text-gray-800' => $schedule->status === 'dibatalkan',
                                    ])>
                                        {{ ucfirst($schedule->status) }}
                                    </span>
                                </td>
                                <td class="space-x-2 py-2">
                                    @if ($schedule->status === 'aktif')
                                        <form action="{{ route('schedules.mark-done', $schedule) }}" class="inline"
                                            method="POST">
                                            @csrf
                                            <button class="text-green-600 hover:underline" type="submit">Tandai
                                                Selesai</button>
                                        </form>
                                    @endif
                                    <a class="text-yellow-600 hover:underline"
                                        href="{{ route('schedules.edit', $schedule) }}">Edit</a>
                                    @if ($schedule->status !== 'selesai')
                                        <form action="{{ route('schedules.destroy', $schedule) }}" class="inline"
                                            method="POST" onsubmit="return confirm('Yakin hapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:underline" type="submit">Hapus</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-4 text-center text-gray-500" colspan="6">Belum ada jadwal.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>

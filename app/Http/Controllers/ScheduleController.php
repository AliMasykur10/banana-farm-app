<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Lahan;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('lahan')->orderBy('next_date')->get();

        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $lahans = Lahan::all();

        return view('schedules.create', compact('lahans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lahan_id' => 'required|exists:lahans,id',
            'jenis' => 'required|string|max:255',
            'recurring_pattern' => 'nullable|in:harian,mingguan,dua_mingguan,bulanan',
            'next_date' => 'required|date',
        ]);

        $validated['status'] = 'aktif';

        Schedule::create($validated);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function show(Schedule $schedule)
    {
        $schedule->load('lahan', 'logs.user');

        return view('schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        $lahans = Lahan::all();

        return view('schedules.edit', compact('schedule', 'lahans'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'lahan_id' => 'required|exists:lahans,id',
            'jenis' => 'required|string|max:255',
            'recurring_pattern' => 'nullable|in:harian,mingguan,dua_mingguan,bulanan',
            'next_date' => 'required|date',
            'status' => 'required|in:aktif,selesai,dibatalkan',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        if ($schedule->status === 'selesai') {
            return redirect()->route('schedules.index')
                ->with('error', 'Jadwal yang sudah selesai tidak bisa dihapus, karena jadi riwayat perawatan.');
        }

        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    // Tandai jadwal sudah dikerjakan, otomatis geser ke next_date berikutnya kalau recurring
    public function markDone(Request $request, Schedule $schedule)
    {
        $schedule->logs()->create([
            'user_id' => auth()->id(),
            'tanggal_dilakukan' => now(),
            'catatan' => $request->input('catatan'),
        ]);

        if ($schedule->recurring_pattern) {
            $daysToAdd = match ($schedule->recurring_pattern) {
                'harian' => 1,
                'mingguan' => 7,
                'dua_mingguan' => 14,
                'bulanan' => 30,
                default => 7,
            };

            $schedule->update([
                'next_date' => $schedule->next_date->addDays($daysToAdd),
            ]);
        } else {
            $schedule->update(['status' => 'selesai']);
        }

        return redirect()->route('schedules.index')->with('success', 'Jadwal ditandai selesai dan tercatat di riwayat.');
    }
}

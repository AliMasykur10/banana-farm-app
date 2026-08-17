<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use App\Models\Transaction;
use App\Models\TroubleReport;
use App\Models\Schedule;
use App\Models\ProgressLog;

class DashboardController extends Controller
{
    public function index()
    {
        $lahans = Lahan::withCount('transactions')->get();

        $bulanIni = now()->startOfMonth();
        $totalPemasukanBulanIni = Transaction::where('jenis', 'pemasukan')
            ->where('tanggal', '>=', $bulanIni)
            ->sum('jumlah');
        $totalPengeluaranBulanIni = Transaction::where('jenis', 'pengeluaran')
            ->where('tanggal', '>=', $bulanIni)
            ->sum('jumlah');

        $troubleAktif = TroubleReport::with('lahan')
            ->where('status', '!=', 'selesai')
            ->latest()
            ->take(5)
            ->get();

        $jadwalTerlewat = Schedule::with('lahan')
            ->where('status', 'aktif')
            ->where('next_date', '<', now())
            ->get();

        $jadwalMendatang = Schedule::with('lahan')
            ->where('status', 'aktif')
            ->where('next_date', '>=', now())
            ->orderBy('next_date')
            ->take(5)
            ->get();

        $progressTerbaru = ProgressLog::with('lahan', 'user')
            ->latest('tanggal')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'lahans',
            'totalPemasukanBulanIni',
            'totalPengeluaranBulanIni',
            'troubleAktif',
            'jadwalTerlewat',
            'jadwalMendatang',
            'progressTerbaru'
        ));
    }
}

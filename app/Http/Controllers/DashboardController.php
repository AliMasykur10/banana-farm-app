<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use App\Models\Transaction;
use App\Models\TroubleReport;
use App\Models\Schedule;
use App\Models\ProgressLog;
use App\Support\ActiveLahan;

class DashboardController extends Controller
{
    public function index()
    {
        $lahanFilter = ActiveLahan::id();

        $lahans = Lahan::withCount('transactions')
            ->when($lahanFilter, fn($q) => $q->where('id', $lahanFilter))
            ->get();

        $bulanIni = now()->startOfMonth();

        $totalPemasukanBulanIni = Transaction::where('jenis', 'pemasukan')
            ->where('tanggal', '>=', $bulanIni)
            ->when($lahanFilter, fn($q) => $q->where('lahan_id', $lahanFilter))
            ->sum('jumlah');

        $totalPengeluaranBulanIni = Transaction::where('jenis', 'pengeluaran')
            ->where('tanggal', '>=', $bulanIni)
            ->when($lahanFilter, fn($q) => $q->where('lahan_id', $lahanFilter))
            ->sum('jumlah');

        $troubleAktif = TroubleReport::with('lahan')
            ->where('status', '!=', 'selesai')
            ->when($lahanFilter, fn($q) => $q->where('lahan_id', $lahanFilter))
            ->latest()
            ->take(5)
            ->get();

        $jadwalTerlewat = Schedule::with('lahan')
            ->where('status', 'aktif')
            ->where('next_date', '<', now())
            ->when($lahanFilter, fn($q) => $q->where('lahan_id', $lahanFilter))
            ->get();

        $jadwalMendatang = Schedule::with('lahan')
            ->where('status', 'aktif')
            ->where('next_date', '>=', now())
            ->when($lahanFilter, fn($q) => $q->where('lahan_id', $lahanFilter))
            ->orderBy('next_date')
            ->take(5)
            ->get();

        $progressTerbaru = ProgressLog::with('lahan', 'user')
            ->when($lahanFilter, fn($q) => $q->where('lahan_id', $lahanFilter))
            ->latest('tanggal')
            ->take(5)
            ->get();

        // Data untuk grafik tren 6 bulan terakhir
        $trendLabels = [];
        $trendPemasukan = [];
        $trendPengeluaran = [];

        for ($i = 5; $i >= 0; $i--) {
            $bulan = now()->subMonths($i);
            $trendLabels[] = $bulan->translatedFormat('M Y');

            $trendPemasukan[] = Transaction::where('jenis', 'pemasukan')
                ->whereYear('tanggal', $bulan->year)
                ->whereMonth('tanggal', $bulan->month)
                ->when($lahanFilter, fn($q) => $q->where('lahan_id', $lahanFilter))
                ->sum('jumlah');

            $trendPengeluaran[] = Transaction::where('jenis', 'pengeluaran')
                ->whereYear('tanggal', $bulan->year)
                ->whereMonth('tanggal', $bulan->month)
                ->when($lahanFilter, fn($q) => $q->where('lahan_id', $lahanFilter))
                ->sum('jumlah');
        }

        // Data untuk breakdown pengeluaran per kategori (bulan ini)
        $breakdownKategori = Transaction::where('jenis', 'pengeluaran')
            ->where('tanggal', '>=', $bulanIni)
            ->when($lahanFilter, fn($q) => $q->where('lahan_id', $lahanFilter))
            ->selectRaw('kategori, SUM(jumlah) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        return view('dashboard', compact(
            'lahans',
            'totalPemasukanBulanIni',
            'totalPengeluaranBulanIni',
            'troubleAktif',
            'jadwalTerlewat',
            'jadwalMendatang',
            'progressTerbaru',
            'trendLabels',
            'trendPemasukan',
            'trendPengeluaran',
            'breakdownKategori'

        ));
    }
}

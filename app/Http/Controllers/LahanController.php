<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use Illuminate\Http\Request;

class LahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lahans = Lahan::withCount('transactions')->latest()->get();

        return view('lahans.index', compact('lahans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lahans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'luas_panjang_m' => 'nullable|numeric|min:0',
            'luas_lebar_m' => 'nullable|numeric|min:0',
            'jarak_tanam_m' => 'nullable|numeric|min:0',
            'jarak_pagar_m' => 'nullable|numeric|min:0',
            'estimasi_jumlah_pohon' => 'nullable|integer|min:0',
        ]);

        $validated['fase_saat_ini'] = 'buka_lahan';

        Lahan::create($validated);

        return redirect()->route('lahans.index')->with('success', 'Lahan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lahan $lahan)
    {
        $lahan->load(['activeAgreement.partner', 'panenCycles', 'progressLogs' => function ($query) {
            $query->latest()->take(5);
        }, 'troubleReports' => function ($query) {
            $query->where('status', '!=', 'selesai');
        }]);

        return view('lahans.show', compact('lahan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lahan $lahan)
    {
        return view('lahans.edit', compact('lahan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lahan $lahan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'luas_panjang_m' => 'nullable|numeric|min:0',
            'luas_lebar_m' => 'nullable|numeric|min:0',
            'jarak_tanam_m' => 'nullable|numeric|min:0',
            'jarak_pagar_m' => 'nullable|numeric|min:0',
            'estimasi_jumlah_pohon' => 'nullable|integer|min:0',
        ]);

        $lahan->update($validated);

        return redirect()->route('lahans.index')->with('success', 'Lahan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lahan $lahan)
    {
        $lahan->delete();

        return redirect()->route('lahans.index')->with('success', 'Lahan berhasil dihapus.');
    }
}

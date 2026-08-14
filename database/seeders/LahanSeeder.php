<?php

namespace Database\Seeders;

use App\Models\Lahan;
use App\Models\Partner;
use App\Models\PartnerAgreement;
use App\Models\Asset;
use App\Models\AssetAllocation;
use Illuminate\Database\Seeder;

class LahanSeeder extends Seeder
{
    public function run(): void
    {
        // Lahan pertama
        $lahan1 = Lahan::create([
            'nama' => 'Lahan 1',
            'luas_panjang_m' => 18,
            'luas_lebar_m' => 30,
            'jarak_tanam_m' => 2,
            'jarak_pagar_m' => 1,
            'estimasi_jumlah_pohon' => 135,
            'fase_saat_ini' => 'buka_lahan',
        ]);

        // Partner 1: penyedia bibit & pembeli
        $partner1 = Partner::create([
            'tipe' => 'penyedia_pembeli',
            'nama' => 'Partner 1 (Penyedia Bibit & Pembeli)',
        ]);

        // Partner 2: pemilik lahan
        $partner2 = Partner::create([
            'tipe' => 'pemilik_lahan',
            'nama' => 'Partner 2 (Pemilik Lahan)',
        ]);

        // Kesepakatan sewa untuk Lahan 1
        PartnerAgreement::create([
            'partner_id' => $partner2->id,
            'lahan_id' => $lahan1->id,
            'skema' => 'sewa',
            'nominal_sewa' => 0, // isi nominal riil sewa kamu di sini
            'tanggal_mulai' => now(),
            'is_active' => true,
        ]);

        // Aset: pompa sibel
        $pompa = Asset::create([
            'nama' => 'Pompa Sibel',
            'jenis' => 'Pengairan',
            'tanggal_beli' => now(),
            'harga_beli' => 0, // isi harga riil pompa kamu di sini
            'kondisi' => 'baik',
        ]);

        AssetAllocation::create([
            'asset_id' => $pompa->id,
            'lahan_id' => $lahan1->id,
            'porsi_persen' => 100,
        ]);
    }
}

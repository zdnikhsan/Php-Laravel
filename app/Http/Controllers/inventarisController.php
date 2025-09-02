<?php

// app/Http/Controllers/BarangController.php
namespace App\Http\Controllers;

use App\Models\inventaris;
use App\Models\keuangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class inventarisController extends Controller
{
    public function showInvent()
    {
        $barang = new inventaris();
        $bulan_ini = now();

        $barangs = $barang::whereYear('created_at', $bulan_ini->year)
            ->whereMonth('created_at', $bulan_ini->month)
            ->get();

        return view('manage.inventaris', compact('barangs'));
    }

    public function addInvent(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:Sabun,Pewangi,Plastik,Lainnya',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
        ]);

        $barang = new inventaris();
        $item = new keuangan();

        $barang->nama = $request->nama;
        $barang->harga = $request->harga;
        $barang->kategori = $request->kategori;
        $barang->stok = $request->stok;

        $barang->save();

        $nominal = $request->harga * $request->stok;

        $item->tanggal = now();
        $item->jenis = 'pengeluaran';
        $item->nominal = $nominal;
        $item->keterangan = 'Tambah Barang : '.$request->nama;

        $item->save();

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
    }

    public function updateInvent(Request $request, inventaris $barang)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:Sabun,Pewangi,Plastik,Lainnya',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        $stokLama = $barang->stok;
        $stokBaru = $request->stok;
        $harga = $request->harga;

        $barang->update($request->all());

        $selisih_stok = $stokBaru - $stokLama;

         if ($selisih_stok > 0) {
        // Ada tambahan stok → hitung nominal tambahan
        $tambahan_nominal = $selisih_stok * $harga;

        // Cek apakah sudah ada entry pengeluaran di bulan ini
        $bulan_ini = Carbon::now()->format('Y-m'); // contoh: "2025-07"

        $keuangan = Keuangan::where('jenis', 'pengeluaran')
            ->where('keterangan', 'like', '%'.$barang->nama_barang.'%')
            ->whereRaw("DATE_FORMAT(tanggal, '%Y-%m') = ?", [$bulan_ini])
            ->first();

        if ($keuangan) {
            // Update nominal di entry bulan ini
            $keuangan->update([
                'nominal' => $keuangan->nominal + $tambahan_nominal
            ]);
        } else {
            // Insert pengeluaran baru untuk bulan ini
            Keuangan::create([
                'tanggal'    => now(),
                'jenis'      => 'pengeluaran',
                'nominal'    => $tambahan_nominal,
                'keterangan' => 'Pembelian tambahan '.$barang->nama_barang,
            ]);
        }
    }

        return redirect()->back()->with('success', 'Barang berhasil diupdate!');
    }

    public function destroyInvent(inventaris $barang)
    {
        $barang->delete();
        return redirect()->back()->with('success', 'Barang berhasil dihapus!');
    }

    
}



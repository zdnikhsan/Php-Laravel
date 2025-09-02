<?php

// app/Http/Controllers/KeuanganController.php

namespace App\Http\Controllers;

use App\Models\inventaris;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Container\Attributes\DB;

class keuanganController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'bulanan');
        $today = Carbon::today();

        switch ($filter) {
            case 'harian':
                $start = $today;
                $end = $today->copy()->endOfDay();
                break;
            case 'tahunan':
                $start = $today->copy()->startOfYear();
                $end = $today->copy()->endOfYear();
                break;
            default: // bulanan
                $start = $today->copy()->startOfMonth();
                $end = $today->copy()->endOfMonth();
                break;
        }

        // Pendapatan dari transaksi
        $pendapatan = Transaksi::where('status', 'Selesai')
        ->whereBetween('tgl_selesai', [$start, $end])
        ->sum('jml_transaksi');

        // Pengeluaran dari tabel keuangan

        $pengeluaran = Keuangan::where('jenis', 'pengeluaran')
            ->whereBetween('tanggal', [$start, $end])
            ->sum('nominal');

        // Laba Bersih
        $laba_bersih = $pendapatan - $pengeluaran;

        // Ringkasan keuangan per bulan (untuk tabel)
        $summary = collect(range(1, 12))->map(function ($month) use ($today) {
            // Pendapatan per bulan
            $pendapatan_bulanan = Transaksi::where('status', 'Selesai')
                ->whereYear('tgl_selesai', $today->year)
                ->whereMonth('tgl_selesai', $month)
                ->sum('jml_transaksi');

            // Pengeluaran per bulan
            $pengeluaran_manual = Keuangan::where('jenis', 'pengeluaran')
                ->whereYear('tanggal', $today->year)
                ->whereMonth('tanggal', $month)
                ->sum('nominal');

            // Laba bersih per bulan
            $laba_bersih_bulanan = $pendapatan_bulanan - $pengeluaran_manual;

            return [
                'bulan'        => Carbon::create()->month($month)->format('F'),
                'pendapatan'   => $pendapatan_bulanan,
                'pengeluaran'  => $pengeluaran_manual,
                'laba_bersih'  => $laba_bersih_bulanan,
            ];
        });

        // Data untuk chart pendapatan per bulan
        $chartData = Transaksi::selectRaw('MONTH(tgl_selesai) as bulan, SUM(jml_transaksi) as total')
            ->where('status', 'Selesai')
            ->whereYear('tgl_selesai', $today->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        return view('keuangan.index', compact(
            'pendapatan', 'pengeluaran', 'laba_bersih', 'filter', 'chartData','summary'
        ));
    }
}


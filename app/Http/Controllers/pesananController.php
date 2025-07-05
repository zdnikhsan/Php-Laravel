<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use App\Models\transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pesananController extends Controller
{
    function showPesanan(){
        $transaksi = transaksi::with('pelanggan')->latest()->paginate(10);

        $pendapatanHariIni = Transaksi::where('status', 'Selesai')
        ->whereDate('created_at', Carbon::today())
        ->sum('jml_transaksi');
        $pendapatanKemarin = Transaksi::where('status', 'Selesai')
        ->whereDate('created_at', Carbon::yesterday())
        ->sum('jml_transaksi');

        $mingguAwal = Carbon::now()->startOfWeek();
        $mingguakhir = Carbon::now()->endOfWeek();
        $dataTransaksi = Transaksi::where('status', 'Selesai')
        ->whereBetween('tgl_masuk', [$mingguAwal, $mingguakhir])
        ->selectRaw('DATE(tgl_masuk) as tanggal, COUNT(*) as jumlah')
        ->groupBy('tanggal')
        ->orderBy('tanggal')
        ->get();

        $labels = [];
        $jumlah = [];

        foreach (Carbon::now()->startOfWeek()->daysUntil(Carbon::now()->endOfWeek()) as $day) {
            $tanggal = $day->toDateString();
            $labels[] = $day->translatedFormat('l'); 
            $jumlah[] = $dataTransaksi->firstWhere('tanggal', $tanggal)?->jumlah ?? 0;
        }

        foreach($transaksi as $trans){
            if (
                $trans->status !== 'Selesai' &&
                now()->greaterThanOrEqualTo($trans->tgl_selesai)
            ) {
                $trans->status = 'Selesai';
                $trans->update();
            }
        }
            
        return(view('pesanan', compact('transaksi','pendapatanHariIni','pendapatanKemarin','labels','jumlah')));
    }

    function tambahTransaksi(Request $request){
        $item = new transaksi();
        $no_hp = $request->no_hp;
        $pelanggan = pelanggan::where('no_hp', $no_hp)->value('id');

        $adm = Auth::user();
        $idadm = $adm->id;
        $tgl = now();
        $inp_paket = $request->paket ?? '3 Hari';
        $berat = $request->berat_pakaian;

        if($inp_paket === '1 Hari'){
            $harga = 8000;
            $tgl_selesai = now()->addDay();
        }elseif($inp_paket === 'Ekspress'){
            $harga = 12000;
            $tgl_selesai = now()->addDays(3);
        }else{
            $harga = 5000;
            $tgl_selesai = now()->addHours(6);
        }

        $jml_transaksi = $berat * $harga;

        $item->id_pelanggan = $pelanggan;
        $item->id_admin = $idadm;	
        $item->no_hp = $request->no_hp;	
        $item->berat_pakaian = $berat;	
        $item->tgl_masuk = $tgl;	
        $item->tgl_selesai = $tgl_selesai;	
        $item->paket = $inp_paket;	
        $item->jml_transaksi = $jml_transaksi;

        $item->save();

        return redirect()->route('showPesanan');
    }

    function detailTransaksi($id){
        $transaksi = transaksi::with('pelanggan')->findOrFail($id);
        $riwayat = Transaksi::where('id_pelanggan', $transaksi->id_pelanggan)
        ->orderBy('tgl_masuk', 'desc')->take(4)->get();
        
        return(view('transaksi.detailTransaksi', compact('transaksi','riwayat')));
    }

    public function editTransaksi(Request $request, $id) {
        $transaksi = Transaksi::findOrFail($id);
        $inp_paket= $request->paket;
        $berat = $request->berat_pakaian;
        if($inp_paket === '1 Hari'){
            $harga = 8000;
        }elseif($inp_paket === '3 Hari'){
            $harga = 5000;
        }elseif($inp_paket === 'Ekspress'){
            $harga = 12000;
        }

        $jml_transaksi = $berat * $harga;
        $transaksi->paket = $inp_paket;
        $transaksi->berat_pakaian = $berat;
        $transaksi->tgl_selesai = $request->tgl_selesai;
        $transaksi->jml_transaksi = $jml_transaksi;
        $transaksi->update();
    
        return redirect()->back()->with('success', 'Transaksi berhasil diupdate.');
    }
    
    public function hapusTransaksi($id) {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
    
        return redirect('/pesanan')->with('success', 'Transaksi berhasil dihapus.');
    }
    
}

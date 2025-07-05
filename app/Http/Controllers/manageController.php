<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use Illuminate\Http\Request;

class manageController extends Controller
{
    function showManage(){
        $pelanggan = pelanggan::all();
        return(view('manage', compact('pelanggan')));
    }

    function showFormPelanggan(){
        return(view('manage.formTambahPelanggan'));
    }

    function pelangganAction(Request $request){
        $item = new pelanggan();

        $item->name = $request->nama;
        $item->no_hp = $request->no_hp;
        $item->alamat = $request->alamat;

        $item->save();

        return redirect('/manage');
    }

    function pelangganDetail($id){
        $pelanggan = pelanggan::find($id);
        return(view('manage.pelangganDetail', compact('pelanggan')));
    }

    function pelangganDetailEdit(Request $request){
        $id = $request->id;
        $item = pelanggan::find($id);

        $item->name = $request->nama;
        $item->no_hp = $request->no_hp;
        $item->alamat = $request->alamat;
        $item->level = $request->level;

        $item->update();

        return redirect('/manage');
    }

    public function destroy($id){
        $pelanggan = pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect('/manage')->with('success', 'Data berhasil dihapus.');
    }

}

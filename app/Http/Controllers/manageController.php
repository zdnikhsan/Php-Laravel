<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;


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

    public function showAdmin(){
        $admins = User::all();
        return view('manage.admin', compact('admins'));
    }

    public function adminAdd(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'role'  => ['required', Rule::in(['su_admin', 'admin'])],
        ], [
            'name.required'  => 'Nama wajib diisi.',
            'name.string'    => 'Nama harus berupa teks.',
            'name.min'       => 'Nama minimal :min karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah digunakan.',
            'role.required'  => 'Role wajib dipilih.',
            'role.in'        => 'Role yang dipilih tidak valid.',
        ]);

        $admin = new User();
        
            $admin->name  = $request->name;
            $admin->email = $request->email;
            $admin->role  = $request->role;
            $admin->password = bcrypt($request->password);

        $admin->save();

        return redirect()->route('showAdmin')->with('success', 'Admin berhasil ditambahkan!');
    }

    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'role'  => ['required', Rule::in(['SuperAdmin', 'Admin', 'Staff'])],
        ]);

        $admin = User::findOrFail($id);
        $admin->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('showAdmin')->with('success', 'Admin berhasil diupdate!');
    }

    public function adminDestroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('showAdmin')->with('success', 'Admin berhasil dihapus!');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AkunController extends Controller
{
    public function index()
    {
        return view('admin/akunuser', [
            'title' => 'Data User',
            'active' => 'akunuser',
            'post' => User::all(),
        ]);
    }
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect('/akunuser')->with('success','Akun Telah di hapus');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('/admin/edituser', ['user'=>$user], [
            'active' => 'akunuser',
        ]);
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->nama = $request->nama;
        $user->perusahaan = $request->perusahaan;
        $user->tim = $request->tim;
        $user->jabatan = $request->jabatan;
        $user->kode_kc = $request->kode_kc;
        $user->nama_kc = $request->nama_kc;
        $user->kode_uko = $request->kode_uko;
        $user->nama_uko = $request->nama_uko;
        $user->kode_ro = $request->kode_ro;
        $user->nama_ro = $request->nama_ro;
        $user->save();

	return redirect('/akunuser');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        return view ('login.register', [
            'title' => 'Register'
        ]);
    }
    public function store(Request $request){
        $validateData = $request->validate([
            'nama' => 'required|max:50',
            'pn' => 'required|max:10',
            'password' => 'required',
            'perusahaan' => 'required|max:255',
            'tim' => 'required|max:50',
            'jabatan' => 'required|max:250',
            'kode_kc' => 'required|max:6',
            'nama_kc' => 'required|max:50',
            'kode_uko' => 'required|max:6',
            'nama_uko' => 'required|max:50',
            'kode_ro' => 'required|max:6',
            'nama_ro' => 'required|max:50',
        ]);

        User::create($validateData);


        return redirect('/login')->with('success','Registrasi Berhasil! Silahkan Login');
    }
}

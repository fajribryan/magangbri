<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index()
    {
        return view('admin/inventaris/inventaris', [
            'title' => 'Inventaris',
            'active' => 'inventaris',
            'inventaris' => Inventaris::all(),
        ]);
    }
    public function create()
    {
        return view('admin\inventaris\buatinventaris', [
            'title' => 'Create Inventaris',
            'active' => 'Create Inventaris',
        ]);
    }
    public function input(Request $request)
    {
        $request->validate([
            'tid' => 'required' , 
            'merek_mesin' => 'required' , 
            'tipe_mesin' => 'required' , 
            'jenis_mesin' => 'required' , 
            'merek_cctv' => 'required' , 
            'merek_ups' => 'required' , 
            'vendor_slm_cctv' => 'required' , 
            'vendor_slm_ups' => 'required' , 
            'vendor_kebersihan' => 'required' , 
            'vendor_pjpur' => 'required' , 
            'cover' => 'required' , 
            'lokasi' => 'required' , 
            'long' => 'required' , 
            'lat' => 'required' , 
            'jenis_lokasi' => 'required' , 
            'tipe_lokasi' => 'required' , 
            'kategori_lokasi' => 'required' , 
            'kategori_grup' => 'required' , 
            'nilai_sewa_tahunan' => 'required' , 
            'sewa_mulai' => 'required' , 
            'sewa_akhir' => 'required' , 
            'kode_kc' => 'required' , 
            'nama_kc' => 'required' , 
            'kode_uko' => 'required' , 
            'nama_uko' => 'required' , 
            'kode_ro' => 'required' , 
            'nama_ro' => 'required' , 
        ]) ;

         Inventaris::create($request->all());

	 return redirect()->route('inventaris');
    //dd($request->all());
    }
    public function destroy($id)
    {
        Inventaris::where('id', $id)->delete();
        return redirect('/inventaris')->with('success','Data Telah di hapus');
    }
    public function edit($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        return view('/admin/inventaris/editinventaris', ['inventaris'=>$inventaris], [
            'active' => 'inventaris',
        ]);
    }
    public function update(Request $request, $id)
    {
        $inventaris = Inventaris::findOrFail($id);
        $inventaris->tid = $request->tid;
        $inventaris->merek_mesin = $request->merek_mesin;
        $inventaris->tipe_mesin = $request->tipe_mesin;
        $inventaris->jenis_mesin = $request->jenis_mesin;
        $inventaris->merek_cctv = $request->merek_cctv;
        $inventaris->merek_ups = $request->merek_ups;
        $inventaris->vendor_slm_cctv = $request->vendor_slm_ups;
        $inventaris->vendor_kebersihan = $request->vendor_kebersihan;
        $inventaris->vendor_pjpur = $request->vendor_pjpur;
        $inventaris->cover = $request->cover;
        $inventaris->lokasi = $request->lokasi;
        $inventaris->long = $request->long;
        $inventaris->lat = $request->lat;
        $inventaris->jenis_lokasi = $request->jenis_lokasi;
        $inventaris->tipe_lokasi = $request->tipe_lokasi;
        $inventaris->kategori_lokasi = $request->kategori_lokasi;
        $inventaris->kategori_grup = $request->kategori_grup;
        $inventaris->nilai_sewa_tahunan = $request->nilai_sewa_tahunan;
        $inventaris->sewa_mulai = $request->sewa_mulai;
        $inventaris->sewa_akhir = $request->sewa_akhir;
        $inventaris->kode_kc = $request->kode_kc;
        $inventaris->nama_kc = $request->nama_kc;
        $inventaris->kode_uko = $request->kode_uko;
        $inventaris->nama_uko = $request->nama_uko;
        $inventaris->kode_ro = $request->kode_ro;
        $inventaris->nama_ro = $request->nama_ro;
        $inventaris->save();

	return redirect('/inventaris');
    }

}

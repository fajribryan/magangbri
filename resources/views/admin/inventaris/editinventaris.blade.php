@extends('admin.layout.navbar')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data Inventaris</h1>
</div>

<style>
    .scrollable-data {
    overflow-y: auto; /* Membuat konten data dapat di-scroll vertikal */
    max-height: 80vh; /* Sesuaikan tinggi maksimum sesuai kebutuhan */
    padding: 20px; /* Sesuaikan padding sesuai kebutuhan */
}
</style>
<div class="scrollable-data">
<div class="row">
    <form action="/inventaris/update/{{ $inventaris->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">TID </label>
            <input type="text" class="form-control" id="tid" name="tid" value="{{ $inventaris->tid }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Merek Mesin </label>
            <input type="text" class="form-control" id="merek_mesin" name="merek_mesin" value="{{ $inventaris->merek_mesin }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Mesin </label>
            <input type="text" class="form-control" id="jenis_mesin" name="jenis_mesin" value="{{ $inventaris->jenis_mesin }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Merek CCTV </label>
            <input type="text" class="form-control" id="merek_cctv" name="merek_cctv" value="{{ $inventaris->merek_cctv }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Merek UPS </label>
            <input type="text" class="form-control" id="merek_ups" name="merek_ups" value="{{ $inventaris->merek_ups }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Vendor SLM CCTV </label>
            <input type="text" class="form-control" id="vendor_slm_cctv" name="vendor_slm_cctv" value="{{ $inventaris->vendor_slm_cctv }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Vendor SLM UPS </label>
            <input type="text" class="form-control" id="vendor_slm_ups" name="vendor_slm_ups" value="{{ $inventaris->vendor_slm_ups }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Vendor PJPUR </label>
            <input type="text" class="form-control" id="vendor_pjpur" name="vendor_pjpur" value="{{ $inventaris->vendor_pjpur }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Long </label>
            <input type="text" class="form-control" id="long" name="long" value="{{ $inventaris->long }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Lat </label>
            <input type="text" class="form-control" id="lat" name="lat" value="{{ $inventaris->lat }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Lokasi </label>
            <input type="text" class="form-control" id="jenis_lokasi" name="jenis_lokasi" value="{{ $inventaris->jenis_lokasi }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Tipe Lokasi </label>
            <input type="text" class="form-control" id="tipe_lokasi" name="tipe_lokasi" value="{{ $inventaris->tipe_lokasi }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori Lokasi </label>
            <input type="text" class="form-control" id="kategori_lokasi" name="kategori_lokasi" value="{{ $inventaris->kategori_lokasi }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori Group </label>
            <input type="text" class="form-control" id="kategori_grup" name="kategori_grup" value="{{ $inventaris->kategori_grup }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Nilai Sewa Tahunan </label>
            <input type="text" class="form-control" id="nilai_sewa_tahunan" name="nilai_sewa_tahunan" value="{{ $inventaris->nilai_sewa_tahunan }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Sewa Mulai </label>
            <input type="date" class="form-control" id="sewa_mulai" name="sewa_mulai" value="{{ $inventaris->sewa_mulai }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Sewa Akhir </label>
            <input type="date" class="form-control" id="sewa_akhir" name="sewa_akhir" value="{{ $inventaris->sewa_akhir }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Kode KC </label>
            <input type="text" class="form-control" id="kode_kc" name="kode_kc" value="{{ $inventaris->kode_kc }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Nama KC</label>
            <input type="text" class="form-control" id="nama_kc" name="nama_kc" value="{{ $inventaris->nama_kc }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Kode UKO </label>
            <input type="text" class="form-control" id="kode_uko" name="kode_uko" value="{{ $inventaris->kode_uko }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Nama UKO</label>
            <input type="text" class="form-control" id="nama_uko" name="nama_uko" value="{{ $inventaris->nama_uko }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Kode RO</label>
            <input type="text" class="form-control" id="kode_ro" name="kode_ro" value="{{ $inventaris->kode_ro }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Nama RO</label>
            <input type="text" class="form-control" id="nama_ro" name="nama_ro" value="{{ $inventaris->nama_ro }}">
        </div>
          <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</div>

@endsection
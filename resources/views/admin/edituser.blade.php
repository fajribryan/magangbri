@extends('admin.layout.navbar')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data User</h1>
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
    <form action="/update/{{ $user->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama </label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Perusahaan </label>
            <input type="text" class="form-control" id="perusahaan" name="perusahaan" value="{{ $user->perusahaan }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Team </label>
            <input type="text" class="form-control" id="tim" name="tim" value="{{ $user->tim }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Jabatan </label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $user->jabatan }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Kode KC </label>
            <input type="text" class="form-control" id="kode_kc" name="kode_kc" value="{{ $user->kode_kc }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Nama KC</label>
            <input type="text" class="form-control" id="nama_kc" name="nama_kc" value="{{ $user->nama_kc }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Kode UKO </label>
            <input type="text" class="form-control" id="kode_uko" name="kode_uko" value="{{ $user->kode_uko }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Nama UKO</label>
            <input type="text" class="form-control" id="nama_uko" name="nama_uko" value="{{ $user->nama_uko }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Kode RO</label>
            <input type="text" class="form-control" id="kode_ro" name="kode_ro" value="{{ $user->kode_ro }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Nama RO</label>
            <input type="text" class="form-control" id="nama_ro" name="nama_ro" value="{{ $user->nama_ro }}">
        </div>
          <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</div>

@endsection
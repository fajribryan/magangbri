@extends('admin.layout.navbarsurvey')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Survey Bangunan</h1>
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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="/jenislokasi" method="POST">
        @csrf
        <div class="mb-3">
            <label class="jenis_lokasi">Jenis Lokasi </label>
            <select name="jenis_lokasi" id="jenis_lokasi">
                <option value="bangunan_sendiri">Bangunan Sendiri</option>
                <option value="bangunan_sharing">Bangunan Sharing</option>
            </select>
        </div>
          <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>

@endsection
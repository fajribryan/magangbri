@extends('admin.layout.navbar')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Inventaris</h1>
    <a href="/inventaris/create" class="btn btn-primary">New</a>
</div>
<style>
  .scrollable-data {
    width: 100%; /* Lebar sesuai kebutuhan */
    overflow-x: scroll; /* Membuat tabel data dapat di-scroll horizontal */
}
</style>
<div class="scrollable-data"> 
  <div class="row">
      <table class="table">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">TID</th>
              <th scope="col">Merek Mesin </th>
              <th scope="col">Tipe Mesin</th>
              <th scope="col">Jenis Mesin</th>
              <th scope="col">Merek CCTV</th>
              <th scope="col">Merek UPS</th>
              <th scope="col">Vendor SLM CCTV</th>
              <th scope="col">Vendor SLM UPS</th>
              <th scope="col">Vendor Kebersihan</th>
              <th scope="col">Vendor PJPUR</th>
              <th scope="col">Cover</th>
              <th scope="col">Lokasi</th>
              <th scope="col">Long</th>
              <th scope="col">Lat</th>
              <th scope="col">Jenis_lokasi</th>
              <th scope="col">Tipe Lokasi</th>
              <th scope="col">Kategori Lokasi</th>
              <th scope="col">Kategori Group</th>
              <th scope="col">Nilai Sewa Tahunan</th>
              <th scope="col">Sewa Mulai</th>
              <th scope="col">Sewa Berakhir</th>
              <th scope="col">Kode KC</th>
              <th scope="col">Nama KC</th>
              <th scope="col">Kode UKO</th>
              <th scope="col">Nama UKO</th>
              <th scope="col">Kode RO</th>
              <th scope="col">Nama RO</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($inventaris as $i)    
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $i->tid }}</td>
              <td>{{ $i->merek_mesin }}</td>
              <td>{{ $i->tipe_mesin }}</td>
              <td>{{ $i->jenis_mesin }}</td>
              <td>{{ $i->merek_cctv }}</td>
              <td>{{ $i->merek_ups }}</td>
              <td>{{ $i->vendor_slm_cctv }}</td>
              <td>{{ $i->vendor_slm_ups }}</td>
              <td>{{ $i->vendor_kebersihan }}</td>
              <td>{{ $i->vendor_pjpur }}</td>
              <td>{{ $i->cover }}</td>
              <td>{{ $i->lokasi }}</td>
              <td>{{ $i->long }}</td>
              <td>{{ $i->lat }}</td>
              <td>{{ $i->jenis_lokasi }}</td>
              <td>{{ $i->tipe_lokasi }}</td>
              <td>{{ $i->kategori_lokasi }}</td>
              <td>{{ $i->kategori_grup }}</td>
              <td>{{ $i->nilai_sewa_tahunan	 }}</td>
              <td>{{ $i->sewa_mulai }}</td>
              <td>{{ $i->sewa_akhir }}</td>
              <td>{{ $i->kode_kc }}</td>
              <td>{{ $i->nama_kc	 }}</td>
              <td>{{ $i->kode_uko }}</td>
              <td>{{ $i->nama_uko }}</td>
              <td>{{ $i->kode_ro }}</td>
              <td>{{ $i->nama_ro }}</td>
              <td>
                <a href="/inventaris/edit/{{ $i->id }}" class="badge bg-info border-0"><i class="fa-solid fa-pen"></i></a>
                  <a href="/inventaris/destroy/{{ $i->id }}" class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')"><i class="fa-solid fa-trash"></i></a>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
      </table>
      
  </div>
</div>

<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
@endsection
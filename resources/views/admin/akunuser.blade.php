@extends('admin.layout.navbar')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data User</h1>
</div>
<div class="row">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Personal Number</th>
            <th scope="col">Perusahaan</th>
            <th scope="col">Team</th>
            <th scope="col">Jabatan</th>
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
          @foreach ($post as $posts)    
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $posts->nama }}</td>
            <td>{{ $posts->pn }}</td>
            <td>{{ $posts->perusahaan }}</td>
            <td>{{ $posts->tim }}</td>
            <td>{{ $posts->jabatan }}</td>
            <td>{{ $posts->kode_kc }}</td>
            <td>{{ $posts->nama_kc }}</td>
            <td>{{ $posts->kode_uko }}</td>
            <td>{{ $posts->nama_uko }}</td>
            <td>{{ $posts->kode_ro }}</td>
            <td>{{ $posts->nama_ro }}</td>
            <td>
              <a href="/akunuser/edit/{{ $posts->id }}" class="badge bg-info border-0"><i class="fa-solid fa-pen"></i></a>
                <a href="/akunuser/destroy/{{ $posts->id }}" class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')"><i class="fa-solid fa-trash"></i></a>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
    
</div>

<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
@endsection
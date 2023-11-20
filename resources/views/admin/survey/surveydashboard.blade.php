@extends('admin.layout.navbar')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Table Survey</h1>
    <div style="display: inline">
      <a href="/surveyadd" class="btn btn-primary">New</a>
      <a href="surveyexcel" class="btn btn-primary">+ - Excel </a>
    </div>
</div>
  <style>
    .scrollable-data {
      width: 100%; /* Lebar sesuai kebutuhan */
      max-height: 500px;
      overflow-y: auto;
      overflow-x: scroll;
    }
  </style>
<div class="scrollable-data"> 
  <div class="row">
      <table class="table">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">TID</th>
              <th scope="col">Lokasi</th>
              <th scope="col">Nama</th>
              <th scope="col">Kondisi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($survey as $i)    
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $i->tid }}</td>
              <td>{{ $i->lokasi }}</td>
              <td>{{ $i->nama }}</td>
              <td>{{ $i->kondisi }}</td>
              <td>
                <button onclick="window.location='{{ url('survey/'.$i->id) }}'" class="badge bg-info border-0"><i class="fa-solid fa-pen"></i></button>
                <form action="{{ url('survey/'. $i->id) }}" method="POST" style="display: inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')"><i class="fa-solid fa-trash"></i></button>
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
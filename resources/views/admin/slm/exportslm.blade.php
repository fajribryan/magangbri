@extends('admin.layout.navbar')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Import Export Inventaris</h1>
</div>
<div style="display: inline">
    <form action="/exportexcellslm" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="file" name="file">
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
@endsection
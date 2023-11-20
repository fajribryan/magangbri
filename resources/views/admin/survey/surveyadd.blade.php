@extends('admin.layout.navbarsurvey')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Survey</h1>
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

    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Modal 1</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    @csrf
                    <div class="mb-3">
                        <label class="jenis_atm">Jenis Lokasi ATM</label>
                        <select name="jenis_lokasi_atm" id="jenis_lokasi_atm">
                            @php
                                if (<option value="onsite">Onsite</option>) {
                                    <button class="btn btn-primary" data-bs-target="#surveyjenislokasi" data-bs-toggle="modal">Submit</button>
                                }
                                elseif (<option value="offsite">Offsite</option>) {
                                    <button> class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Submit</button>
                                } elseif (<option value="drive-thru">Drive-Thru</option>) {
                                    <button> class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Submit</button>
                                }                                    
                            @endphp
                        </select>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Open second modal</button>
                    </div>
                </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="surveyjenislokasi" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modal 2</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Hide this modal and show the first with the button below.
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to first</button>
            </div>
          </div>
        </div>
      </div>
      <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Open first modal</button>

</div>
</div>

@endsection
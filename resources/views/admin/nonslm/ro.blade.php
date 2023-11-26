@extends('admin.layout.navbar')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Regional Office {{ $selectedRo }}</h1>
</div>

<style>
    .scrollable-data {
      width: 100%; /* Lebar sesuai kebutuhan */
      max-height: 450px;
      overflow-y: auto;
      overflow-x: scroll;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        font-size: 14px;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2; /* Warna latar belakang thead */
        position: sticky;
        border: 1px solid #dddddd;
        top: 0;
    }
</style>
<div class="row">
        <div class="col">
            <h3>
                <a href="/inventarisexcel">
                    Pencapaian GPP per Tanggal {{ $lastDate }}
                </a>
            </h3>
        </div>
        <div class="col">
            <a href="{{ route('export.premisro', ['ro' => $selectedRo]) }}">
                <button type="button" class="btn btn-primary"> Export Excell</button>
            </a>
        </div>
                    <div class="scrollable-data">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="background-color: #FFB562;text-align: center">No</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">CRO</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">KANCA</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">MESIN</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">TID</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">LOKASI</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">JENIS LOKASI</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">Waktu Survey</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">Nama</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">Perusahaan</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">Nilai</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">Kondisi Mesin</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">Kondisi Ruangan</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">Kondisi Pintu</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">Kondisi Pylon</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">Foto Tengah Mesin</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">Foto Seluruh Mesin</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">Foto Ruangan</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">Foto Pintu</th>
                                <th scope="col" style="background-color: #FFB562;text-align: center">Foto Pylon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomorUrut = 1;
                            @endphp
                            @foreach($data1 as $item)
                            @php
                                $row = $item['row'];
                                $premisesSas = $item['premisesSas'];
                                $GARIS = $item['GARIS'];
                                
                            @endphp
                            @foreach($premisesSas as $row2)
                            <tr>
                            <td style="background-color: #CDDEFF;">{{ $nomorUrut++ }}</td>
                            <td style="background-color: #CDDEFF;">{{ $row->nama_cpc }}</td>
                            <td style="background-color: #CDDEFF;">{{ $row->namap }}</td>
                            <td style="background-color: #CDDEFF;">{{ $row->perangkat }}</td>
                            <td style="background-color: #CDDEFF;">{{ $row->tid }}</td>
                            <td style="background-color: #CDDEFF;">{{ $row->lokasi }}</td>
                            <td style="background-color: #CDDEFF;">{{ $row->jenis_lokasi }}</td>
        
                            <td style="background-color: #CDDEFF;">{{ $row2->waktui }}</td>
                            <td style="background-color: #CDDEFF;">{{ $row2->pekerja }}</td>
                            <td style="background-color: #CDDEFF;">{{ $row2->perusahaan }}</td>
                            <td style="background-color: {{ $row2->achieve == 100 ? '#00DFA2' : '#FF6969' }}">{{ $row2->achieve }}</td>
                            <td style="background-color: {{ strpos($row2->kondisimesin, 'Sudah') !== false ? '#00DFA2' : '#FF6969' }}; padding: 5px;">
                                @if ($row2->kondisimesin)
                                    {{ $row2->kondisimesin }}
                                @else
                                Belum di survey Atau Tidak Ada
                                @endif
                            </td>
                            <td style="background-color: {{ strpos($row2->kondisiruangan, 'Sudah') !== false ? '#00DFA2' : '#FF6969' }}; padding: 5px;">
                                @if ($row2->kondisiruangan)
                                    {{ $row2->kondisiruangan }}
                                @else
                                Belum di survey Atau Tidak Ada
                                @endif
                            </td>
                            <td style="background-color: {{ strpos($row2->kondisipintu, 'Baru') !== false ? '#00DFA2' : '#FF6969' }}; padding: 5px;">
                                @if ($row2->kondisipintu)
                                    {{ $row2->kondisipintu }}
                                @else
                                Belum di survey Atau Tidak Ada
                                @endif
                            </td>
                            <td style="background-color: {{ strpos($row2->kondisipylon, 'Sudah') !== false ? '#00DFA2' : '#FF6969' }}; padding: 5px;">
                                @if ($row2->kondisipylon)
                                    {{ $row2->kondisipylon }}
                                @else
                                Belum di survey Atau Tidak Ada
                                @endif
                            </td>
                                                        
                            <td>
                                @if($row2->fototengahmesin != '')
                                {{-- <img loading="lazy" src="{{ str_replace('open', 'uc', $row2['fototengahmesin']) }}" style="width:400px;height:400px;"><br> --}}
                                <a style="background-color: #CDDEFF;" href="{{ $row2->fototengahmesin }}" target="_blank">{{ $row2->fototengahmesin }}</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($row2->fotoseluruhmesin != '')
                                    {{-- <img loading="lazy" src="{{ str_replace('open', 'uc', $row2['fotoseluruhmesin']) }}" style="width:400px;height:400px;"><br> --}}
                                    <a style="background-color: #CDDEFF;" href="{{ $row2->fotoseluruhmesin }}" target="_blank">{{ $row2->fotoseluruhmesin }}</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($row2->fotoruangan != '')
                                    <a style="background-color: #CDDEFF;" href="{{ $row2->fotoruangan }}" target="_blank">{{ $row2->fotoruangan }}</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($row2->fotopintu != '')
                                    <a style="background-color: #CDDEFF;" href="{{ $row2->fotopintu }}" target="_blank">{{ $row2->fotopintu }}</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($row2->fotopylon != '')
                                    <a style="background-color: #CDDEFF;" href="{{ $row2->fotopylon }}" target="_blank">{{ $row2->fotopylon }}</a>
                                @else
                                    -
                                @endif
                            </td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
@endsection
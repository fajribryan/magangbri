@extends('admin.layout.navbar')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Premis Non SLM</h1>
    <div style="display: inline">
      <a href="/exportslm" class="btn btn-primary">+ - Excel </a>
    </div>
</div>
  <style>
    .scrollable-data {
      width: 100%; /* Lebar sesuai kebutuhan */
      max-height: 500px;
      overflow-y: auto;
      overflow-x: scroll;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
  </style>
<div class="scrollable-data"> 
  <div class="row">
    <h3>
        <a href="/exportslm">
            Pencapaian GPP per Tanggal 
            {{-- {{ $lastDate }} --}}
        </a>
    </h3>
    {{-- <table class="table">
        <thead>
            <tr>
                <th scope="col" style="background-color: #FFB562;text-align: center">No</th>
                <th scope="col" style="background-color: #FFB562;text-align: center">Regional Office</th>
                <th scope="col" style="background-color: #FFB562;text-align: center">Jumlah <br> ECHANNEL</th>
                <th scope="col" style="background-color: #FFB562;text-align: center">Jumlah <br> ATM</th>
                <th scope="col" style="background-color: #FFB562;text-align: center">Jumlah <br> CRM</th>
                <th scope="col" style="background-color: #FFB562;text-align: center">ATM <BR>Sudah Disurvey</th>
                <th scope="col" style="background-color: #FFB562;text-align: center">%ATM <BR>Sudah Disurvey</th>
                <th scope="col" style="background-color: #FFB562;text-align: center">CRM <BR>Sudah Disurvey</th>
                <th scope="col" style="background-color: #FFB562;text-align: center">%CRM <BR> Sudah Disurvey</th>
                <th scope="col" style="background-color: #FFB562;text-align: center">TOTAL <BR> Sudah Disurvey</th>
                <th scope="col" style="background-color: #FFB562;text-align: center">%TOTAL <BR> Sudah Disurvey</th>
                <th scope="col" style="background-color: #FFB562;text-align: center">Pencapaian ATM <BR>yang Disurvey</th>
                <th scope="col" style="background-color: #FFB562;text-align: center">Pencapaian CRM <BR> yang Disurvey</th>
                <th scope="col" style="background-color: #FFB562;text-align: center">Pencapaian TOTAL <BR> yang Disurvey</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
            <tr >
                <td style="background-color: #CDDEFF;text-align: center">{{ $loop->iteration }}</td>
                <td style="background-color: #CDDEFF;text-align: center"><a href="/nonslm/ro/{{ $row->namau }}">{{ $row->namau }}</a></td>
                <td style="background-color: #CDDEFF;text-align: center">{{ $row->noe }}</td>
                <td style="background-color: #CDDEFF;text-align: center">{{ $row->noa }}</td>
                <td style="background-color: #CDDEFF;text-align: center">{{ $row->noc }}</td>
                <td style="background-color: #CDDEFF;text-align: center">{{ $row->tsa }}</td>
                <td style="background-color: {{ $row['tsap'] < 100 ? '#FF6969' : '#00DFA2' }}; text-align: center">
                    {{ number_format($row['tsap'], 2) }}
                %</td>
                <td style="background-color: #CDDEFF;text-align: center">{{ $row['tsc'] }}</td>
                <td style="background-color: {{ $row['tscp'] < 100 ? '#FF6969' : '#00DFA2' }}; text-align: center">
                    {{ number_format($row['tscp'], 2) }}
                %</td>
                <td style="background-color: #CDDEFF;text-align: center">{{ $row['tse'] }}</td>
                <td style="background-color: {{ $row['tsep'] < 50 ? '#FF6969' : '#00DFA2' }}; text-align: center">
                    {{ number_format($row['tsep'], 2) }}
                %</td>
                <td style="background-color: {{ $row['psa'] < 100 ? '#FF6969' : '#00DFA2' }}; text-align: center">
                    {{ number_format($row['psa'], 2) }}
                %</td>
                <td style="background-color: {{ $row['psc'] < 100 ? '#FF6969' : '#00DFA2' }}; text-align: center">
                    {{ number_format($row['psc'], 2) }}
                %</td>
                <td style="background-color: {{ $row['pse'] < 100 ? '#FF6969' : '#00DFA2' }}; text-align: center">
                    {{ number_format($row['pse'], 2) }}
                %</td>
            </tr>
            @endforeach
        </tbody>
    </table> --}}
</div>
</div>

<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
@endsection
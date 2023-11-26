<?php

namespace App\Http\Controllers;

use App\Models\premis;
use App\Models\rankingsa;
use App\Models\premisessa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class dashboardController extends Controller
{
    public function index()
    {
        $lastDate = premis::orderBy('waktui', 'desc')->value('waktui');
        $data = Rankingsa::where('tipeu', 'ro')->get();
        $results = DB::table('premisessa as p0')
            ->select(
                'p0.ro as ro',
                DB::raw('count(distinct p0.kodep) as kodep'),
                DB::raw('count(distinct p0.tid) as ne'),
                DB::raw('count(distinct if((p0.perangkat = "atm"), p0.tid, null)) as na'),
                DB::raw('count(distinct if((p0.perangkat = "crm"), p0.tid, null)) as nc'),
                DB::raw('count(distinct if((p0.perangkat = "atm" and p0.survey = 1), p0.tid, null)) as gass'),
                DB::raw('count(distinct if((p0.perangkat = "atm" and p0.survey = 1), p0.tid, null)) / count(distinct if((p0.perangkat = "atm"), p0.tid, null)) * 100 as gassp'),
                DB::raw('count(distinct if((p0.perangkat = "crm" and p0.survey = 1), p0.tid, null)) as gcss'),
                DB::raw('count(distinct if((p0.perangkat = "crm" and p0.survey = 1), p0.tid, null)) / count(distinct if((p0.perangkat = "crm"), p0.tid, null)) * 100 as gcssp'),
                DB::raw('count(distinct if(p0.survey = 1, p0.tid, null)) as gess'),
                DB::raw('count(distinct if(p0.survey = 1, p0.tid, null)) / count(distinct p0.tid) * 100 as gessp'),
                DB::raw('avg(distinct if((p0.perangkat = "atm" and p0.survey != 0), p0.achieve, null)) as achievea'),
                DB::raw('avg(distinct if((p0.perangkat = "crm" and p0.survey != 0), p0.achieve, null)) as achievec'),
                DB::raw('avg(distinct if(p0.survey != 0, p0.achieve, null)) as achievee')
            )
            ->whereNotIn('p0.ro', [' ', 'kanwil', 'Kanwil', 'Timor Leste'])
            ->groupBy('p0.ro')
            ->orderByDesc('gessp')
            ->get();
        return view('admin/dashboard', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'data' => $data,
            'lastDate' => $lastDate,
        ]);
    }
    public function ro($ro)
    {
        $lastDate = premis::orderBy('waktui', 'desc')->value('waktui');
        $data = Rankingsa::where('ro', $ro)->where('tipeu', 'kc')->get();

        return view('admin/ro', [
            'title' => 'Regional Office',
            'active' => 'ro',
            'data' => $data,
            'selectedRo' => $ro,
            'lastDate' => $lastDate,
        ]);
    }
    public function kc($namau)
{
    // Mendapatkan data dengan TID unik dan waktu terbaru
    $data = Premis::select('tid', \DB::raw('MAX(waktui) as latest_time'))
        ->where('namap', $namau)
        ->groupBy('tid')
        ->get();

    // Ambil waktu terbaru untuk setiap tid
    $latestTimes = $data->pluck('latest_time', 'tid');

    // Mendapatkan data lengkap dengan TID dan waktu terbaru
    $data = Premis::whereIn('tid', $data->pluck('tid'))
        ->whereIn('waktui', $latestTimes->values()) // Hanya entri dengan waktu terbaru
        ->orWhereNull('waktui') // Tetapkan untuk entri tanpa waktui
        ->where('namap', $namau)
        ->get();

    $data1 = [];

    foreach ($data as $row) {
        $premisesSas = Premis::where('tid', $row->tid)
            ->where(function ($query) use ($latestTimes) {
                $query->whereNotNull('waktui')
                    ->orWhereNull('waktui');
            }) // Filter berdasarkan waktui
            ->get();

        $data1[] = [
            'row' => $row,
            'premisesSas' => $premisesSas,
        ];
    }

    $lastDate = $data->max('waktui'); // Mendapatkan waktu terbaru dari data

    return view('admin/kc', [
        'title' => 'Kantor Cabang',
        'active' => 'kc',
        'data1' => $data1,
        'selectedkc' => $namau,
        'lastDate' => $lastDate,
    ]);
}






public function exportCsv($kc)
{
    // Mendapatkan TID unik dengan waktu terbaru
    $latestTids = Premis::select('tid', \DB::raw('MAX(waktui) as latest_time'))
        ->where('namap', $kc)
        ->groupBy('tid')
        ->get();

    // Mendapatkan data dengan TID unik dan waktu terbaru
    $data = Premis::whereIn('tid', $latestTids->pluck('tid'))
        ->whereIn('waktui', $latestTids->pluck('latest_time'))
        ->where('namap', $kc)
        ->get();

    $filename = 'export_kc.csv';
    $filePath = storage_path('exports/' . $filename);

    // Buka file untuk menulis
    $handle = fopen($filePath, 'w');

    // Tulis header CSV
    fputcsv($handle, [
        'Nama CPC', 'Nama KC', 'Perangkat', 'TID', 'Lokasi',
        'Jenis Lokasi', 'Waktu Survey', 'Pekerja', 'Perusahaan',
        'Score', 'Kondisi Mesin', 'Kondisi Ruangan', 'Kondisi Pintu',
        'Kondisi Pylon', 'Foto Tengah Mesin', 'Foto Seluruh Mesin', 'Foto Ruangan', 'Foto Pintu', 'Foto Pylon'
    ],';');

    foreach ($data as $premisessa) {
        $achieveValue = number_format($premisessa->achieve, 2, ',', '');
        fputcsv($handle, [
            $premisessa->nama_cpc, $premisessa->namap, $premisessa->perangkat,
            $premisessa->tid, $premisessa->lokasi,
            $premisessa->jenis_lokasi, $premisessa->waktui, $premisessa->pekerja,
            $premisessa->perusahaan, $achieveValue, $premisessa->kondisimesin,
            $premisessa->kondisiruangan, $premisessa->kondisipintu, $premisessa->kondisipylon,
            $premisessa->fototengahmesin_path, $premisessa->fotoseluruhmesin_path, $premisessa->fotoruangan_path,
            $premisessa->fotopintu_path, $premisessa->fotopylon_path,
        ],';');
    }

    // Tutup file
    fclose($handle);

    // Kembalikan file untuk diunduh
    return response()->download($filePath, $filename)->deleteFileAfterSend(true);
}


}

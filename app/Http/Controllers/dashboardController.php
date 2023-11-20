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
        $lastDate = premis::orderBy('waktui', 'desc')->value('waktui');
        $data = premis::where('namap', $namau)->paginate(5);

        $data1 = [];

    foreach ($data as $row) {
        $premisesSas = Premis::where('tid', $row->tid)->get();
        $GARIS = $premisesSas->count() + 1;

        $data1[] = [
            'row' => $row,
            'premisesSas' => $premisesSas,
            'GARIS' => $GARIS,
        ];
    }
        return view('admin/kc', [
            'title' => 'Kantor Cabang',
            'active' => 'kc',
            'data1' => $data1,
            'selectedkc' => $namau,
            'lastDate' => $lastDate,
        ]);
        // dd($data);
    }
    public function exportCsv($kc)
    {
        $data = Premis::where('kodep', $kc)->get();
        $data1 = [];

        foreach ($data as $row) {
            $premisesSas = Premis::where('tid', $row->tid)->get();
            $GARIS = $premisesSas->count() + 1;

            $data1[] = [
                'row' => $row,
                'premisesSas' => $premisesSas,
                'GARIS' => $GARIS,
            ];
        }

        // Tentukan nama file CSV dan lokasi penyimpanan
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
        ]);

        // Tulis data ke dalam file CSV
        foreach ($data1 as $item) {
            $row = $item['row'];
            $premisesSas = $item['premisesSas'];

            foreach ($premisesSas as $premisessa) {
                fputcsv($handle, [
                    $premisessa->nama_cpc, $premisessa->namap, $premisessa->perangkat,
                    $premisessa->tid, $premisessa->lokasi,
                    $premisessa->jenis_lokasi, $premisessa->waktui, $premisessa->pekerja,
                    $premisessa->perusahaan, $premisessa->achieve, $premisessa->kondisimesin,
                    $premisessa->kondisiruangan, $premisessa->kondisipintu, $premisessa->kondisipylon,
                    $premisessa->fototengahmesin_path, $premisessa->fotoseluruhmesin_path, $premisessa->fotoruangan_path,
                    $premisessa->fotopintu_path, $premisessa->fotopylon_path,
                ]);                
            }
        }

        // Tutup file
        fclose($handle);

        // Kembalikan file untuk diunduh
        return response()->download($filePath, $filename)->deleteFileAfterSend(true);
    }

}

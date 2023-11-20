<?php

namespace App\Http\Controllers;

use App\Models\premis;
use GuzzleHttp\Client;
use App\Models\Premis0;
use App\Models\rankingsa;
use App\Models\Inventaris;
use App\Imports\ExcelImport;
use Illuminate\Http\Request;
use App\Imports\InventarisImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreInventarisRequest;
use App\Http\Requests\UpdateInventarisRequest;



class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        return view('admin/nonslm/shownonslm', [
            'title' => 'Premis Non SLM',
            'active' => 'Premis Non SLM',
            'data' => $data,
            'lastDate' => $lastDate,
        ]);
    }
    public function ro($ro)
    {
        $lastDate = premis::orderBy('waktui', 'desc')->value('waktui');
        set_time_limit(0);
        // $data = Rankingsa::where('ro', $ro)->where('tipeu', 'kc')->get();
        $premis = Premis::where('ro', $ro)->get();
        $data1 = [];

        foreach ($premis as $row) {
            $premisesSas = Premis::where('tid', $row->tid)->paginate(5);
            $GARIS = $premisesSas->count() + 1;
    
            $data1[] = [
                'row' => $row,
                'premisesSas' => $premisesSas,
                'GARIS' => $GARIS,
            ];
        }

        return view('admin/nonslm/ro', [
            'title' => 'Regional Office',
            'active' => 'ro',
            // 'data' => $data,
            'data1' => $data1,
            'selectedRo' => $ro,
            'premis' => $premis,
            'lastDate' => $lastDate,
        ]);
    }

    public function inventarisexcel()
    {
        return view('admin/nonslm/excelnonslm', [
            'title' => 'Create Non SLM',
            'active' => 'Create Non SLM',
        ]);
    }
    public function importexcel(Request $request)
    {

        // Panggil metode untuk memproses data dari URL eksternal
        // $this->processDataFromExternalURLatm(); 
        // $this->processDataFromExternalURLcrm(); 
        // Import data dari file Excel
        // Excel::import(new ExcelImport, request()->file('file')); ini ga kepakai
        // $this->importpremisessa($request);
        // $this->gabungpremis0danpremisessa();
        // $this->inputyangbelumadadipremisessa();
        $this->scorepremisessa();
        $this->rangkingsaro();
        $this->rangkingsakc();
        $this->rangkingsacro();
        $this->rangkingsakl();

        
        return redirect('dashboard');
    }
    public function importpremisessa(Request $request)
    {
        set_time_limit(0);
        premis::truncate();
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);
    
        $file = $request->file('file');
        $filePath = $file->getRealPath();
    
        $handle = fopen($filePath, "r");
    
        $i = 1;
        $headerSkipped = false;
    
        while (($line = fgetcsv($handle)) !== FALSE) {
            if (!$headerSkipped) {
                $headerSkipped = true;
                continue;
            }
            $premisessa = new Premis();
    
            $premisessa->waktu = now();
            $premisessa->waktui = $line[0];
            $premisessa->tid = $line[1];
            $premisessa->fototengahmesin = $line[2];
            $premisessa->fotoseluruhmesin = $line[3];
            $premisessa->kondisimesin = $line[4];
            $premisessa->tipelokasi = $line[5];
            $premisessa->fotoruangan = $line[6];
            $premisessa->kondisiruangan = $line[7];
            $premisessa->fotopintu = $line[8];
            $premisessa->fotogedung = $line[9];
            $premisessa->kondisipintu = $line[10];
            $premisessa->jenislokasi = $line[11];
            $premisessa->fotopylon = $line[12];
            $premisessa->kondisipylon = $line[13];
            $premisessa->pekerja = $line[14];
            $premisessa->perusahaan = $line[15];
            $premisessa->team = $line[17];
            $premisessa->keterangan = $line[18];    
            $premisessa->survey = 1;
            $premisessa->no = $i;
    
            $premisessa->save();
    
            $i++;
        }
    
        fclose($handle);
    }
    public function processDataFromExternalURLatm()
    {
        set_time_limit(0);
        $url = "http://portal.jke.bri.co.id/ech_portal/dash_matrix_v_list_exp";
        $response = Http::get($url);
        $data = $response->body();

        // Mengecek apakah ada kesalahan dalam respons
        if (strpos($data, 'A PHP Error was encountered') === false) {
            $rows = explode("\n", $data);

            // Hapus data lama dari tabel
            Premis0::truncate();

            // Identifikasi indeks baris pertama yang ingin diabaikan
            $startIndex = 1; // Ubah sesuai kebutuhan

            // Proses data dan simpan dalam model
            foreach ($rows as $index => $row) {
                // Lewati indeks baris pertama
                if ($index < $startIndex) {
                    continue;
                }
                else{
                    // Lakukan pemrosesan data seperti yang Anda lakukan sebelumnya
                    $rowData = str_getcsv($row);
    
                    // Buat instance Premis0 dan simpan dalam database
                    if (!empty($rowData[0]) && strpos($rowData[52], 'DISMANTLE') === false) {
                        $premis0 = new premis0([
                            'waktu' => now(),
                            'perangkat' => 'atm',
                            'tid' => $rowData[0],
                            'sn' => $rowData[1],
                            'db' => $rowData[2],
                            'ro' => $rowData[3],
                            'kodep' => $rowData[6],
                            'namap' => $rowData[5],
                            'vendor_cpc' => $rowData[4],
                            'tim_cpc' => $rowData[7],
                            'nama_cpc' => $rowData[8],
                            'kode_cpc' => $rowData[9],
                            'jenis_cpc' => $rowData[10],
                            'lokasi' => $rowData[11],
                            'merk' => $rowData[12],
                            'jenis_lokasi' => $rowData[19],
                            'kategori_lokasi' => $rowData[20],
                            'group_lokasi' => $rowData[21],
                            'brizzi' => $rowData[48],
                            'status' => $rowData[25],
                            'prob01' => $rowData[26],
                            'prob02' => $rowData[27],
                            'ticket' => $rowData[28],
                            'rtl_ticket' => $rowData[52],
                            
                        ]);
    
                        $premis0->save();
                    }
                }
            }
        }
    }
    public function processDataFromExternalURLcrm()
    {
        set_time_limit(0);
        $url = "http://portal.jke.bri.co.id/ech_portal/dash_matrix_v_list_exp_crm";
        $response = Http::get($url);
        $data = $response->body();

        // Mengecek apakah ada kesalahan dalam respons
        if (strpos($data, 'A PHP Error was encountered') === false) {
            $rows = explode("\n", $data);
            // Identifikasi indeks baris pertama yang ingin diabaikan
            $startIndex = 1; // Ubah sesuai kebutuhan

            // Proses data dan simpan dalam model
            foreach ($rows as $index => $row) {
                // Lewati indeks baris pertama
                if ($index < $startIndex) {
                    continue;
                }
                else{
                    // Lakukan pemrosesan data seperti yang Anda lakukan sebelumnya
                    $rowData = str_getcsv($row);
    
                    // Buat instance Premis0 dan simpan dalam database
                    if (!empty($rowData[0]) && strpos($rowData[52], 'DISMANTLE') === false) {
                        $premis0 = new premis0([
                            'waktu' => now(),
                            'perangkat' => 'crm',
                            'tid' => $rowData[0],
                            'sn' => $rowData[1],
                            'db' => $rowData[2],
                            'ro' => $rowData[3],
                            'kodep' => $rowData[6],
                            'namap' => $rowData[5],
                            'vendor_cpc' => $rowData[4],
                            'tim_cpc' => $rowData[7],
                            'nama_cpc' => $rowData[8],
                            'kode_cpc' => $rowData[9],
                            'jenis_cpc' => $rowData[10],
                            'lokasi' => $rowData[11],
                            'merk' => $rowData[12],
                            'jenis_lokasi' => $rowData[19],
                            'kategori_lokasi' => $rowData[20],
                            'group_lokasi' => $rowData[21],
                            'brizzi' => $rowData[49],
                            'status' => $rowData[25],
                            'prob01' => $rowData[26],
                            'prob02' => $rowData[27],
                            'ticket' => $rowData[28],
                            'rtl_ticket' => $rowData[51],
                            
                        ]);
    
                        $premis0->save();
                    }
                }
            }
        }
    }
    public function gabungpremis0danpremisessa()
    {
        set_time_limit(0);
            // Hapus data premisessa yang memiliki tid 'tid' atau yang mengandung 'Terminal'
        premis::where('tid', 'tid')->orWhere('tid', 'like', '%Terminal%')->delete();

        // Gabungkan data antara premisessa dan premises0 berdasarkan tid
        DB::table('premisessa')
            ->join('premises0', 'premisessa.tid', '=', 'premises0.tid')
            ->update([
                'premisessa.perangkat' => DB::raw('premises0.perangkat'),
                'premisessa.sn' => DB::raw('premises0.sn'),
                'premisessa.db' => DB::raw('premises0.db'),
                'premisessa.ro' => DB::raw('premises0.ro'),
                'premisessa.vendor' => DB::raw('premises0.vendor'),
                'premisessa.kodep' => DB::raw('premises0.kodep'),
                'premisessa.namap' => DB::raw('premises0.namap'),
                'premisessa.vendor_cpc' => DB::raw('premises0.vendor_cpc'),
                'premisessa.kode_cpc' => DB::raw('premises0.kode_cpc'),
                'premisessa.nama_cpc' => DB::raw('premises0.nama_cpc'),
                'premisessa.tim_cpc' => DB::raw('premises0.tim_cpc'),
                'premisessa.jenis_cpc' => DB::raw('premises0.jenis_cpc'),
                'premisessa.lokasi' => DB::raw('premises0.lokasi'),
                'premisessa.merk' => DB::raw('premises0.merk'),
                'premisessa.jenis_lokasi' => DB::raw('premises0.jenis_lokasi'),
                'premisessa.kategori_lokasi' => DB::raw('premises0.kategori_lokasi'),
                'premisessa.group_lokasi' => DB::raw('premises0.group_lokasi'),
                'premisessa.brizzi' => DB::raw('premises0.brizzi'),
                'premisessa.status' => DB::raw('premises0.status'),
                'premisessa.prob01' => DB::raw('premises0.prob01'),
                'premisessa.prob02' => DB::raw('premises0.prob02'),
                'premisessa.ticket' => DB::raw('premises0.ticket')
            ]);
    }
    public function inputyangbelumadadipremisessa()
    {
        set_time_limit(0);
        $premises0 = premis0::all();

        foreach ($premises0 as $premise) {
            $premisessa = premis::where('tid', $premise->tid)->first();

            if (!$premisessa) {
                $premisessa = new premis();
                $premisessa->waktu = now();
                $premisessa->waktui = null;
                $premisessa->tid = $premise->tid;
                $premisessa->fototengahmesin = null;
                $premisessa->fotoseluruhmesin = null;
                $premisessa->kondisimesin = null;
                $premisessa->tipelokasi = null;
                $premisessa->fotoruangan = null;
                $premisessa->kondisiruangan = null;
                $premisessa->fotopintu = null;
                $premisessa->fotogedung = null;
                $premisessa->kondisipintu = null;
                $premisessa->jenislokasi = null;
                $premisessa->fotopylon = null;
                $premisessa->kondisipylon = null;
                $premisessa->pekerja = null;
                $premisessa->perusahaan = null;
                $premisessa->pernyataan = null;
                $premisessa->team = null;
                $premisessa->keterangan = null;
                $premisessa->survey = 0;
                $premisessa->no = 0;
                $premisessa->perangkat = $premise->perangkat;
                $premisessa->sn = $premise->sn;
                $premisessa->db = $premise->db;
                $premisessa->ro = $premise->ro;
                $premisessa->vendor_cpc = $premise->vendor_cpc;
                $premisessa->kodep = $premise->kodep;
                $premisessa->namap = $premise->namap;
                $premisessa->kode_cpc = $premise->kode_cpc;
                $premisessa->nama_cpc = $premise->nama_cpc;
                $premisessa->tim_cpc = $premise->tim_cpc;
                $premisessa->jenis_cpc = $premise->jenis_cpc;
                $premisessa->lokasi = $premise->lokasi;
                $premisessa->merk = $premise->merk;
                $premisessa->jenis_lokasi = $premise->jenis_lokasi;
                $premisessa->kategori_lokasi = $premise->kategori_lokasi;
                $premisessa->group_lokasi = $premise->group_lokasi;
                $premisessa->brizzi = $premise->brizzi;
                $premisessa->status = $premise->status;
                $premisessa->prob01 = $premise->prob01;
                $premisessa->prob02 = $premise->prob02;
                $premisessa->ticket = $premise->ticket;
                $premisessa->ups = $premise->ups;
                $premisessa->upsilon = $premise->upsilon;
                $premisessa->ms = $premise->ms;
                $premisessa->save();
            }
        }
    }
    public function scorepremisessa()
    {
        set_time_limit(0);
        DB::table('premisessa')
        ->where('survey', 1)
        ->update([
            'score' => DB::raw("IF(LOCATE('Sudah', kondisimesin) != 0, 1, 0) + IF(LOCATE('Sudah', kondisiruangan) != 0, 1, 0) + IF(LOCATE('Baru', kondisipintu) != 0, 1, 0) + IF(LOCATE('Terbaru', kondisipylon) != 0, 1, 0)"),
            'achieve' => DB::raw("CASE 
                WHEN tipelokasi LIKE '%khusus%' AND jenislokasi LIKE '%offsite%' THEN (score / 4) * 100
                WHEN tipelokasi LIKE '%khusus%' AND jenislokasi LIKE '%onsite%' THEN (score / 3) * 100
                WHEN tipelokasi LIKE '%sharing%' AND jenislokasi LIKE '%offsite%' THEN (score / 2) * 100
                WHEN tipelokasi LIKE '%sharing%' AND jenislokasi LIKE '%onsite%' THEN score * 100
                ELSE NULL
            END")
        ]);
    }
    public function rangkingsaro()
    {
        set_time_limit(0);
        Rankingsa::truncate();

        $result = DB::table('premisessa')
        ->whereNotIn('ro', [' ', 'kanwil', 'Kanwil', 'Timor Leste'])
        ->groupBy('ro')
        ->select(
            'ro',
            DB::raw("'ro' as tipeu"),
            DB::raw('ro as noe'),
            DB::raw('count(distinct tid) as noe'),
            DB::raw('count(distinct case when perangkat = "atm" then tid end) as noa'),
            DB::raw('count(distinct case when perangkat = "crm" then tid end) as noc'),
            DB::raw('count(distinct case when survey = 1 then tid end) as tse'),
            DB::raw('count(distinct case when perangkat = "atm" and survey = 1 then tid end) as tsa'),
            DB::raw('count(distinct case when perangkat = "crm" and survey = 1 then tid end) as tsc'),
            DB::raw('count(distinct case when survey = 1 then tid end) / count(distinct tid) * 100 as tsep'),
            DB::raw('count(distinct case when perangkat = "atm" and survey = 1 then tid end) / count(distinct case when perangkat = "atm" then tid end) * 100 as tsap'),
            DB::raw('count(distinct case when perangkat = "crm" and survey = 1 then tid end) / count(distinct case when perangkat = "crm" then tid end) * 100 as tscp'),
            DB::raw('avg(distinct case when survey = 1 then achieve else 0 end) as pse'),
            DB::raw('avg(distinct case when perangkat = "atm" and survey = 1 then achieve else 0 end) as psa'),
            DB::raw('avg(distinct case when perangkat = "crm" and survey = 1 then achieve else 0 end) as psc')
        )
        ->orderByDesc('tsep')
        ->orderByDesc('noe')
        ->get();

        foreach ($result as $row) {
            Rankingsa::create([
                'namau' => $row->ro,
                'tipeu' => 'ro',
                'ro' => $row->ro,
                'noe' => $row->noe,
                'noa' => $row->noa,
                'noc' => $row->noc,
                'tse' => $row->tse,
                'tsa' => $row->tsa,
                'tsc' => $row->tsc,
                'tsep' => $row->tsep,
                'tsap' => $row->tsap,
                'tscp' => $row->tscp,
                'pse' => $row->pse,
                'psa' => $row->psa,
                'psc' => $row->psc,
            ]);
        }
    }
    public function rangkingsakc()
    {
        set_time_limit(0);

        $result = DB::table('premisessa')
            ->whereNotIn('ro', [' ', 'kanwil', 'Kanwil', 'Timor Leste'])
            ->groupBy('kodep', 'namap','ro')
            ->select(
                'kodep as kodeau',
                'namap as namau',
                DB::raw("'kc' as tipeu"),
                'ro',
                DB::raw('count(distinct tid) as noe'),
                DB::raw('count(distinct case when perangkat = "atm" then tid end) as noa'),
                DB::raw('count(distinct case when perangkat = "crm" then tid end) as noc'),
                DB::raw('count(distinct case when survey = 1 then tid end) as tse'),
                DB::raw('count(distinct case when perangkat = "atm" and survey = 1 then tid end) as tsa'),
                DB::raw('count(distinct case when perangkat = "crm" and survey = 1 then tid end) as tsc'),
                DB::raw('count(distinct case when survey = 1 then tid end) / count(distinct tid) * 100 as tsep'),
                DB::raw('count(distinct case when perangkat = "atm" and survey = 1 then tid end) / count(distinct case when perangkat = "atm" then tid end) * 100 as tsap'),
                DB::raw('count(distinct case when perangkat = "crm" and survey = 1 then tid end) / count(distinct case when perangkat = "crm" then tid end) * 100 as tscp'),
                DB::raw('avg(distinct case when survey = 1 then achieve else 0 end) as pse'),
                DB::raw('avg(distinct case when perangkat = "atm" and survey = 1 then achieve else 0 end) as psa'),
                DB::raw('avg(distinct case when perangkat = "crm" and survey = 1 then achieve else 0 end) as psc')
            )
            ->orderByDesc('tsep')
            ->orderByDesc('noe')
            ->get();

        foreach ($result as $row) {
            Rankingsa::insert([
                'kodeu' => $row->kodeau,
                'namau' => $row->namau,
                'tipeu' => $row->tipeu,
                'ro' => $row->ro,
                'noe' => $row->noe,
                'noa' => $row->noa,
                'noc' => $row->noc,
                'tse' => $row->tse,
                'tsa' => $row->tsa,
                'tsc' => $row->tsc,
                'tsep' => $row->tsep,
                'tsap' => $row->tsap,
                'tscp' => $row->tscp,
                'pse' => $row->pse,
                'psa' => $row->psa,
                'psc' => $row->psc,
            ]);
        }
    }
    public function rangkingsacro()
    {
        set_time_limit(0);
        $result = DB::table('premisessa')
        ->whereNotIn('ro', [' ', 'kanwil', 'Kanwil', 'Timor Leste'])
        ->where('jenis_cpc', 'CRO')
        ->groupBy('vendor_cpc')
        ->select(
            'vendor_cpc as namau',
            DB::raw("'cro' as tipeu"),
            'vendor_cpc as ro',
            DB::raw('count(distinct tid) as noe'),
            DB::raw('count(distinct case when perangkat = "atm" then tid end) as noa'),
            DB::raw('count(distinct case when perangkat = "crm" then tid end) as noc'),
            DB::raw('count(distinct case when survey = 1 then tid end) as tse'),
            DB::raw('count(distinct case when perangkat = "atm" and survey = 1 then tid end) as tsa'),
            DB::raw('count(distinct case when perangkat = "crm" and survey = 1 then tid end) as tsc'),
            DB::raw('count(distinct case when survey = 1 then tid end) / count(distinct tid) * 100 as tsep'),
            DB::raw('count(distinct case when perangkat = "atm" and survey = 1 then tid end) / count(distinct case when perangkat = "atm" then tid end) * 100 as tsap'),
            DB::raw('count(distinct case when perangkat = "crm" and survey = 1 then tid end) / count(distinct case when perangkat = "crm" then tid end) * 100 as tscp'),
            DB::raw('avg(distinct case when survey = 1 then achieve else 0 end) as pse'),
            DB::raw('avg(distinct case when perangkat = "atm" and survey = 1 then achieve else 0 end) as psa'),
            DB::raw('avg(distinct case when perangkat = "crm" and survey = 1 then achieve else 0 end) as psc')
        )
        ->orderByDesc('tsep')
        ->orderByDesc('noe')
        ->get();

        foreach ($result as $row) {
            Rankingsa::create([
                'namau' => $row->namau,
                'tipeu' => $row->tipeu,
                'ro' => $row->ro,
                'noe' => $row->noe,
                'noa' => $row->noa,
                'noc' => $row->noc,
                'tse' => $row->tse,
                'tsa' => $row->tsa,
                'tsc' => $row->tsc,
                'tsep' => $row->tsep,
                'tsap' => $row->tsap,
                'tscp' => $row->tscp,
                'pse' => $row->pse,
                'psa' => $row->psa,
                'psc' => $row->psc,
            ]);
        }
    }
    public function rangkingsakl(){
        set_time_limit(0);
        $result = DB::table('premisessa')
        ->whereNotIn('ro', [' ', 'kanwil', 'Kanwil', 'Timor Leste'])
        ->where('jenis_cpc', 'CRO')
        ->groupBy('nama_cpc', 'vendor_cpc')
        ->select(
            'nama_cpc as namau',
            DB::raw("'kl' as tipeu"),
            'vendor_cpc as ro',
            DB::raw('count(distinct tid) as noe'),
            DB::raw('count(distinct case when perangkat = "atm" then tid end) as noa'),
            DB::raw('count(distinct case when perangkat = "crm" then tid end) as noc'),
            DB::raw('count(distinct case when survey = 1 then tid end) as tse'),
            DB::raw('count(distinct case when perangkat = "atm" and survey = 1 then tid end) as tsa'),
            DB::raw('count(distinct case when perangkat = "crm" and survey = 1 then tid end) as tsc'),
            DB::raw('count(distinct case when survey = 1 then tid end) / count(distinct tid) * 100 as tsep'),
            DB::raw('count(distinct case when perangkat = "atm" and survey = 1 then tid end) / count(distinct case when perangkat = "atm" then tid end) * 100 as tsap'),
            DB::raw('count(distinct case when perangkat = "crm" and survey = 1 then tid end) / count(distinct case when perangkat = "crm" then tid end) * 100 as tscp'),
            DB::raw('avg(distinct case when survey = 1 then achieve else 0 end) as pse'),
            DB::raw('avg(distinct case when perangkat = "atm" and survey = 1 then achieve else 0 end) as psa'),
            DB::raw('avg(distinct case when perangkat = "crm" and survey = 1 then achieve else 0 end) as psc')
        )
        ->orderByDesc('tsep')
        ->orderByDesc('noe')
        ->get();

        foreach ($result as $row) {
            Rankingsa::create([
                'namau' => $row->namau,
                'tipeu' => $row->tipeu,
                'ro' => $row->ro,
                'noe' => $row->noe,
                'noa' => $row->noa,
                'noc' => $row->noc,
                'tse' => $row->tse,
                'tsa' => $row->tsa,
                'tsc' => $row->tsc,
                'tsep' => $row->tsep,
                'tsap' => $row->tsap,
                'tscp' => $row->tscp,
                'pse' => $row->pse,
                'psa' => $row->psa,
                'psc' => $row->psc,
            ]);
        }
    }

    public function exportpremises($ro)
    {
        $premisessas = Premis::where('ro', $ro)->get();

        // Tentukan nama file CSV dan lokasi penyimpanan
        $filename = 'export_premisesRO.csv';
        $filePath = storage_path('exports/' . $filename);

        // Buka file untuk menulis
        $handle = fopen($filePath, 'w');

        fputcsv($handle, [
            'Nama CPC', 'Nama KC', 'Perangkat', 'TID', 'Lokasi',
            'Jenis Lokasi', 'Waktu Survey', 'Pekerja', 'Perusahaan',
            'Score', 'Kondisi Mesin', 'Kondisi Ruangan', 'Kondisi Pintu',
            'Kondisi Pylon', 'Foto Tengah Mesin', 'Foto Seluruh Mesin', 'Foto Ruangan', 'Foto Pintu', 'Foto Pylon'
        ]);

        foreach ($premisessas as $premisessa) {
            fputcsv($handle, [
                $premisessa->nama_cpc, $premisessa->namap, $premisessa->perangkat,
                $premisessa->tid, $premisessa->lokasi,
                $premisessa->jenis_lokasi, $premisessa->waktui, $premisessa->pekerja,
                $premisessa->perusahaan, $premisessa->achieve, $premisessa->kondisimesin,
                $premisessa->kondisiruangan, $premisessa->kondisipintu, $premisessa->kondisipylon,
                $premisessa->fototengahmesin, $premisessa->fotoseluruhmesin, $premisessa->fotoruangan,
                $premisessa->fotopintu, $premisessa->fotopylon,
            ]);
        }

        // Tutup file
        fclose($handle);

        // Kembalikan file untuk diunduh
        return response()->download($filePath, $filename)->deleteFileAfterSend(true);
    }



    

    public function __invoke()
    {

    }
}

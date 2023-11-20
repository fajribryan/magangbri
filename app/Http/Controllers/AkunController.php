<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\lokasi;
use App\Models\premisslm;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        return view('admin/slm/showslm',[
            'title' => 'Premis SLM',
            'active' => 'SLM',
        ]);
    }
    public function exportslm()
    {
        return view('admin/slm/exportslm', [
            'title' => 'Create SLM',
            'active' => 'Create SLM',
        ]);
    }
    public function exportexcellslm(Request $request)
    {

        // Panggil metode untuk memproses data dari URL eksternal
        $this->processDataFromExternalURLatm(); 
        $this->processDataFromExternalURLcrm(); 
        // Import data dari file Excel
        $this->importpremisessa($request);
        $this->gabungpremis0danpremisessa();
        $this->inputyangbelumadadipremisessa();
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
        premisslm::truncate();
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
            $premisessa = new premisslm();
    
            $premisessa->waktu = now();
            $premisessa->waktui = $line[0];
            $premisessa->tid = $line[1];
            $premisessa->perangkatfoto = $line[2];
            $premisessa->ruanganfoto = $line[3];
            $premisessa->perangkat = $line[4];
            $premisessa->atmstips = $line[5];
            $premisessa->atmsinsert = $line[6];
            $premisessa->atmsdenom = $line[7];
            $premisessa->atmsbrizzi = $line[8];
            $premisessa->atmsbody = $line[9];
            $premisessa->atmposter = $line[10];
            $premisessa->atmkstruk = $line[11];
            $premisessa->atmkbody = $line[12];
            $premisessa->atmkepp = $line[13];
            $premisessa->crmstips = $line[14];
            $premisessa->crmsinsert = $line[15];
            $premisessa->crmssetortarik = $line[17];
            $premisessa->crmsbrizzi = $line[18];    
            $premisessa->crmsbody = $line[19]; 
            $premisessa->crmkDSA = $line[20]; 
            $premisessa->crmposter = $line[21];
            $premisessa->crmkstruk = $line[22];
            $premisessa->crmkbody = $line[23];
            $premisessa->crmkepp = $line[24];
            $premisessa->lokasii = $line[25];
            $premisessa->lokasijenis = $line[26];
            $premisessa->banklainada = $line[27];
            $premisessa->martjenis = $line[28];
            $premisessa->martnama = $line[29];
            $premisessa->khususfotopintu = $line[30];
            $premisessa->khususfotosignage = $line[31];
            $premisessa->khususplafon = $line[32];
            $premisessa->khususdinding = $line[33];
            $premisessa->khususlampu = $line[34];
            $premisessa->khusussuhu = $line[35];
            $premisessa->khusushandle = $line[36];
            $premisessa->khususshandle = $line[37];
            $premisessa->khususspintu = $line[38];    
            $premisessa->khususssandblas = $line[39];  
            $premisessa->khususstartib = $line[40];  
            $premisessa->khusustsampah = $line[41];  
            $premisessa->sharinglantai = $line[42];
            $premisessa->sharingkabel = $line[43];
            $premisessa->sharingtsampah = $line[44];
            $premisessa->pylonfoto = $line[45];
            $premisessa->pylonlampu = $line[46];
            $premisessa->pylonposisi = $line[47];
            $premisessa->pylondesain = $line[48];
            $premisessa->coverada = $line[49];
            $premisessa->coverjenis = $line[50];
            $premisessa->coverkondisi = $line[51];
            $premisessa->keamananspalsu = $line[52];
            $premisessa->keamananfotospalsu = $line[53];
            $premisessa->kemananbnonbri = $line[54];
            $premisessa->keamananfotobnonbri = $line[55];
            $premisessa->boxitfoto = $line[56];
            $premisessa->boxitkunci = $line[57];
            $premisessa->keamananskimming = $line[58];
            $premisessa->keamananfotoskimming = $line[59];    
            $premisessa->cctvada = $line[60];
            $premisessa->cctvmerk = $line[61];
            $premisessa->cctvfungsi = $line[62];
            $premisessa->cctvnvr = $line[63];
            $premisessa->upsada = $line[64];
            $premisessa->upsmerk = $line[65];
            $premisessa->upsnormal = $line[66];
            $premisessa->lainlain = $line[67];
            $premisessa->picnama = $line[68];
            $premisessa->picpn = $line[69];
            $premisessa->pichp = $line[70];
            $premisessa->picpernyataan = $line[71];
            $premisessa->dtfotomontagedt = $line[72];
            $premisessa->dtfotomontagein = $line[73];
            $premisessa->dtfotomontageout = $line[74];
            $premisessa->dtfotobangunan = $line[75];
            $premisessa->banklaindaftar = $line[76];
            $premisessa->dtfotomontagedalam = $line[76];
            $premisessa->dtfotomontageluar = $line[77];
            $premisessa->dtfototaman = $line[78];    
            $premisessa->dtfotoruangan = $line[79];
            $premisessa->dtmontagekondisi = $line[80];
            $premisessa->coverlampu = $line[81];
            $premisessa->upssmartups = $line[82];
            $premisessa->upskabel = $line[83];
            $premisessa->upsfotoups = $line[84];
            $premisessa->upsfotosmartups = $line[85];
            $premisessa->upsfotokabel = $line[86];
            $premisessa->cctvmerekam = $line[87];
            $premisessa->cctvfotocamera = $line[88];
            $premisessa->cctvfotonvr = $line[89];
            $premisessa->backdropfoto = $line[90];
            $premisessa->backdropbersih = $line[91];
            $premisessa->backdropdibuka = $line[92];
            $premisessa->backdropkabel = $line[93];
            $premisessa->backdropterkunci = $line[94];
            $premisessa->backdropkondisi = $line[95];
            $premisessa->boxitbersih = $line[96];
            $premisessa->dtkondisimontageinout = $line[97];
            $premisessa->dtkondisimontagedalam = $line[98];
            $premisessa->dtkondisibangunan = $line[99];
            $premisessa->dtkondisiruangan = $line[100];    
            $premisessa->dtkondisitaman = $line[101];
            $premisessa->acada = $line[102];
            $premisessa->acposisi = $line[103];
            $premisessa->ackondisi = $line[104];
            $premisessa->upssn = $line[105];
            $premisessa->cctvsn = $line[106];
            $premisessa->piccro = $line[107];    
            $premisessa->pylonada = $line[108];
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
        premisslm::where('tid', 'tid')->orWhere('tid', 'like', '%Terminal%')->delete();

        // Gabungkan data antara premisessa dan premises0 berdasarkan tid
        DB::table('premisesslm')
            ->join('premises0', 'premisesslm.tid', '=', 'premises0.tid')
            ->update([
                'premisesslm.perangkat' => DB::raw('premises0.perangkat'),
                'premisesslm.sn' => DB::raw('premises0.sn'),
                'premisesslm.db' => DB::raw('premises0.db'),
                'premisesslm.ro' => DB::raw('premises0.ro'),
                'premisesslm.vendor' => DB::raw('premises0.vendor'),
                'premisesslm.kodep' => DB::raw('premises0.kodep'),
                'premisesslm.namap' => DB::raw('premises0.namap'),
                'premisesslm.vendor_cpc' => DB::raw('premises0.vendor_cpc'),
                'premisesslm.kode_cpc' => DB::raw('premises0.kode_cpc'),
                'premisesslm.nama_cpc' => DB::raw('premises0.nama_cpc'),
                'premisesslm.tim_cpc' => DB::raw('premises0.tim_cpc'),
                'premisesslm.jenis_cpc' => DB::raw('premises0.jenis_cpc'),
                'premisesslm.lokasi' => DB::raw('premises0.lokasi'),
                'premisesslm.merk' => DB::raw('premises0.merk'),
                'premisesslm.jenis_lokasi' => DB::raw('premises0.jenis_lokasi'),
                'premisesslm.kategori_lokasi' => DB::raw('premises0.kategori_lokasi'),
                'premisesslm.group_lokasi' => DB::raw('premises0.group_lokasi'),
                'premisesslm.brizzi' => DB::raw('premises0.brizzi'),
                'premisesslm.status' => DB::raw('premises0.status'),
                'premisesslm.prob01' => DB::raw('premises0.prob01'),
                'premisesslm.prob02' => DB::raw('premises0.prob02'),
                'premisesslm.ticket' => DB::raw('premises0.ticket')
            ]);
    }
    public function inputyangbelumadadipremisessa()
    {
        set_time_limit(0);
        $premises0 = premis0::all();

        foreach ($premises0 as $premise) {
            $premisessa = premisslm::where('tid', $premise->tid)->first();

            if (!$premisessa) {
                $premisessa = new premisslm();
                $premisessa->waktu = now();
                $premisessa->waktui = null;
                $premisessa->tid = $premise->tid;
                $premisessa->perangkatfoto = null;
                $premisessa->ruanganfoto = null;
                $premisessa->atmstips = null;
                $premisessa->atmsinsert = null;
                $premisessa->atmsdenom = null;
                $premisessa->atmsbrizzi = null;
                $premisessa->atmsbody = null;
                $premisessa->atmposter = null;
                $premisessa->atmkstruk = null;
                $premisessa->atmkbody = null;
                $premisessa->atmkepp = null;
                $premisessa->crmstips = null;
                $premisessa->crmsinsert = null;
                $premisessa->crmssetortarik = null;
                $premisessa->crmsbrizzi = null;
                $premisessa->crmsbody = null;
                $premisessa->crmkDSA = null;
                $premisessa->crmposter = null;
                $premisessa->crmkstruk = null;
                $premisessa->crmkbody = null;
                $premisessa->crmkepp = null;
                $premisessa->lokasii = null;
                $premisessa->lokasijenis = null;
                $premisessa->banklainada = null;
                $premisessa->martjenis = null;
                $premisessa->martnama = null;
                $premisessa->khususfotopintu = null;
                $premisessa->khususfotosignage = null;
                $premisessa->khususplafon = null;
                $premisessa->khususdinding = null;
                $premisessa->khususlampu = null;
                $premisessa->khusussuhu = null;
                $premisessa->khusushandle = null;
                $premisessa->khususshandle = null;
                $premisessa->khususspintu = null;
                $premisessa->khususstartib = null;
                $premisessa->khusustsampah = null;
                $premisessa->sharinglantai = null;
                $premisessa->sharingkabel = null;
                $premisessa->sharingtsampah = null;
                $premisessa->pylonfoto = null;
                $premisessa->pylonlampu = null;
                $premisessa->pylonposisi = null;
                $premisessa->pylondesain = null;
                $premisessa->coverada = null;
                $premisessa->coverjenis = null;
                $premisessa->coverkondisi = null;
                $premisessa->keamananspalsu = null;
                $premisessa->keamananfotospalsu = null;
                $premisessa->kemananbnonbri = null;
                $premisessa->keamananfotobnonbri = null;
                $premisessa->boxitfoto = null;
                $premisessa->boxitkunci = null;
                $premisessa->keamananskimming = null;
                $premisessa->keamananfotoskimming = null;
                $premisessa->cctvada = null;
                $premisessa->cctvmerk = null;
                $premisessa->cctvfungsi = null;
                $premisessa->cctvnvr = null;
                $premisessa->upsada = null;
                $premisessa->upsmerk = null;
                $premisessa->upsnormal = null;
                $premisessa->lainlain = null;
                $premisessa->picnama = null;
                $premisessa->picpn = null;
                $premisessa->pichp = null;
                $premisessa->picpernyataan = null;
                $premisessa->dtfotomontagedt = null;
                $premisessa->dtfotomontagein = null;
                $premisessa->dtfotomontageout = null;
                $premisessa->dtfotobangunan = null;
                $premisessa->banklaindaftar = null;
                $premisessa->dtfotomontagedalam = null;
                $premisessa->dtfotomontageluar = null;
                $premisessa->dtfototaman = null;
                $premisessa->dtfotoruangan = null;
                $premisessa->dtmontagekondisi = null;
                $premisessa->coverlampu = null;
                $premisessa->upssmartups = null;
                $premisessa->upskabel = null;
                $premisessa->upsfotoups = null;
                $premisessa->upsfotosmartups = null;
                $premisessa->upsfotokabel = null;
                $premisessa->cctvmerekam = null;
                $premisessa->cctvfotocamera = null;
                $premisessa->cctvfotonvr = null;
                $premisessa->backdropfoto = null;
                $premisessa->backdropbersih = null;
                $premisessa->backdropdibuka = null;
                $premisessa->backdropkabel = null;
                $premisessa->backdropterkunci = null;
                $premisessa->backdropkondisi = null;
                $premisessa->boxitbersih = null;
                $premisessa->dtkondisimontageinout = null;
                $premisessa->dtkondisimontagedalam = null;
                $premisessa->dtkondisibangunan = null;
                $premisessa->dtkondisiruangan = null;
                $premisessa->dtkondisitaman = null;
                $premisessa->acada = null;
                $premisessa->acposisi = null;
                $premisessa->ackondisi = null;
                $premisessa->upssn = null;
                $premisessa->cctvsn = null;
                $premisessa->piccro = null;
                $premisessa->pylonada = null;
                $premisessa->survey = 0;
                $premisessa->no = 0;
                $premisessa->score = 0;
                $premisessa->achieve = 0;
                $premisessa->perangkat = $premise->perangkat;
                $premisessa->ro = $premise->ro;
                $premisessa->vendor = $premise->vendor;
                $premisessa->kodep = $premise->kodep;
                $premisessa->namap = $premise->namap;
                $premisessa->vendor_cpc = $premise->vendor_cpc;
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
                $premisessa->rtl_ticket = $premise->rtl_ticket;
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
}

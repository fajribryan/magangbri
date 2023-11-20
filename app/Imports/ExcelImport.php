<?php

namespace App\Imports;

use App\Models\premis;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class ExcelImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        set_time_limit(0);
        premis::truncate();
        try {
                premis::create([
                    'waktu' => now(),
                    'waktui' => $row['waktui'],
                    'tid' => $row['tid'],
                    'fototengahmesin' => $row['fototengahmesin'],
                    'fotoseluruhmesin' => $row['fotoseluruhmesin'],
                    'kondisimesin' => $row['kondisimesin'],
                    'tipelokasi' => $row['tipelokasi'],
                    'fotoruangan' => $row['fotoruangan'],
                    'kondisiruangan' => $row['kondisiruangan'],
                    'fotopintu' => $row['fotopintu'],
                    'fotogedung' => $row['fotogedung'],
                    'kondisipintu' => $row['kondisipintu'],
                    'jenislokasi' => $row['jenislokasi'],
                    'fotopylon' => $row['fotopylon'],
                    'kondisipylon' => $row['kondisipylon'],
                    'pekerja' => $row['pekerja'],
                    'perusahaan' => $row['perusahaan'],
                    'team' => $row['team'],
                    'keterangan' => $row['keterangan'],
                    'survey' => '1',
            ]);
        } catch (\Exception $e) {
            \Log::error('Error creating premis: ' . $e->getMessage());
    }
    }
}

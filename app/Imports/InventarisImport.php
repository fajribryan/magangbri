<?php

namespace App\Imports;

use App\Models\Inventaris;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class InventarisImport implements ToCollection
{
   
    public function Inventaris(Collection  $row)
    {
        return new Inventaris([
            'tid' => $row[1],
            'merek_mesin' => $row[2],
            'tipe_mesin' => $row[3],
            'jenis_mesin' => $row[4],
            'merek_cctv' => $row[5],
            'merek_ups' => $row[6],
            'vendor_slm_cctv' => $row[7],
            'vendor_slm_ups' => $row[8],
            'vendor_kebersihan' => $row[9],
            'vendor_pjpur' => $row[10],
            'cover' => $row[11],
            'lokasi' => $row[12],
            'long' => $row[13],
            'lat' => $row[14],
            'jenis_lokasi' => $row[15],
            'tipe_lokasi' => $row[16],
            'kategori_lokasi' => $row[17],
            'kategori_grup' => $row[18],
            'nilai_sewa_tahunan' => $row[19],
            'sewa_mulai' => $row[20],
            'sewa_akhir' => $row[21],
            'kode_kc' => $row[22],
            'nama_kc' => $row[23],
            'kode_uko' => $row[24],
            'nama_uko' => $row[25],
            'kode_ro' => $row[26],
            'nama_ro' => $row[27],
        ]);
    }
}

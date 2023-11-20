<?php

namespace App\Imports;

use App\Models\premis0;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class CsvImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        $i = 1;
        while (($line = fgetcsv($handle)) !== FALSE) {
            // Gunakan Carbon untuk mengonversi tanggal
            $formattedDate = $line[0] ? Carbon::parse($line[1]) : null;

            // Gunakan metode create untuk membuat instance model dan menyimpannya
            premis::create([
                'waktu' => now(),
                'waktui' => $formattedDate,
                'tid' => $line[1],
                'fototengahmesin' => $line[2],
                'fotoseluruhmesin' => $line[3],
                'kondisimesin' => $line[4],
                'tipelokasi' => $line[5],
                'fotoruangan' => $line[6],
                'kondisiruangan' => $line[7],
                'fotopintu' => $line[8],
                'fotogedung' => $line[9],
                'kondisipintu' => $line[10],
                'jenislokasi' => $line[11],
                'fotopylon' => $line[12],
                'kondisipylon' => $line[13],
                'pekerja' => $line[14],
                'perusahaan' => $line[15],
                'team' => $line[17],
                'keterangan' => $line[18],
                'survey' => '1',
                'no' => $i,
            ]);

            $i++;
        }
    }
}

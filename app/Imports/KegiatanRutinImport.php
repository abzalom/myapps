<?php

namespace App\Imports;

use App\Models\A7KegiatanRutin;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KegiatanRutinImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dump($row);
        // return new A7KegiatanRutin([
        //     //
        // ]);
        A7KegiatanRutin::create($row);
    }
}

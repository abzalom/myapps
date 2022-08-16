<?php

namespace App\Imports;

use App\Models\A8SubkegiatanRutin;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubkegiatanRutinImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        A8SubkegiatanRutin::create($row);
        // return new A8SubkegiatanRutin([
        //     //
        // ]);
    }
}

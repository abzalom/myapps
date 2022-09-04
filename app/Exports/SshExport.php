<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SshExport implements FromArray, WithHeadings
{
    public $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    public function array(): array
    {
        return $this->data;
    }
    public function headings(): array
    {
        return [
            'kode', 'uraian', 'spesifikasi', 'harga', 'satuan', 'inflasi', 'rekening', 'nama_rekening', 'kelompok',
        ];
    }
}

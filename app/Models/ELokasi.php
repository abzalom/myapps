<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ELokasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'lokasi'
    ];
}

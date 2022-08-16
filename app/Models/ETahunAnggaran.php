<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ETahunAnggaran extends Model
{
    use HasFactory;

    protected $fillable = ['tahun', 'is_active'];
}

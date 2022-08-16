<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class M5RanwalKategori extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
}

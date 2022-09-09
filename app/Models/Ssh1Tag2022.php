<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ssh1Tag2022 extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
}

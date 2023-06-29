<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualans';
    protected $guarded = [];

    // public function getTanggalPeriodeAttribute($value)
    // {
    //     return Carbon::parse($value)->isoFormat('MMMM Y');
    // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class pembatalanTransaksi extends Model
{
    use HasFactory;
    protected $table = 'pembatalan_transaksis';
    protected $guarded = [];

    public function getTanggalAttribute($value)
    {
        return Carbon::parse($value)->isoFormat('MMMM Y');
    }
}

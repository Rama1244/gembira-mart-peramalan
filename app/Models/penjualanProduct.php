<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class penjualanProduct extends Model
{
    use HasFactory;
    protected $table = 'penjualan_products';
    protected $guarded = [];

}

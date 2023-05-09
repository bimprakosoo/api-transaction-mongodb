<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Kendaraan extends Eloquent
{
  protected $connection = 'mongodb';
  
  protected $collection = 'kendaraan';
  protected $fillable = [
    'tahun_keluaran', 'warna', 'harga', 'motor', 'mobil'
  ];
  protected $casts = [
    'tahun_keluaran' => 'integer',
    'harga' => 'float',
    'motor' => 'array',
    'mobil' => 'array'
  ];
}
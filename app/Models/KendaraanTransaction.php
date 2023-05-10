<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class KendaraanTransaction extends Eloquent
{
  protected $connection = 'mongodb';
  protected $collection = 'kendaraan_transactions';
  protected $fillable = ['kendaraan_id', 'nama_pembeli', 'alamat_pembeli', 'tanggal_transaksi'];
  protected $dates = ['tanggal_transaksi'];
  
  public function kendaraan()
  {
    return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
  }
}

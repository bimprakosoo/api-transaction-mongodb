<?php

namespace App\Repositories;

use App\Models\Kendaraan;

class KendaraanRepository
{
  public function checkStock(Kendaraan $kendaraan): array
  {
    try {
    // Count the number of kendaraap that match the warna field
    $totalStock = Kendaraan::where('warna', $kendaraan->warna)->count();
    
    // If there are no stock found, return false
    if ($totalStock === 0) {
      return ['in_stock' => false, 'total_stock' => 0];
    }
    
    // If there are documents found, return true and the total stock count
    return ['in_stock' => true, 'total_stock' => $totalStock];
    } catch (\Exception $exception) {
      return ['in_stock' => false, 'total_stock' => 0];
    }
  }
}


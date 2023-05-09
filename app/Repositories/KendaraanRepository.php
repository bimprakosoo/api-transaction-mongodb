<?php

namespace App\Repositories;

use App\Models\Kendaraan;

class KendaraanRepository
{
  public function checkStock(Kendaraan $kendaraan): array
  {
    // Count the number of documents from the MongoDB collection that match the warna field
    $totalStock = Kendaraan::where('warna', $kendaraan->warna)->count();
    
    // If there are no documents found, return false
    if ($totalStock === 0) {
      return ['in_stock' => false, 'total_stock' => 0];
    }
    
    // If there are documents found, return true and the total stock count
    return ['in_stock' => true, 'total_stock' => $totalStock];
  }
}


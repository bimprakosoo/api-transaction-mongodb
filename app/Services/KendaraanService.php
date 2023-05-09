<?php

namespace App\Services;

use App\Models\Kendaraan;
use App\Repositories\KendaraanRepository;

class KendaraanService
{
  private $kendaraanRepository;
  
  public function __construct(KendaraanRepository $kendaraanRepository)
  {
    $this->kendaraanRepository = $kendaraanRepository;
  }
  
  public function checkStock(Kendaraan $kendaraan): array
  {
    // Check if the Kendaraan object is in stock
    $inStock = $this->kendaraanRepository->checkStock($kendaraan);
    
    return $inStock;
  }
}

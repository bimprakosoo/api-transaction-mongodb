<?php

namespace App\Repositories;

use App\Models\KendaraanTransaction;

class KendaraanTransactionRepository
{
  
  public function create(array $data): KendaraanTransaction
  {
    try {
      return KendaraanTransaction::create($data);
    } catch (\Exception $exception) {
      throw new \Exception('Failed to create Kendaraan Transaction', 500);
    }
  }
  
  public function getSalesData(): array
  {
    try {
      // Retrieve sales data from the database
      $salesData = KendaraanTransaction::all()->toArray();
      // Return the sales data
      return $salesData;
    } catch (\Exception $exception) {
      throw new \Exception('Failed to retrieve sales data.', 500);
    }
  }
}


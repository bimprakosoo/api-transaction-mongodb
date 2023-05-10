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
}


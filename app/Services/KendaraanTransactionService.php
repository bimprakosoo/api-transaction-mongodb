<?php

namespace App\Services;

use App\Models\KendaraanTransaction;
use App\Repositories\KendaraanTransactionRepository;

class KendaraanTransactionService
{
  private $kendaraanTransactionRepository;
  
  public function __construct(KendaraanTransactionRepository $kendaraanTransactionRepository)
  {
    $this->kendaraanTransactionRepository = $kendaraanTransactionRepository;
  }
  
  public function create(array $data): KendaraanTransaction
  {
    $kendaraanTransaction = $this->kendaraanTransactionRepository->create($data);
    
    return $kendaraanTransaction;
  }
}



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
  
  public function generateSalesReport(): array
  {
    try {
      // Retrieve sales data from the KendaraanTransactionRepository
      $salesData = $this->kendaraanTransactionRepository->getSalesData();
      
      // Perform any necessary calculations or transformations on the sales data
      $totalSales = count($salesData);
      
      // Return the sales report
      return [
        'total_sales' => $totalSales,
        'sales_data' => $salesData,
      ];
    } catch (\Exception $exception) {
      // Handle the exception
      // You can log the error or perform any other necessary actions here
      throw new \Exception('Failed to generate sales report.', 500);
    }
  }
  
}



<?php

namespace App\Http\Controllers;

use App\Services\KendaraanTransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MongoDB\BSON\ObjectId;

class KendaraanTransactionController extends Controller
{
  private $kendaraanTransactionService;
  
  public function __construct(KendaraanTransactionService $kendaraanTransactionService)
  {
    $this->kendaraanTransactionService = $kendaraanTransactionService;
  }
  
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'kendaraan_id' => 'required|string',
        'nama_pembeli' => 'required|string|max:255',
        'alamat_pembeli' => 'required|string|max:255',
        'tanggal_transaksi' => 'required|date',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'failed',
            'message' => $validator->errors(),
        ], 422);
    }
    
    try {
      $data = $request->only([
        'kendaraan_id',
        'nama_pembeli',
        'alamat_pembeli',
        'tanggal_transaksi',
      ]);
  
      // Convert kendaraan_id to an instance of ObjectId
      $data['kendaraan_id'] = new ObjectId($data['kendaraan_id']);
      
      $kendaraanTransaction = $this->kendaraanTransactionService->create($data);
      
      return response()->json([
        'status' => 'success',
        'data' => $kendaraanTransaction,
      ]);
    } catch (\Exception $exception) {
      return response()->json([
        'status' => 'failed',
        'message' => $exception->getMessage(),
      ], $exception->getCode());
    }
  }
  
  public function getSalesReport(Request $request)
  {
    try {
      // Get the sales report from the KendaraanTransactionService
      $report = $this->kendaraanTransactionService->generateSalesReport();
      
      return response()->json([
        'status' => 'success',
        'data' => $report,
      ]);
    } catch (\Exception $exception) {
      return response()->json([
        'status' => 'failed',
        'message' => $exception->getMessage(),
      ], $exception->getCode());
    }
  }
  
}



<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Services\KendaraanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KendaraanController extends Controller
{
  private KendaraanService $kendaraanService;
  
  public function __construct(KendaraanService $kendaraanService)
  {
    $this->kendaraanService = $kendaraanService;
  }
  
  public function checkStock(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'warna' => 'required',
    ]);
  
    if ($validator->fails()) {
      return response()->json([
        'status' => 'failed',
        'message' => $validator->errors(),
      ], 422);
    }
    
    try{
    // Get the Kendaraan object by warna
    $kendaraan = Kendaraan::where('warna', $request->input('warna'))->first();
    
    if (!$kendaraan) {
      // The Kendaraan object doesn't exist
      return response()->json(['message' => 'Kendaraan not found'], 404);
    }
    
    // Check the stock of the Kendaraan object
    $stockInfo = $this->kendaraanService->checkStock($kendaraan);
    
    return response()->json($stockInfo);
    } catch (\Exception $exception) {
      return response()->json([
        'status' => 'failed',
        'message' => $exception->getMessage(),
      ], $exception->getCode());
    }
  }
}

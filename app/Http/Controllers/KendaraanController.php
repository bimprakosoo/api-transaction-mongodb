<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Services\KendaraanService;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
  private KendaraanService $kendaraanService;
  
  public function __construct(KendaraanService $kendaraanService)
  {
    $this->kendaraanService = $kendaraanService;
  }
  
  public function checkStock(Request $request)
  {
    // Validate the request data
    $this->validate($request, [
      'warna' => 'required',
    ]);
    
    // Get the Kendaraan object by warna
    $kendaraan = Kendaraan::where('warna', $request->input('warna'))->first();
    
    if (!$kendaraan) {
      // The Kendaraan object doesn't exist
      return response()->json(['message' => 'Kendaraan not found'], 404);
    }
    
    // Check the stock of the Kendaraan object
    $stockInfo = $this->kendaraanService->checkStock($kendaraan);
    
    return response()->json($stockInfo);
  }
}

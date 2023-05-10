<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\KendaraanTransactionController;
use App\Services\KendaraanTransactionService;
use App\Repositories\KendaraanTransactionRepository;
use Mockery;

class ReportTransactionTest extends TestCase
{
  
  protected function setUp(): void
  {
    parent::setUp();
    
    // Mock the dependencies
    $this->kendaraanTransactionService = Mockery::mock(KendaraanTransactionService::class);
    $this->kendaraanTransactionRepository = Mockery::mock(KendaraanTransactionRepository::class);
    
    // Create an instance of the controller with mocked dependencies
    $this->kendaraanTransactionController = new KendaraanTransactionController(
      $this->kendaraanTransactionService,
      $this->kendaraanTransactionRepository
    );
  }
  
  protected function tearDown(): void
  {
    parent::tearDown();
    
    // Release the mocked dependencies
    Mockery::close();
  }
  
  public function testGetSalesReport()
  {
    // Mock the sales report data
    $expectedSalesReport = [
      'total_sales' => 3,
      'sales_data' => [
        [
          "_id" => "645b193ee9459a4ad70c2bf4",
          "kendaraan_id" => "645a21c0662af676053545e0",
          "nama_pembeli" => "Bima Indra",
          "alamat_pembeli" => "Jakarta",
          "tanggal_transaksi" => "2023-05-10T00:00:00.000000Z",
          "updated_at" => "2023-05-10T04:10:38.969000Z",
          "created_at" => "2023-05-10T04:10:38.969000Z"
        ],
      ],
    ];
    
    // Mock the response from the service
    $this->kendaraanTransactionService->shouldReceive('generateSalesReport')
      ->andReturn($expectedSalesReport);
    
    // Create a new request instance
    $request = new Request();
    
    // Call the getSalesReport method
    $response = $this->kendaraanTransactionController->getSalesReport($request);
    
    // Assert the response status code
    $this->assertEquals(200, $response->getStatusCode());
    
    // Assert the response content
    $responseData = json_decode($response->getContent(), true);
    $this->assertEquals($expectedSalesReport['total_sales'], $responseData['data']['total_sales']);
    $this->assertEquals($expectedSalesReport['sales_data'], $responseData['data']['sales_data']);
  }
  
}

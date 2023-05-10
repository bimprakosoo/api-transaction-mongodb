<?php

namespace Tests\Unit;

use App\Http\Controllers\KendaraanTransactionController;
use App\Repositories\KendaraanTransactionRepository;
use App\Services\KendaraanTransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery;
use Tests\TestCase;


class KendaraanTransactionTest extends TestCase
{
  
  protected $kendaraanTransactionRepositoryMock;
  protected $kendaraanTransactionServiceMock;
  
  protected function setUp(): void
  {
    parent::setUp();
    
    // Create mocks for the repository and service
    $this->kendaraanTransactionRepositoryMock = Mockery::mock(KendaraanTransactionRepository::class);
    $this->kendaraanTransactionServiceMock = Mockery::mock(KendaraanTransactionService::class);
  }
  
  public function testInsertKendaraanTransaction()
  {
    // Prepare the request data
    $kendaraanTransactionData = [
      'kendaraan_id' => '645b550498541871988de8cf',
      'nama_pembeli' => 'Bima Indra',
      'alamat_pembeli' => 'Jakarta',
      'tanggal_transaksi' => '2023-05-10',
    ];
    
    // Create a request instance with the input data
    $request = new Request($kendaraanTransactionData);
    
    // Set up the validation rules
    $validationRules = [
      'kendaraan_id' => 'required|string',
      'nama_pembeli' => 'required|string|max:255',
      'alamat_pembeli' => 'required|string|max:255',
      'tanggal_transaksi' => 'required|date',
    ];
    
    // Mock the validation exception if validation fails
    Validator::shouldReceive('make')
      ->once()
      ->with($kendaraanTransactionData, $validationRules)
      ->andReturn(Mockery::mock([
        'fails' => true,
        'errors' => Mockery::mock(['all' => ['validation error']]),
      ]));
    
    // Create an instance of the controller and call the store method with the request
    $controller = new KendaraanTransactionController($this->kendaraanTransactionServiceMock);
    $response = $controller->store($request);
    
    // Assert the response status code
    $this->assertEquals(422, $response->getStatusCode());
    
    // Assert the response structure
    $responseData = $response->getContent();
    $responseArray = json_decode($responseData, true);
    $this->assertArrayHasKey('status', $responseArray);
    $this->assertArrayHasKey('message', $responseArray);
    
    // Assert the error message in the response
    $this->assertEquals('failed', $responseArray['status']);
  }
}


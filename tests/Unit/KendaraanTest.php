<?php

namespace Tests\Unit;

use App\Http\Controllers\KendaraanController;
use App\Repositories\KendaraanRepository;
use App\Services\KendaraanService;
use Mockery;
use Tests\TestCase;

class KendaraanTest extends TestCase
{
  
  protected function setUp(): void
  {
    parent::setUp();
    
    // Mock the dependencies
    $this->kendaraanService = Mockery::mock(KendaraanService::class);
    $this->kendaraanRepository = Mockery::mock(KendaraanRepository::class);
    
    // Create an instance of the controller with mocked dependencies
    $this->kendaraanController = new KendaraanController(
      $this->kendaraanService,
      $this->kendaraanRepository
    );
  }
  
  protected function tearDown(): void
  {
    parent::tearDown();
    
    // Release the mocked dependencies
    Mockery::close();
  }
  
  public function testCheckStock()
  {
    // Create a sample request with the required data
    $response = $this->post('/api/kendaraan/check-stock', ['warna' => 'Merah']);
    
    // Assert the response status code
    $this->assertEquals(200, $response->getStatusCode());

    // Assert the response content
    $response->assertJson([
      'in_stock' => true,
      'total_stock' => 2
    ]);
  }
  
}


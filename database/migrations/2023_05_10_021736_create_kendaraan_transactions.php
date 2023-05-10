<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraanTransactions extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::connection('mongodb')->create('kendaraan_transactions', function (Blueprint $collection) {
      $collection->index('kendaraan_id');
      $collection->string('nama_pembeli');
      $collection->string('alamat_pembeli');
      $collection->float('harga');
      $collection->date('tanggal_transaksi');
      $collection->timestamps();
    });
  }
  
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::connection('mongodb')->dropIfExists('kendaraan_transactions');
  }
}

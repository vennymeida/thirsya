<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->bigIncrements('id_cart');
            $table->unsignedBigInteger('barang_id')->unsigned();
            $table->unsignedBigInteger('pesanan_id')->unsigned();
            $table->integer('jumlah');
            $table->integer('jumlah_harga');
            $table->timestamps();
            $table->foreign('barang_id')->references('id')->on('barangs');
            $table->foreign('pesanan_id')->references('id_pesanans')->on('pesanans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan_details');
        $table->dropForeign(['barang_id']);
        $table->dropForeign(['pesanan_id']);
    }
}

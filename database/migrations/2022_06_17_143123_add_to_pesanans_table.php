<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToPesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->unsignedBigInteger('cart_id')->unsigned();
            $table->unsignedBigInteger('alamat_pengiriman_id')->unsigned()->nullable();
            $table->foreign('cart_id')->references('id_cart')->on('cart');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans', function (Blueprint $table) {
            $table->dropColumn('cart_id');
            $table->dropColumn('alamat_pengiriman_id');
            $table->dropForeign(['cart_id']);
        });
    }
}

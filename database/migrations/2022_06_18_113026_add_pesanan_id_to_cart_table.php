<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPesananIdToCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->unsignedBigInteger('pesanans_id')->unsigned()->nullable();
            $table->foreign('pesanans_id')->references('id_pesanans')->on('pesanans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->dropColumn('pesanans_id');
            $table->dropForeign(['pesanans_id']);
        });
    }
}

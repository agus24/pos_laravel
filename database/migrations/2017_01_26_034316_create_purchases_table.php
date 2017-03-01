<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_purchase')->unique();
            $table->date('tanggal');
            $table->integer('id_supplier')->index();
            $table->integer('grand_total');
            $table->integer('ware_id')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('purchase_detail',function(Blueprint $table){
            $table->string('no_purchase')->index();
            $table->integer('barang_id')->index();
            $table->integer('harga');
            $table->integer('qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase');
        Schema::dropIfExists('purchase_detail');
    }
}

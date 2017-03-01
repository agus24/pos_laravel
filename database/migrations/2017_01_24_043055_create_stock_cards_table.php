<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->integer('barang_id')->index();
            $table->integer('qty');
            $table->string('tipe');
            $table->integer('ware_id')->index();
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });
        \DB::statement("CREATE VIEW v_itemIn as select barang_id,sum(qty) as total,ware_id from stock_cards where tipe = 'In' group by barang_id,ware_id");
        \DB::statement("CREATE VIEW v_itemOut as select barang_id,sum(qty) as total,ware_id from stock_cards where tipe = 'Out' group by barang_id,ware_id");
        \DB::statement("CREATE VIEW v_stok as select a.*,ifnull(b.total,0) as jumlah_keluar,ifnull(c.total,0) as jumlah_masuk, ifnull(c.total,0) - ifnull(b.total,0) as stok from barangs a left join v_itemOut b on a.id = b.barang_id left join v_itemIn c on a.id = c.barang_id");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_cards');

        \DB::statement("DROP VIEW v_itemIn");
        \DB::statement("DROP VIEW v_itemOut");
        \DB::statement("DROP VIEW v_stok");
    }
}

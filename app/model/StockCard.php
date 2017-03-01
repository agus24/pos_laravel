<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockCard extends Model
{
	use SoftDeletes;


    protected $table = 'stock_cards';
    protected $primaryKey = 'id';
    protected $fillable = ['tanggal','barang_id','qty','tipe','description'];

    public function barang()
    {
    	return $this->join('barangs','stock_cards.barang_id','=','barangs.id')
    				->select('stock_cards.*','barangs.nama as barang_name');
    }

    public function stok()
    {
    	
    }
}
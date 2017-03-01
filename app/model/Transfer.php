<?php

namespace App\model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transfer extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'transfers';

    protected $fillable = [
    		"date",
			"barang_id",
			"qty",
			"ware_from",
			"ware_to"
    	];

    public function transferDo($ware_from, $ware_to, $id_barang, $qty)
    {
    	DB::table('stock_cards')->insert([
	    		[
	    			"tanggal" => Carbon::now(),
	    			"barang_id" => $id_barang,
	    			"qty" => $qty,
	    			"tipe" => "Out",
	    			"ware_id" => $ware_from,
	    			"description" => "transfer Tanggal ".Carbon::now()
	    		],
	    		[
	    			"tanggal" => Carbon::now(),
	    			"barang_id" => $id_barang,
	    			"qty" => $qty,
	    			"tipe" => "In",
	    			"ware_id" => $ware_to,
	    			"description" => "transfer Tanggal ".Carbon::now()
	    		]
    		]);
    }

    public function joinAll()
    {

    	return $this->join('barangs','transfers.barang_id','barangs.id')
    				->join('warehouses as a','a.id','transfers.ware_from')
    				->join('warehouses as b','b.id','transfers.ware_to')
    				->select('transfers.*','barangs.nama as nama_barang','a.name as from','b.name as to');

    }
}

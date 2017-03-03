<?php

namespace App\model;

use App\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Adjust extends Model
{
   	use SoftDeletes;

    protected $table = 'adjusts';
    protected $primaryKey = 'id';
    // protected $dates = ['deleted_at'];
    protected $fillable = [
		"no_adjust",
		"date",
		"barang_id",
		"qty_awal",
		"qty",
		"qty_akhir",
		"ware_id",
    ];

    /**
     * Static method Cari Barang
     * @param  $this $query
     * @return Eloquent
     */
    public function scopeFindBarang($query)
    {
    	$query->join('barangs','adjusts.barang_id','barangs.id')
    			->join('warehouses','adjusts.ware_id','warehouses.id')
    			->select('adjusts.*','barangs.nama as nama_barang','warehouses.name as nama_warehouse');
    }

    /**
     * Static Method bikin nomor adjust baru
     * @param  $this $query
     * @param  int $ware_id warehouse id
     * @return String          No Adjust
     */
    public function scopegetNewNoAdjust($query,$ware_id)
    {
      $helper     = new Helper;

      $last_no    = $query->orderby('id','desc')->select('no_adjust')->first();
      $group      = explode('/',$last_no->no_adjust);

      $group[1]   = $ware_id;
      $group[2]   = Carbon::now()->year;
      $group[3]   = $helper->romanic_number(Carbon::now()->month);
      $group[4]   = $helper->formatZeroNumber($group[4]+1,3);
      return implode('/',$group);
    }

    /**
     * Insert to Stock Card
     * @param  int $id  Id Barang
     * @param  int $qty jumlah Barang
     * @param  String $no  no Adjust
     */
    public function insertStock($id,$qty,$no)
    {
        DB::table('stock_cards')->insert([
            "tanggal" 	     => Carbon::now(),
    	    "barang_id"      => $id,
    	    "qty" 			 => $qty,
    	    "tipe"           => "In",
    	    "ware_id" 		 => Auth::user()->ware_id,
    	    "description" 	 => "Adjust No ".$no
        ]);
    }

    /**
     * Delete stock_card
     * @param  int $id  Barang Id
     * @param  int $qty Jumlah Barang
     * @param  String $no  No Adjustment
     */
    public function deleteStock($id,$qty,$no)
    {
    	DB::table('stock_cards')->insert([
    		"tanggal" 		=> Carbon::now(),
			"barang_id" 	=> $id,
			"qty" 			=> $qty,
			"tipe" 			=> "Out",
			"ware_id" 		=> Auth::user()->ware_id,
			"description" 	=> "Delete Adjust No ".$no
    	]);
    }
}

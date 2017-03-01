<?php

namespace App\model;

use App\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Purchase extends Model
{
	use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'purchase';
    protected $fillable = [
    	'no_purchase',
		'tanggal',
		'id_supplier',
		'grand_total',
		'ware_id'
    ];

    public function scopegetNewNoPurchase($query,$ware_id)
    {
      $helper     = new Helper;

      $last_no    = $query->orderby('id','desc')->select('no_purchase')->first();
      $group      = explode('/',$last_no->no_purchase);

      $group[1]   = $ware_id;
      $group[2]   = Carbon::now()->year;
      $group[3]   = $helper->romanic_number(Carbon::now()->month);
      $group[4]   = $helper->formatZeroNumber($group[4]+1,3);
      return implode('/',$group);
    }

    public function joinWarehouse()
    {
    	return $this->join('warehouses','warehouses.id','=','purchase.ware_id')->select('purchase.*','warehouses.name');
    }

    public function joinSupplier()
    {
    	return $this->join('suppliers','suppliers.id','=','purchase.id_supplier');
    }

   	public function detail($no_purchase)
   	{
   		return DB::table('purchase_detail')
                  ->join('barangs','barangs.id','=','purchase_detail.barang_id')
                  ->select('purchase_detail.*','barangs.nama as nama_barang')
                  ->where('purchase_detail.no_purchase',$no_purchase)
                  ->get();
   	}

    public function cariDetail($no_purchase)
    {
      return DB::table('purchase_detail')->where('no_purchase',$no_purchase)->get();
    }

   	public function insertDetail($array)
   	{
   		DB::table('purchase_detail')->insert($array);
   	}

   	public function updateDetail($array,$no_purchase)
   	{
   		DB::table('purchase_detail')->where('no_purchase','=',$no_purchase)->delete();
   		DB::table('purchase_detail')->insert($array);
   	}

    public function insertStock($array)
    {
      DB::table('stock_cards')->insert($array);
    }

    public function getItemDetail($no_purchase,$id_barang)
    {
      return DB::table('purchase_detail')
                  ->where("no_purchase",$no_purchase)
                  ->where("barang_id",$id_barang)
                  ->select('qty')
                  ->get();
    }

    public function deleteDetail($no_purchase)
    {
      DB::table('purchase_detail')
            ->where('no_purchase',$no_purchase)
            ->delete();
    }

}

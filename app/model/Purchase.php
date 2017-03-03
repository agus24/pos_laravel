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

    /**
     * Static Method getNewNoPurchase
     * @param  $this $query
     * @param  int $ware_id
     * @return string          no purchase
     */
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

    /**
     * Join the Purchase Table With Warehouse
     * @return Eloquent
     */
    public function joinWarehouse()
    {
        return $this->join('warehouses','warehouses.id','=','purchase.ware_id')->select('purchase.*','warehouses.name');
    }

    /**
     * join table purchase with Supplier
     * @return Eloquent
     */
    public function joinSupplier()
    {
        return $this->join('suppliers','suppliers.id','=','purchase.id_supplier');
    }

    /**
     * join purchase with table purchase_detail
     * @param  string $no_purchase
     * @return Collection
     */
    public function detail($no_purchase)
    {
        return DB::table('purchase_detail')
                  ->join('barangs','barangs.id','=','purchase_detail.barang_id')
                  ->select('purchase_detail.*','barangs.nama as nama_barang')
                  ->where('purchase_detail.no_purchase',$no_purchase)
                  ->get();
    }

    /**
     * Cari Detail Purchase
     * @param  String $no_purchase
     * @return Collection
     */
    public function cariDetail($no_purchase)
    {
      return DB::table('purchase_detail')->where('no_purchase',$no_purchase)->get();
    }

    /**
     * Insert Array to purchase_detail
     * @param  Array $array
     */
    public function insertDetail($array)
    {
        DB::table('purchase_detail')->insert($array);
    }

    /**
     * Update purchase_detail
     * @param  Array $array
     * @param  String $no_purchase
     */
    public function updateDetail($array,$no_purchase)
    {
        DB::table('purchase_detail')->where('no_purchase','=',$no_purchase)->delete();
        DB::table('purchase_detail')->insert($array);
    }

    /**
     * insert Stock Card
     * @param  Array $array
     */
    public function insertStock($array)
    {
        DB::table('stock_cards')->insert($array);
    }

    /**
     * get qty from detail
     * @param  String $no_purchase
     * @param  int $id_barang
     * @return Collection
     */
    public function getItemDetail($no_purchase,$id_barang)
    {
        return DB::table('purchase_detail')
                  ->where("no_purchase",$no_purchase)
                  ->where("barang_id",$id_barang)
                  ->select('qty')
                  ->get();
    }

    /**
     * Delete purchase_detail
     * @param  String $no_purchase No Purchase
     */
    public function deleteDetail($no_purchase)
    {
        DB::table('purchase_detail')
            ->where('no_purchase',$no_purchase)
            ->delete();
    }

}

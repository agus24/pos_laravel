<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
	use SoftDeletes;

    protected $table = 'barangs';
    protected $primaryKey = 'id';
    // protected $dates = ['deleted_at'];
    protected $fillable = [
	    "kode",
	    'nama',
	    'id_harga',
		'id_category',
		'id_subcategory',
        'harga'
    ];

    /**
     * Static Method join to harga, category, subcategory
     * @param  $this $query Eloquent
     * @return Eloquent
     */
    public function scopejoinAll($query)
    {
    	return $query->leftjoin('hargas','barangs.id_harga','hargas.id')
		    		->leftjoin('categories','barangs.id_category','categories.id')
		    		->leftjoin('sub_categories','barangs.id_subcategory','sub_categories.id')
		    		->select('barangs.*','categories.name as category_name','sub_categories.name as sub_category_name','hargas.harga');
    }

    /**
     * connect Relationship
     * @return StockCard Eloquent
     */
    public function stockCard(){
    	return $this->hasMany('App\model\StockCard','barang_id','id');
    }
}

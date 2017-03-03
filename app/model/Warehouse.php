<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Warehouse extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address'
    ];

    protected $table 		= "warehouses";
    protected $primaryKey 	= "id";

    /**
     * generate Combo
     * @return Eloquent
     */
	public function combo()
    {
    	$this->select('id as kiri','name as kanan');
    }
}

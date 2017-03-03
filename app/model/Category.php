<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
	use SoftDeletes;

    protected $table = "categories";
    protected $primaryKey = "id";
    protected $fillable = [
    	"name",
    ];

    /**
     * Static Method generate to Combo Array
     * @param  $this $query
     * @return Array
     */
    public function scopecombo($query)
    {
    	return $query->select('id as kiri','name as kanan')->get()->toArray();
    }
}

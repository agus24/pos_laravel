<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
	use SoftDeletes;
    
    protected $table = 'sub_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
    	"name"
    ];

	public function scopecombo($query)
    {
    	return $query->select('id as kiri','name as kanan')->get()->toArray();
    }
}

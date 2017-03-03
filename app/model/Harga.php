<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Harga extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'hargas';
    protected $fillable = [
    	'kode',
    	'harga'
    ];

    /**
     * static method generate to combo array
     * @param  $this $query Eloquent
     * @return Array
     */
	public function scopecombo($query)
    {
    	return $query->select('id as kiri','kode as kanan')->get()->toArray();
    }
}

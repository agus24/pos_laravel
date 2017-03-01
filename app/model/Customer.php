<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
	use SoftDeletes;
	
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $fillable = [
    	"name",
		"email",
		"address",
		"telp",
    ];
}

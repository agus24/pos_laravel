<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
	use SoftDeletes;

	protected $table = 'karyawans';
	protected $primaryKey = "id";
	protected $fillable = ['name','address','phone'];

}

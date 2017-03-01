<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    protected $table = 'v_menu';
    protected $primaryKey = 'id';

    public function scopecheckAccess($query,$id,$menu)
    {
    	$hsl = $query->where('user_id',$id)->where('link',$menu)->get();
    	return $hsl;
    }

    public function getMenuUser($user_id)
    {
    	$data = $this->where('user_id',$user_id)->get();
    	return $data;
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuList extends Model
{
    protected $table = 'v_menu';
    // protected $primaryKey = 'id';

    public function show($menu,$user_id)
    {

    	$item = $this->select('name','link','icon')
    				->where('parent',$menu)
    				->where('user_id',$user_id);
    	return $item->get();
    }
}
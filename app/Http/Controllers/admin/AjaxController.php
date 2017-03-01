<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\model\Barang;
use App\model\Category;
use App\model\Kartu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request,$tipe)
    {
    	switch($tipe){
    		case 'item' :
    			return response()->json($this->item($request));
    			break;
            case 'adjustBarang' :
                return response()->json($this->adjustBarang($request));
                break;
            case 'category' : 
                return response()->json($this->category($request));
                break;
            case 'allBarang' :
                return response()->json($this->allBarang($request));
                break;
            case 'allPaymentType' :
                return response()->json($this->allPaymentType($request));
                break;
    	}
    }

    private function item($request)
    {
    	if($request->ajax()){
    		$data = $request->input('data');
            $hsl = [];
    		$barang = new Barang;
    		$hasil = $barang
		    				->leftjoin('hargas','hargas.id','=','barangs.id_harga')
		    				->where('barangs.kode','like','%'.$data.'%')
		    				->orwhere('nama','like','%'.$data.'%')
		    				->select('barangs.*','hargas.harga as harga_beli')
		    				->get()
		    				->toArray();

    		foreach($hasil as $key => $value){
				$hsl[] = array(
								"label" => $value['kode']." ".$value['nama'],
								"value" => $value['id'],
								"harga" => $value['harga_beli']
							);
			}

    		return $hsl;
    	}
    	else{
    		abort('405');
    	}

    }

    private function adjustBarang($request)
    {

        if(!$request->ajax()){
            abort('405');
        }
        
        $id_barang = $request->input('id_barang');

        // $stok = DB::table('v_stok')->where('id',$id_barang)->get();

        $stok = DB::table('barangs')
                    ->leftjoin('v_itemOut', function($join) {
                        $join->on('barangs.id','v_itemOut.barang_id');
                        $join->on('v_itemOut.ware_id',DB::raw(Auth::user()->ware_id));
                    })
                    ->leftjoin('v_itemIn', function($join) {
                        $join->on('barangs.id','v_itemIn.barang_id');
                        $join->on('v_itemIn.ware_id',DB::raw(Auth::user()->ware_id));
                    })
                    ->select("barangs.*",DB::raw("ifnull(v_itemOut.total,0) as jumlah_keluar"),DB::raw("ifnull(v_itemIn.total,0) as jumlah_masuk"), DB::raw("ifnull(v_itemIn.total,0) - ifnull(v_itemOut.total,0) as stok"),"v_itemIn.ware_id")
                    ->orderby(DB::raw("ifnull(v_itemIn.total,0) - ifnull(v_itemOut.total,0)"),'desc')
                    ->where('id',$id_barang)
                    ->get();

        return $stok;

    }

    private function category($request)
    {
        if(!$request->ajax()){
            abort('405');
        }

        $category = new Category;
        return $category->get();
    }

    private function allBarang($request)
    {
        if(!$request->ajax()){
            abort('405');
        }

        $barang = new Barang;
        $hasil = $barang
                        ->leftjoin('hargas','hargas.id','=','barangs.id_harga')
                        ->select('barangs.*','hargas.harga as harga_beli')
                        ->get();
        return $hasil;
    }

    private function allPaymentType($request)
    {
        if(!$request->ajax()){
            abort('405');
        }

        $kartu = new Kartu;
        return $kartu->get();
    }
}

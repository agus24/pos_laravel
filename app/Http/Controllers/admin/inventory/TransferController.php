<?php

namespace App\Http\Controllers\admin\inventory;

use App\Http\Controllers\Controller;
use App\model\Transfer;
use App\model\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    private function valid($request)
    {
        $this->validate($request,[
                "qty" => "required|numeric",
                "warehouse_id" => "required|numeric",
                "barang_id" => "required|numeric"
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $stok = DB::table('barangs')
                    ->leftjoin('v_itemOut', function($join) {
                        $join->on('barangs.id','v_itemOut.barang_id');
                        $join->on('v_itemOut.ware_id',Auth::user()->ware_id);
                    })
                    ->leftjoin('v_itemIn', function($join) {
                        $join->on('barangs.id','v_itemIn.barang_id');
                        $join->on('v_itemIn.ware_id',Auth::user()->ware_id);
                    })
                    ->select("barangs.*",DB::raw("ifnull(v_itemOut.total,0) as jumlah_keluar"),DB::raw("ifnull(v_itemIn.total,0) as jumlah_masuk"), DB::raw("ifnull(v_itemIn.total,0) - ifnull(v_itemOut.total,0) as stok"),"v_itemIn.ware_id")
                    ->orderby(DB::raw("ifnull(v_itemIn.total,0) - ifnull(v_itemOut.total,0)"),'desc')
                    ->paginate(15);

        // dd($stok);

        $warehouse = Warehouse::where('id','<>',Auth::user()->warehouse()->get()[0]->id)->get();

        return view('inventory.transfer.index',['stok' => $stok,"warehouse" => $warehouse]);

    }

    /**
     * Get List Of Transfer
     * @return [type] [description]
     */
    public function listData()
    {
        $transfer = new Transfer;
        $transfer = $transfer->joinAll()->paginate(15);

        return view('inventory.transfer.list',compact('transfer'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->valid($request);

        $transfer = new Transfer;

        $transfer->date = Carbon::now();
        $transfer->barang_id = $request->input('barang_id');
        $transfer->qty = $request->input('qty');
        $transfer->ware_from = Auth::user()->ware_id;
        $transfer->ware_to = $request->input('warehouse_id');


        //transfer dari stock_card
        $transfer->transferDo(
                    Auth::user()->ware_id, 
                    $request->input('warehouse_id'), 
                    $request->input('barang_id'), 
                    $request->input('qty')
                );


        $transfer->save();

        return redirect('transfer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

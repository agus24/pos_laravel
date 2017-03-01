<?php

namespace App\Http\Controllers\admin\inventory;

use App\Http\Controllers\Controller;
use App\model\Barang;
use App\model\Purchase;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PurchaseController extends Controller
{
    private $no_purchase;

    public function __construct()
    {
        $this->middleware('auth');

        \JavaScript::put([
            'ItemList' => $this->getSomething()
        ]);
    }


    private function getSomething()
    {
        $barang = new Barang;
        $hsl = array();
        $hasil = $barang
                        ->join('hargas','hargas.id','=','barangs.id_harga')
                        ->select('barangs.*','hargas.harga as harga_beli')
                        ->get()
                        ->toArray();

        foreach($hasil as $key => $value){
            $hsl[] = array(
                            "label" => $value['kode']." ".$value['nama'],
                            "value" => $value['id'],
                            "harga" => $value['harga']
                        );
        }
        return $hsl;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase = new Purchase;
        $data = $purchase->joinWarehouse()->paginate(15);
        // return $data;
        // $data = $purchase->paginate(15);
        return view('inventory.purchase.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $no_purchase = Purchase::getNewNoPurchase(Auth::user()->ware_id);
        return view('inventory.purchase.add',["no_purchase" => $no_purchase]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'no_purchase'   => 'required|unique:purchase',
            'tanggal'       => 'required|date',
            'grand_total'   => 'required|numeric',
            'id_barang'     => 'required|array',
            'harga'         => 'required|array',
            'qty_barang'    => 'required|array',
        ]);

        $purchase = new Purchase;
        $purchase->no_purchase    = $request->input('no_purchase');
        $purchase->tanggal        = $request->input('tanggal');
        $purchase->grand_total    = $request->input('grand_total');
        $purchase->id_supplier    = 1;
        $purchase->ware_id        = 1;
        

        $id_barang      = $request->input('id_barang');
        $harga          = $request->input('harga');
        $qty_barang     = $request->input('qty_barang');
        $insert = array();
        $ins_stok = [];
        
        for($i=0 ; $i < count($id_barang) ; $i++){
            $insert[] = array(
                            "no_purchase"   => $request->input('no_purchase'),
                            "barang_id"     => $id_barang[$i],
                            "harga"         => $harga[$i],
                            "qty"           => $qty_barang[$i]
                        );
            $ins_stok = array(
                            "tanggal" => Carbon::now(),
                            "barang_id" => $id_barang[$i],
                            "qty" => $qty_barang[$i],
                            "tipe" => "In",
                            "ware_id" => 1,
                            "description" => "Purchase no ".$request->input('no_purchase')
                        );
        }

        $purchase->save();
        $purchase->insertDetail($insert);
        $purchase->insertStock($ins_stok);

        return redirect('purchase');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Purchase::find($id);
        $detail = $data->detail($data->no_purchase);
        // dd(["data" => $data,"detail"=>$detail]);
        return view('inventory.purchase.show',["data" => $data,"detail"=>$detail]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::findOrFail($id);
        $detail = $purchase->detail($purchase->no_purchase);

        $data = array("head" => $purchase,"det"=>$detail);
        return view('inventory.purchase.edit',["data"=>$data]);
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
        $this->validate($request,[
            'no_purchase'   => 'required',
            'tanggal'       => 'required|date',
            'grand_total'   => 'required|numeric',
            'id_barang'     => 'required|array',
            'harga'         => 'required|array',
            'qty_barang'    => 'required|array',
        ]);

        $purchase = Purchase::findOrFail($id);
        $purchase->no_purchase = $request->input('no_purchase');
        $purchase->tanggal = $request->input('tanggal');
        $purchase->grand_total = $request->input('grand_total');

        $id_barang      = $request->input('id_barang');
        $qty            = $request->input('qty_barang');
        $harga          = $request->input('harga');
        $no_purchase    = $request->input('no_purchase');

        $insDet = [];
        $ins_stok = [];


        for($i = 0 ; $i < count($id_barang) ; $i++){
            $qty_stok = 0;
            $qty_stok = $purchase->getItemDetail($no_purchase,$id_barang[$i]);
            $qty_stok = $qty_stok[0]->qty;
            $qty_stok = $qty[$i] - $qty_stok;

            $insert[] = array(
                "no_purchase"   => $no_purchase,
                "barang_id"     => $id_barang[$i],
                "harga"         => $harga[$i],
                "qty"           => $qty[$i]
            );

            $ins_stok[] = array(
                            "tanggal" => Carbon::now(),
                            "barang_id" => $id_barang[$i],
                            "qty" => $qty_stok,
                            "tipe" => "In",
                            "ware_id" => 1,
                            "description" => "Edit Purchase no ".$request->input('no_purchase')."oleh ".Auth::user()->name,

                        );
        }

        $purchase->updateDetail($insert,$no_purchase);
        $purchase->insertStock($ins_stok);
        $purchase->save();

        return redirect('purchase');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $no_purchase = $purchase->no_purchase;

        $detail = $purchase->cariDetail($no_purchase);
        $i = 0;
        foreach($detail as $key => $value){
            $barang = $value->barang_id;
            $qty = $value->qty;

            $ins_stok[] = array(
                            "tanggal" => Carbon::now(),
                            "barang_id" => $barang,
                            "qty" => $qty,
                            "tipe" => "Out",
                            "ware_id" => 1,
                            "description" => "Delete Purchase no ".$no_purchase." oleh ".Auth::user()->name,

                        );
        }

        $purchase->deleteDetail($no_purchase);
        $purchase->insertStock($ins_stok);
        $purchase->delete();

        return redirect('purchase');
    }
}

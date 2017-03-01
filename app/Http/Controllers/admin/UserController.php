<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserAccess;
use Session;
use Hash;
use Auth;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('master.user.index',['data' => User::paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required',
            'level_user' => 'required',
            'ware_id' => 'required',
            'phone' => 'numeric',
            'ware_id' => 'numeric',
            'level_user' => 'numeric'
        ]);

        $user = new User;
        $user->username     = $request->input('username');
        $user->password     = Hash::make($request->input('password'));
        $user->name         = $request->input('name');
        $user->email        = $request->input('email');
        $user->alamat       = $request->input('alamat');
        $user->phone        = $request->input('phone');
        $user->ware_id      = $request->input('ware_id');
        $user->level_user   = $request->input('level_user');
        $user->save();

        Session::flash('flash_message', 'User added!');

        return redirect('user');

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
        $user = User::findOrFail($id);
        return view('master.user.edit',compact('user'));
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
        $this->validate($request, [
            'username' => 'required',
            'name' => 'required',
            'email' => 'email'
        ]);

        $user = User::findOrFail($id);
        $user->username     = $request->input('username');
        $user->name         = $request->input('name');
        $user->email        = $request->input('email');
        $user->address      = $request->input('address');
        $user->phone        = $request->input('phone');
        $user->ware_id      = $request->input('ware_id');
        $user->level_user   = $request->input('level_user');

        $user->save();

        return redirect('user');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        Session::flash('flash_message', 'deleted!');

        return redirect('user');
    }

    public function changePermission($id)
    {
        $user = User::findOrFail($id);
        // $userAccess = new UserAccess;
        // $userAccess = $userAccess->getMenuUser($user->id);
        $userAccess = 
        \DB::table('menu_lists')
            ->leftjoin('user_accesses',function($q) use ($id){
                $q->on('menu_lists.id','=','user_accesses.menu_id')
                    ->on('user_accesses.user_id','=',"$id");
            })
            ->select('menu_lists.id','menu_lists.name','menu_lists.parent',\DB::raw('ifnull(user_accesses.menu_id,0) as menu_id'))
            ->get();

        // dd(['userAccess'=>$userAccess],["user"=>$user]);
        return view('master.user.permission',['userAccess' => $userAccess, "user"=>$user]);
    }

    public function updatePermission(Request $request,$id)
    {
        $this->validate($request,[
            "menu_id" => "array"
        ]);

        \DB::table('user_accesses')->where('user_id','=',$id)->delete();
        $data_ins = array();
        $menu_id = $request->input('menu_id');
        for($i = 0 ; $i < count($menu_id) ; $i++){
            $data_ins[] = array(
                                "menu_id" => $menu_id[$i],
                                "user_id" => $id,
                                "permission" => 1
                                );
        }
        \DB::table('user_accesses')->insert($data_ins);
        return redirect('user');
    }
}

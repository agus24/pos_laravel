<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Session;
use Hash;

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
}

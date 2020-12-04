<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;
use App\Userrole;
use HasRoles;
use Hash;
use File;

class ClientController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $users = User::where('userrole_id',2)->get();
        return view('client.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->file()){

            $imageName = time().'.'.$request->avatar->extension(); 
            $request->avatar->move(public_path('avatars'), $imageName);

        }else{
            $imageName = 'no-image';
        }

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->token = $request->input('password');
        $user->userrole_id = 2;
        $user->avatar = $imageName;
        $user->save();

        //$user->assignRole('client'); 

        return redirect()->route('clients.index')->with('success', 'New Client has been added');

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
        $user = User::find($id);
        return view('client.edit')->with('user', $user);

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
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::find($id);

        if($request->file()){

            if(file_exists(public_path('avatars/'. $user->avatar))) {
                File::delete(public_path('avatars/'. $user->avatar));
            }

            $imageName = time().'.'.$request->avatar->extension(); 
            $request->avatar->move(public_path('avatars'), $imageName);

        }else{
            $imageName = 'no-image';
        }

        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        if($request->file()){ $user->avatar = $imageName; }
        $user->save();

        return redirect()->route('clients.index')->with('success', 'Client has been update');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\Project;
use App\Share;
use Auth;

class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $shares = Share::with('client')->with('project')->get();
        return view('share.index')->with('shares', $shares);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $clients = User::where('userrole_id',2)->orderBy('id', 'desc')->get();
        $projects = Project::all();

        $data = array(
            'clients' => $clients, 
            'projects' => $projects, 
        );

        return view('share.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $get_project = Project::where('id', $request->input('project_id'))->first();
        $sharelink = url('/')."/shares"."/" .Str::slug($get_project->name) . '/' . rand('0000000', '9999999');

        $share = new Share;
        $share->share_type = $request->input('share_type');
        $share->share_by = Auth::user()->id;
        if($request->input('share_type') == 'album-selection'){
            $share->client_id = $request->input('client_id');
        }else{
            $share->client_id = 0;
        }
        $share->project_id = $request->input('project_id');
        $share->link = $sharelink;
        if($request->input('share_type') == 'album-selection'){
            $share->expire_date = $request->input('expire_date');
        }
        if($request->input('share_type') == 'album-selection'){
            $share->number_of_photo = $request->input('number_of_photo');
        }
        $share->save();

        return redirect()->route('shares.index')->with('success', 'Share link has been generated');


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

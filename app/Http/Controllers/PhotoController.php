<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Project;
use App\Folder;
use App\Photo;
use File;

class PhotoController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $project = Project::where('id', $_POST['project_id'])->first();
        $folder = Folder::where('id', $_POST['folder_id'])->first();

        $image = $request->file('file');
        $orignalName =  $image->getClientOriginalName();
        $imageName = time().'.'.$image->extension();

        $photo = new Photo;
        $photo->folder_id = $folder->id;
        $photo->serial_code = 'PH'.time();
        $photo->name = $orignalName;
        $photo->photo = $imageName;
        $photo->save();

        $image->move(public_path('uploads/'.Str::lower($project->name) .'/'. Str::lower($folder->name)),$imageName);
   
        return response()->json(['success'=>$imageName]);

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
        $photo = Photo::find($id);
        $folder = Folder::where('id', $photo->folder_id)->first();

        if(\File::exists(public_path('uploads/'.$folder->project->name.'/'.$folder->name.'/'.$photo->photo))){

            \File::delete(public_path('uploads/'.$folder->project->name.'/'.$folder->name.'/'.$photo->photo));
        
          }

        $photo->delete();

        return redirect()->route('folders.show', $folder->id);

    }
}

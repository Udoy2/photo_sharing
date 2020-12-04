<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Folder;
use App\Photo;
use File;

class FolderController extends Controller
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
    public function create_new_folder($id)
    {
        $project = Project::findOrFail($id);
        return view('folder.create')->with('project',$project);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $project = Project::findOrFail($request->input('project_id'));
        foreach ($_POST['group-b'] as $key => $item) {

            if(!empty($item['folder'])){

                $folder = new Folder;
                $folder->project_id = $request->input('project_id');
                $folder->name = $item['folder'];
                $folder->save();

            }
        }

        return redirect()->route('projects.show', $project->id);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $folder = Folder::where('id', $id)->with('photos')->first();
        return view('folder.show')->with('folder', $folder);
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
        $folder = Folder::findOrFail($id);
        $photos = $folder->photos;
        foreach($photos as $photo){
            if(\File::exists(public_path('uploads/'.$folder->project->name.'/'.$folder->name.'/'.$photo->photo))){

                \File::delete(public_path('uploads/'.$folder->project->name.'/'.$folder->name.'/'.$photo->photo));
            
              }
    
            $photo->delete();
        }
        if(\File::exists(public_path('uploads/'.$folder->project->name.'/'.$folder->name))){

            \File::delete(public_path('uploads/'.$folder->project->name.'/'.$folder->name));
        
          }

        $folder->delete();
        return back()->with('success','Folder Deleted Successfully!!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Project;
use App\Folder;
use App\Photo;
use File;


class ProjectController extends Controller
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
        $projects = Project::all();
        return view('project.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');
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
            'name' => 'required|unique:projects',
        ]);

        $project = new Project;
        $project->name = $request->input('name');
        $project->slug = Str::slug($project->name, '-');
        $project->save();

        foreach ($_POST['group-b'] as $key => $item) {

            if(!empty($item['folder'])){

                $folder = new Folder;
                $folder->project_id = $project->id;
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
        $project = Project::where('id', $id)->with('folders')->first();
        return view('project.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        return view('project.edit')->with('project', $project);
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
        $project = Project::findOrFail($id);
        $folders = $project->folders;
        foreach($folders as $folder){
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
        }

        $project->delete();
        return back()->with('success','Project Deleted Successfully!!');
    }
}

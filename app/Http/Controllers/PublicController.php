<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Share;
use App\User;
use App\Project;
use App\Photo;
use App\Review;
use Carbon\Carbon;

class PublicController extends Controller
{
    public function get_link_record($project, $ulid){

        $fetchurl = url("/shares/{$project}/{$ulid}");
        $share = Share::where('link', $fetchurl)->first();

        $current = Carbon::parse(date('Y-m-d H:i:s'));
        $future = Carbon::parse($share->expire_date);

        $expirein = $current->diffInDays($future);

        if($expirein == 0){
            $share->status = 0;
            $share->save();
        }


        if($share !== null){

            $client = User::where('id', $share->client_id)->first();
            $project = Project::where('id', $share->project_id)->with('folders')->first();

            $data = array(
                'share' => $share, 
                'client' => $client, 
                'project' => $project,  
                'expirein' => $expirein,  
               
            );

            return view('website.gallary')->with($data);
        }

    }

    public function login_as_client(Request $request){

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...

            return redirect()->route('share-link', ['project' => $request->input('project'), 'ulid' => $request->input('ulid')]);
        }else{
            return back()->withInput($request->only('email','name'))->with('errorCode' , 'couldnt find credentials in records');
        }

    }

    public function get_images(Request $request){

        echo 'test';

    }

    public function get_selected_link_record_and_review($project, $ulid){

        $fetchurl = url("/shares/{$project}/{$ulid}");
        $share = Share::where('link', $fetchurl)->first();

        if($share !== null){

            $client = User::where('id', $share->client_id)->first();
            // $project = Project::where('id', $share->project_id)->with('folders')->first();

            $data = array(
                'share' => $share, 
                'client' => $client, 
            );

        return view('website.review-and-submit')->with($data);

        }

    }

    public function get_selected_images(Request $request){
        
        $photos = Photo::whereIn('serial_code', $_POST['photos'])->with('folder')->get();
        return response()->json($photos);

    }

    public function save_review_photos(Request $request){
        $client = User::findOrFail($request->client_id);
        if($client->userrole_id =! 1){
            $review = new Review;
            $review->client_id = $request->client_id;
            $review->review = $request->review;
            $review->photos = json_encode($request->photos);
            $review->save();
    
            $share = Share::where('client_id', $request->client_id)->first();
            $share->reviewed = 1;
            $share->status = 0;
            $share->save();
    
            $data = array('success' => 'true', );
        }else{
            $data = ['error' => 'true'];
        }


        return json_encode($data);

    }

}

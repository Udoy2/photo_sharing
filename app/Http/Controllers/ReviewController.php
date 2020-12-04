<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Response;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reivews = Review::with('client')->get();
        return view('review.index')->with('reviews', $reivews);
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
        //
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

    public function export_csv($id){

        $review = Review::where('id', $id)->with('client')->first();

        $photos = json_decode($review->photos);
        $data = '';

        foreach($photos as $photo){
            $data .= $photo .',';
        }

        $list = array( 
            ['Client', 'Photos'], 
            [$review->client->name, $data], 
        ); 


        $fp = fopen('public/csv/photos'.'-'.$review->client->name.'-'.$review->id.'.csv', 'w'); 
        foreach ($list as $fields) { 
            fputcsv($fp, $fields); 
        } 

        fclose($fp); 

        $file = 'public/csv/photos'.'-'.$review->client->name.'-'.$review->id.'.csv';

        return Response::download($file);
    }

}

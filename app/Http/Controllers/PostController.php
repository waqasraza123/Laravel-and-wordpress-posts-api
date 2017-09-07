<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
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
        $tags = DB::table('tagging_tags')->pluck('name', 'name');
        return view('create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate ($request, array(
        
            'name'=>'required|max:255',
            'image'=>'required',
            'content'=>'required',
            'category'=>'required',
            'tags'=>'required',
            'status'=>'required',
            'publish_date'=>'required'
            ));
            
            
            $post = new Post;
        
            $post->name = $request['name'];
            $post->image = $request['image'];   
            $post->content = $request['content'];
            $post->category = $request['category'];
            $post->tags = $request['tags'];
            $post->status = $request['status'];
            $post->publish_date = $request['publish_date'];
            $post -> save();
        

            // Now add tags
            $post->tag($request->input('tags'));
        
            return view ('success');
            
        
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

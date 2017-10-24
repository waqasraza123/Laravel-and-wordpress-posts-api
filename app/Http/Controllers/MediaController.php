<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use Illuminate\Support\Facades\Storage;

use App\Logic\Image\ImageRepository;
use Illuminate\Support\Facades\Input;


class MediaController extends Controller
{




    public function index()
    {
        //
    }


    public function create()
    {
        return view('upload');
    }


    public function store(Request $request)
    {

        foreach($request->file as $file){

                $immFile = $file;
                $immName = $immFile->getClientOriginalName();
                $immSize = $immFile->getClientSize();

                Storage::disk('public')->put($immName, file_get_contents($immFile));

                $url = Storage::disk('public')->url($immName);

                Media::create([
                    'file_name' => $url,
                    'file_size' => $immSize
                ]);

        }

        return back()->with('status', 'Image Upload Successful');
    }


    public function dropzoneStore(Request $request)

    {

        $image = $request->file('file');

        $imageName = time().$image->getClientOriginalName();

        $image->move(public_path('images'),$imageName);

        return response()->json(['success'=>$imageName]);

    }



    public function postUpload()
    {
        $photo = Input::all();
        $response = $this->image->upload($photo);
        return $response;

    }

    public function deleteUpload()
    {

        $filename = Input::get('id');

        if(!$filename)
        {
            return 0;
        }

        $response = $this->image->delete( $filename );

        return $response;
    }




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

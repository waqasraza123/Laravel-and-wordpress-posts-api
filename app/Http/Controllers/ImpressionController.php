<?php

namespace App\Http\Controllers;

use App\Impression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use SammyK\LaravelFacebookSdk\Test\FacebookableTraitTest;

class ImpressionController extends Controller
{



    public function impression(){

        $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');

        $token = 'EAAPwkGzd5uwBADu5LArXq1bMKH33WfQtZB3IJZAyD3BzWaxMFBKG4mHqvLMolVZA6Wq3ndoY0FbP62I5ZAvP0IpYSF9yZADVtUrqPCDQmOZCHxEDoTQzZApo8ZCJC6SZBYQHZA6HmDecA9WrWdZBzIZCB0NSyYZAwihJ00ZBZBPaGDO4GgI8QZDZD';



        try {
            $response = $fb->get('1011430805543124/insights/page_impressions', $token);
        }
        catch(\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
        }


        $graphEdge = $response->getGraphEdge();

//        return $graphEdge;

//        dd($graphObject);
        // A method called createOrUpdateGraphNode() on the `Event` eloquent model
        // will create the event if it does not exist or it will update the existing
        // record based on the ID from Facebook.



        $event = Impression::createOrUpdateGraphNode($graphEdge);
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
}

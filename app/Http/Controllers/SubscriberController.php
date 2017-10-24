<?php

namespace App\Http\Controllers;

use App\Subscriber;
use App\Topic;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{

    public function index()
    {
        $topics = Topic::all();
        return view('subscribe', compact('topics'));
    }

    public function doug()
    {
        $topics = Topic::all();
        return view('subscribe', compact('topics'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $subscriber = Subscriber::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email']

        ]);

        $subscriber->topics()->attach($request['topics']);


        return back();

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}

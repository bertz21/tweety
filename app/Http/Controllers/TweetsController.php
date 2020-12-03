<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// this need to be typed in manually
use App\Models\Tweet;

class TweetsController extends Controller
{
    //
    public function store()
    {
        $attributes = request()->validate(['body' => 'required|max:255']);

        Tweet::create([
            'user_id' => auth()->id(),
            'body' => $attributes['body'] // the valid attirbuetes will be returned as an array from the request validation function
        ]);

        
        //return redirect('/tweets');
        // or you can do something like this below, this will be pulled form the name('home') on the route 
        return redirect()->route('home');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tweets = Tweet::latest()->get();

        return view('tweets.index', [
            'tweets' => auth()->user()->timeline()
        ]);
    }
}

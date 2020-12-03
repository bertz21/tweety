<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//manually typed 
Use App\Models\Tweet;

class TweetLikesController extends Controller
{
    //
    public function store(Tweet $tweet)
    {
        $tweet->like(current_user());

        return back();
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->dislike(current_user());

        return back();
    }

}
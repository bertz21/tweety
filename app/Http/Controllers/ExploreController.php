<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// manually added
use App\Models\User;

class ExploreController extends Controller
{
    //
    public function __invoke()
    {
        return view('explore', [
            'users' => User::paginate(50),
        ]);
    }
}

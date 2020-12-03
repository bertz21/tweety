<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// need to be manually pulled

use App\Models\User;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    //
    public function show(User $user)
    {
        return view('profiles.show', [
            'user' => $user,
            'tweets' => $user->tweets()->withLikes()->paginate(10),
        ]);

        // to relase the pagination view, you need to run command
        // php artisan vendor:publish 
        // it will ask for the whic vendor to publish and select laravel-pagination
        // input the number on the console
    }

    public function edit(User $user)
    {
        // one way to habdle this
        // 403 erorr is for unauthroized
        //abort_if($user->isNot(current_user()), '403');


        // another way to handle authentication
        //$this->authorize('edit', $user);
        // if you also handle authenticate using the middleware on the route, then the code above is no useful or it will return 403


        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {

        $attributes = request()->validate([
            // the rules is the username must be unqiue to the users table
            // and ignore the current user, otherwise it is always fail because the rules, the current username has exists in the users table data
            'username' => ['string', 'required', 'max:255', 'alpha_dash', Rule::unique('users')->ignore($user),],
            'avatar' => ['file'],
            'name' => ['string', 'required', 'max:255', Rule::unique('users')->ignore($user),],                                                                                 
            'email' => ['string', 'required', 'email', 'max:255'],
            'password' => ['string', 'required', 'min:8', 'max:255', 'confirmed'], // the confirmed is laravel will look for the password_confirmation to confirm

        ]);

        // the store method will be pulled from the Laravel file helpers and will return where the file path is
        // it will store the image in storage/app/public folder if you specify FILESYSTEM_DRIVER=public in .env file
        // it will store the image in the storage/app/public/avatars/theimage
        // but we also need to create the symbolic link, so it iwll store in the resources/public
        // by running this command php artisan storage:link
        
        // we only stored the avatar when it is presents or we have the avatar  
        if(request('avatar')) {
            $attributes['avatar'] = request('avatar')->store('avatars');
        }
        

        $user->update($attributes);

        


        return redirect($user->path());
    }

}

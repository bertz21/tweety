<?php

namespace App;

// manually added
use App\Models\User;


// this is a trait,
// A “Trait” is similar to an abstract class, in that it cannot be instantiated on its own but contains methods that can be used in a concrete class.
// Traits are a mechanism for code reuse in single inheritance

trait Followable
{

    // this method save who we are going to follow
    // to create new relationship
    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }

    public function unfollow(User $user)
    {
        return $this->follows()->detach($user);
    }

    public function toggleFollow(User $user)
    {
        // follow or unfollow the given user or have the authenticate user to follow the given user
        // from the parameter

        //if($this->following($user)) {
        //    return $this->unfollow($user);
        //}

        //return $this->follow($user);

        // we can clean our code above to be like this
        $this->follows()->toggle($user);


        
    }


    // need to create the migration and the table
    // relation ship for checking who is the user following
    public function follows()
    {
        // 'follows' is need to be explicit(stated clearly) about the table
        // 'user_id' stated clearly(explicit) the foreign pivot key
        // 'following_user_id' explicit(stated clearly) the related pivot key
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    } 


    // to check if the current user have follows
    public function following(User $user)
    {

        // you can also use someting like $this->follows->contains($user);
        // but notice there is no "()" after follows, that is mean we catch all the data from the entire collection, imagine if the collections is big like 3000 records
        // we should using the follows() , because we pulling the data from the database query and not filtering the data from that big collections

        return $this->follows()->where('following_user_id', $user->id)->exists();

    }


}

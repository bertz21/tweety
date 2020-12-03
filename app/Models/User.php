<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


use App\Models\Tweet;
use App\Followable;

class User extends Authenticatable
{
    // the Followable is a trait and manually added or typed
    use HasFactory, Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'avatar',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarAttribute($value)
    {
        if(empty($value)) {
            return '/images/default_avatar.jpeg';
        }else{
            // the assets will return the full path of the 
            return asset('storage/'. $value);
        }
    }

    // set custom mutator for hashing password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    public function timeline()
    {
        // include all of the user's tweets
        // as well as the tweets of everyone they follow in descending order by date.

        $friends = $this->follows()->pluck('id'); // get the collection of the user that the current user follows

        // give me all the tweets where the user id is in this array
        // or where the current user id
        // sort them in descending order and give me the results
        return Tweet::whereIn('user_id', $friends)->orWhere('user_id', $this->id)->withLikes()->latest()->paginate(50);

    }

    // to get or show only the current user tweets and the latest
    public function tweets()
    {
        return $this->hasMany(Tweet::class)->latest();
    }

    
    // by default laravel try to look for the id of the user instead of the name
    // we use this method to overwrite a method based on the attribute or key of the database
    // like example is the name of the user instead of the id of the user
    public function getRouteKeyName()
    {
        return 'name';
    }


    // other method we can use other than getRouteKeyname is to create the profile path
    public function path($append = '')
    {
        $path = route('profile', $this->username);

        return $append ? "{$path}/{$append}" : $path;
    }

    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }


}

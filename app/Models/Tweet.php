<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use likeable
use App\Likable;


class Tweet extends Model
{
    use HasFactory;

    // use trait, manually typed
    use Likable;

    // fixing the mass assignment issues
    // this for protection
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }


}

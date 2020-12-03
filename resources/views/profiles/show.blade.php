@extends('layouts.app')


@section('content')
    
    <header class="mb-6 relative">
        <div class="relative">
            <img src="/images/default-profile-banner.jpg" alt="default profile" class="mb-2 w-full rounded-lg">
            <img src="{{ $user->avatar }}" alt="" class="rounded-full mr-2 absolute transform -translate-x-1/2 translate-y-1/2 bottom-0"  width="150" style="left: 50%;">
        </div>
    
        <div class="flex justify-between items-center mb-4">
            <div style="max-width: 270px;">
                <h2 class="font-bold text-2xl mb-0">{{ $user->name }}</h2>
                <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
            </div>

            <div class="flex">
                @can('edit', $user)
                    <!-- current_user()->is($user),  the current user is pulled from the app\helpers.php --> 

                    <!-- the can is using the Laravel policy -->
                    <!-- the polices benefit is, what heppened if someone like admin or assistant of the admin edit the profile -->
                    <!-- this wont be achievable by using current user function or it would be complex instead of that we are using function  -->

                    <a href="{{ $user->path('edit') }}" class="rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2">Edit Profile</a>
                @endcan

                <!-- the :user="$user" is for passing through the param in this case is the user object -->
                <x-follow-button :user="$user"></x-follow-button>
               
            </div>
        </div>

        <p class="text-sm">
            I'm baby godard prism VHS DIY chillwave, woke twee hexagon trust fund microdosing lumbersexual intelligentsia tattooed.
            Man bun viral hell of semiotics vice, echo park tote bag. Lyft venmo pour-over, blog pabst XOXO bespoke.
        </p>


        


       

    </header>

    @include('_timeline', [
        'tweets' => $tweets
    ])

@endsection
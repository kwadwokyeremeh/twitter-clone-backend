<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    /**
     * Display a listing of the user followers tweets.
     */
    public function index(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $followers = auth()->user()->follows->pluck('id');
        return Tweet::with('user:id,name,username,avatar')
            ->whereIn('user_id',$followers)->latest()->paginate(10);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user)
    {
        auth()->user()->follow($user);
        return response()->json('Followed',201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
    
        return response()->json(auth()->user()->isFollowing($user),200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        auth()->user()->unfollow($user);
        return response()->json('UnFollowed',201);
    }
}

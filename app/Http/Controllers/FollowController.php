<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Tweet;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Follow $follow)
    {
        //
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
    public function destroy(Follow $follow)
    {
        //
    }
}

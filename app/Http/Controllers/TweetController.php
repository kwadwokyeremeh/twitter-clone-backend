<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTweetRequest;
use App\Http\Requests\UpdateTweetRequest;
use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Auth\User as Auth;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Tweet::with('user:id,name,username,avatar')->latest()->paginate(10);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTweetRequest $request)
    {
        $user = User::where('id',35)->first();
        auth()->login($user);

        auth()->user()->tweets()->create([
            'body' => $request->body,
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Tweet $tweet)
    {
        return $tweet->load('user:id,name,username,avatar');
        //return Tweet::with('user:id,name,username,avatar')->where('id', $tweet->id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tweet $tweet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTweetRequest $request, Tweet $tweet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tweet $tweet)
    {
        //
    }
}

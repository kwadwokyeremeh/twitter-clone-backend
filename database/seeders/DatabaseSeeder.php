<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::factory(120)->has(Tweet::factory(50))->create();
        foreach (range(1,120) as $user){
            User::find($user)->follows()->attach($user);
        }
        foreach ( range(1,40) as $user_id){
            foreach (range(41,80) as $user_id2){
                User::find($user_id)->follows()->attach(User::find($user_id2));
            }
        }
        foreach ( range(41,80) as $user_id){
            foreach (range(81,120) as $user_id2){
                User::find($user_id)->follows()->attach(User::find($user_id2));
            }
        }
        foreach ( range(81,120) as $user_id){
            foreach (range(1,40) as $user_id2){
                User::find($user_id)->follows()->attach(User::find($user_id2));
            }
        }
    }
}

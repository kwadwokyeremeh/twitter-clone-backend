<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array<string, string> $input
     * @throws ValidationException
     */
    public function create(array $input):User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'userName' => ['required', 'string', 'min:4','max:255',Rule::unique(User::class)],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();


        return User::create([
            'name' => $input['name'],
            'username' => $input['userName'],
            'email' => $input['email'],
            'avatar' => 'https://reactnative.dev/img/tiny_logo.png',
            'password' => Hash::make($input['password']),
        ]);

    }
}

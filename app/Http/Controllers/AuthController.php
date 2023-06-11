<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {

        $credentials = (array) $request->validated();

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'invalid credentials!',
            ]);
        }

        $user = User::where('email', $credentials['email'])->firstOrFail();

        return response()->json(UserResource::make($user));

    }


    public function register(RegisterRequest $request)
    {

        $validated = (array) $request->validated();

        $user = User::create($validated);

        return response()->json(UserResource::make($user));

    }

}

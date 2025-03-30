<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\AuthCollection;
use App\Mail\RegisteredUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\VerifyEmailQueued;
class AuthController extends Controller
{
    public function users()
    {
      return new AuthCollection(User::all());
    }

    public function userRoleUpdate(Request $request, string $id)
    {
        $user = User::find($id);
        if($user) {
          $user->role = $request->input('role');
          $user->save();
          return response()->json(['user'=>new AuthResource($user), 'message'=>'User role updated successfully'], 200);
        }
        else {
          return response()->json(['message'=>'User not found'], 404);
        }
    }

    public function user(Request $request)
    {
        $user = Cache::remember('user' . $request->user()->id, 60000, function () use ($request) {
            return $request->user();
        });
        if(!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return new AuthResource($user);

    }

    public function register(AuthRequest $request)
    {
        $fields = $request->validated();

        $user = User::create([
            'Username' => $fields['Username'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
            'FullName' => $fields['FullName'],
            'PhoneNumber' => $fields['PhoneNumber'],
        ]);

        event(new Registered($user));
        $token = $user->createToken('auth_token')->plainTextToken;
        Mail::to($user->email)->send(new RegisteredUser($user));

        return response()->json([
            'user' => new AuthResource($user),
            'token' => $token,
            'success' => true,
            'message' => 'Regisztráció sikeres! Kérjük, ellenőrizze az e-mail fiókját a megerősítő linkért.'
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $fields = $request->validated();
        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json(['message' => 'Rossz email vagy jelszó'], 403);
        }

        if(!$user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email nincs megerősítve'], 403);
        }

        Cache::put('user' . $user->id, $user, 6000000);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => new AuthResource($user),
            'token' => $token
        ],200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        Cache::forget('user' . $request->user()->id);

        return response()->json([
            'message' => 'You have been logged out successfully'
        ], 200);
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        $fields = $request->validated();
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->Username = $fields['username'];
        $user->email = $fields['email'];
        $user->PhoneNumber = $fields['PhoneNumber'];
        $user->save();

        Cache::forget('user' . $id);
        Cache::put('user' . $id, $user, 60000);

        return new AuthResource($user);
    }
}

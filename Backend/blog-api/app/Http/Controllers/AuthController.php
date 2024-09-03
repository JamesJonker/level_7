<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getall()
    {
        $users = User::all();

        // return response('users', $users);
        return response()->json($users, 201);

    }

    public function register(Request $request)
    {


        return $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
       
        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|string|email',
        //     'password' => 'required|string',
        // ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = $request->user();
        $token = $user->createToken('auth-token')->plainTextToken;

        
        return response()->json(['token' => $token, 'user' => $user], 200);
    }

    public function user(Request $request)
    {
        // Return the authenticated user's details
        return response()->json(["user"=>$request->user()]);
        // return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        
        $request->user()->currentAccessToken()->delete();

        return response()->json(null, 204);
    }

    public function getusers(Request $request){
        return $user = $request->user();
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users',
      'password' => 'required|string|min:6',
    ]);
    
    if ($validator->fails()) {
      return response()->json([
        'status' => 'failed',
        'message' => $validator->errors(),
      ], 422);
    }
    
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
    ]);
    
    return response()->json([
      'status' => 'success',
      'data' => $user,
    ]);
  }
  
  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');
    
    if (!$token = JWTAuth::attempt($credentials)) {
      return response()->json([
        'status' => 'failed',
        'message' => 'Invalid email or password',
      ], 401);
    }
    
    return response()->json([
      'status' => 'success',
      'token' => $token,
    ]);
  }
}

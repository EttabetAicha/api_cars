<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\ValidationException; // Add this import

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            // Return validation error response with status code 422
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
              /** @var \App\Models\User $user **/
            if (!$user->hasRole('admin')) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $token = $user->createToken('Personal Access Token')->accessToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}

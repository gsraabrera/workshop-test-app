<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ProcessUserAuthLog;

class AuthController extends Controller
{
    // Login
    public function login(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Dispatch the job to process user authentication log
        ProcessUserAuthLog::dispatch()->onQueue('auth-logs');

        // Check user credentials
        $user = User::where('email', $request->email)->first();
        
        // Invalid credentials
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Create token
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    // Get current logged-in user
    public function user(Request $request)
    {
        return Auth::user();
        return $request->user();
    }

    public function register(Request $request)
    {
        $input = $request->all();

        $validated = Validator::make($input, [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => ['required', 'string', Password::default(), 'confirmed'],
        ])->validate();
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'middle_name'=> $validated['middle_name'] ?? null,
            'email'      => $validated['email'],
            'password'   => Hash::make($validated['password']),
        ]);
        $token = $user->createToken('api')->plainTextToken;

        // Return API JSON response
        return response()->json([
            'success' => true,
            'message' => 'Registration successful.',
            'data'    => $user,
            'token'   => $token, // optional
        ], 201);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}

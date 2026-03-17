<?php

namespace App\Http\Controllers\Auth;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ClientAuthController extends Controller
{
    // ----------------------------
    // Register
    // ----------------------------
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients,email',
            'phone' => 'nullable|string|max:20',
        ]);

        $client = Client::create($data);

        Auth::guard('client')->login($client);

        return response()->json([
            'message' => 'Registered successfully',
            'client'  => $client
        ]);
    }

    // ----------------------------
    // Login
    // ----------------------------
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
        ]);

        $client = Client::where('email', $request->email)->first();

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        Auth::guard('client')->login($client);

        return response()->json([
            'message' => 'Login successful',
            'client' => $client
        ]);
    }

    // ----------------------------
    // Logout
    // ----------------------------
    public function logout()
    {
        Auth::guard('client')->logout();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    // ----------------------------
    // Google Login
    // ----------------------------
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $client = Client::where('google_id', $googleUser->id)
            ->orWhere('email', $googleUser->email)
            ->first();

        if (!$client) {
            $client = Client::create([
                'name'      => $googleUser->name,
                'email'     => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar'    => $googleUser->avatar,
                'active'    => true,
            ]);
        }

        Auth::guard('client')->login($client);

        return redirect('/'); // frontend home
    }
}

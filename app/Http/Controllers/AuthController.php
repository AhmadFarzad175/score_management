<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        return view('authentications.login');
    }
    public function register(Request $request)
    {
        // Validation passed, proceed with login logic
        $credentials = $request->validate([
            'name' => 'required|string|max:10|unique:users,name',
            'password' => 'required|min:3|max:10',
        ]);

        $user = User::create($credentials);
        Auth()->login($user);

        return redirect()->route('classes.index');


        // Authentication failed...
        return back()->withErrors(['message' => 'Invalid credentials']);
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|min:3|max:64',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('classes.index');
        } else {
            return back()->withErrors(['message' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        Auth()->logout();

        return redirect('/login');
    }
}

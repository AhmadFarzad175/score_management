<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function registerPage()
    {
        return view('authentications.register');
    }


    public function register(Request $request)
    {
        // Validate the request data
        $credentials = $request->validate([
            'name' => 'required|string|max:10|unique:users,name',
            'password' => 'required|string|min:3|max:10',
        ]);

        // Hash the password before saving it to the database
        $credentials['password'] = Hash::make($credentials['password']);

        // Create the user
        $user = User::create($credentials);

        // Log the user in
        Auth::login($user);

        // Redirect to the classes index page
        return redirect()->route('classes.index');
    }





    public function loginPage()
    {
        return view('authentications.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|min:3|max:64',
        ]);

        $credentials = $request->only('name', 'password');
        

        

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('classes.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth()->logout();

        return redirect('/login');
    }
}

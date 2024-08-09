<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
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
            'password' => 'required|string|min:3|confirmed',
        ]);

        // Hash the password before saving it to the database
        $credentials['password'] = Hash::make($credentials['password']);

        // Create the user
        $user = User::create($credentials);


        // Redirect to the classes index page
        return redirect()->route('classes.index')->with('success', 'Registration successful.');
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
        

        

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            session(['locale' => 'en']);
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

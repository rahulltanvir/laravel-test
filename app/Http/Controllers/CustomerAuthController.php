<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function loginForm()
    {
        return view('website.customer.login');
    }

    public function registerForm()
    {
        return view('website.customer.registration');
    }

    public function register(Request $request)
    {
        $request->validate([
    'name'     => 'required',
    'phone'    => 'required|unique:customers,phone',
    'email'    => 'required|email|unique:customers,email',
    'password' => 'required|min:6',
]);

Customer::create([
    'name'     => $request->name,
    'phone'    => $request->phone,
    'email'    => $request->email,
    'password' => Hash::make($request->password),
]);

        return redirect()->route('customer.login')->with('success', 'Registration successful');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect('/')->with('success', 'Login successful');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/');
    }
}
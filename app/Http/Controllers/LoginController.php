<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Company;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function register()
    {
        $companies = Company::all();
        return view('login.register', compact('companies'));
    }

    public function singup()
    {
        $this->validate(request(),[
            'email' => 'required',
            'name' => 'required',
            'password' => 'required|confirmed',
            'telephone' => 'required',
            'company' => 'required'
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('passwd')),
            'telephone' => request('telephone'),
            'company_id' => request('company')
        ]);
        auth()->login($user);

        return redirect()->home();
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->home();
    }

    public function loginPage()
    {
        return view('login.login');
    }

    public function login()
    {
        $credentials = request()->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('/');
        }
        return redirect('/login')->withErrors([
            'auth.failed'
        ]);;
    }
}

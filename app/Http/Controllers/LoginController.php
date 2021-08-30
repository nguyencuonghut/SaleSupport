<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.loginform');
    }

    public function login(Request $request)
    {
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required' // password can only be alphanumeric and has to be greater than 3 characters
        );
        $validator = Validator::make($request->all(), $rules);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();
            if (auth()->user()->type == 'Admin') {
                return redirect()->route('admin.policies');
            }else{
                return redirect()->intended('/');
            }
        }

        return back()->withErrors([
            'email' => 'Email hoặc password không đúng!',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

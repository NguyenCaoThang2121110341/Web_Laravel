<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view("frontend.login");
    }
    public function doLogin(Request $request)
    {
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $credentials = [
                'email' => $request->username,
                'password' => $request->password,
                'status' => 1
            ];
        } else {
            $credentials = [
                'username' => $request->username,
                'password' => $request->password,
            ];
        }
        //login 
        if (Auth::attempt($credentials)) {
            return redirect()->route('site.home'); 
        } else {
            return redirect()->route('website.getlogin')->with("message", "Login fails");
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('site.home');
    }
}

<?php

namespace SenventhCode\ConsoleService\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SenventhCode\ConsoleService\App\Http\Requests\Login;

class LoginController extends MainController
{

    public function index(Request $request)
    {
        return view('console-service::login.index');
    }

    public function authenticate(Login $request)
    {
        if (Auth::guard('console-service')->attempt($request->only(['email', 'password']), true) === false) {
            return redirect()->route('login.index');
        }

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::guard('console-service')->logout();

        return redirect()->route('login.index');
    }

    public function starter()
    {
        return view("console-service::login.starter");
    }
}

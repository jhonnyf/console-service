<?php

namespace SenventhCode\ConsoleService\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class DashboardController extends MainController
{
    public function index(Request $request)
    {
        return view('console-service::dashboard.index');
    }

    public function colorScheme(string $scheme)
    {
        Cookie::queue(Cookie::make('colorScheme', $scheme, (60 * 24) * 365));

        return redirect()->route('dashboard');
    }
}

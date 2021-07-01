<?php

namespace SenventhCode\ConsoleService\App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\Language;
use Illuminate\Http\Request;

class DashboardController extends MainController
{
    public function index(Request $request)
    {
        return view('console-service::dashboard.index');
    }
}

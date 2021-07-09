<?php

namespace SenventhCode\ConsoleService\App\View\Components;

use Illuminate\View\Component;

class ResponseForm extends Component
{

    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('console-service::components.response-form');
    }
}

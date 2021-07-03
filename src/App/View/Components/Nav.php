<?php

namespace SenventhCode\ConsoleService\App\View\Components;

use Illuminate\View\Component;

class Nav extends Component
{

    public $id;
    public $nav;

    public function __construct(int $id = null, array $nav)
    {
        $this->id  = $id;
        $this->nav = $nav;
    }

    public function render()
    {
        return view('console-service::components.nav');
    }
}

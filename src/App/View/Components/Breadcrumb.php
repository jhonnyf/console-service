<?php

namespace SenventhCode\ConsoleService\App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{

    public $id;
    public $route;
    public $name;

    public function __construct(string $route, string $name, int $id = null)
    {
        $this->id    = $id;
        $this->route = $route;
        $this->name  = $name;
    }

    public function render()
    {
        return view('console-service::components.breadcrumb');
    }
}

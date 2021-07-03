<?php

namespace SenventhCode\ConsoleService\App\View\Components;

use App\Models\Coins;
use Illuminate\View\Component;

class NavCoins extends Component
{
    public $route;
    public $route_params;
    public $coin_id;
    public $coins;
    public $class_item;

    public function __construct(string $route, array $routeParams = [], int $coinId = null, array $classItem = [])
    {
        $this->route        = $route;
        $this->route_params = $routeParams;
        $this->coin_id      = $coinId;
        $this->coins        = Coins::where('active', '<>', 2);
        $this->class_item   = $classItem;
    }

    public function render()
    {
        return view('console-service::components.nav-coins');
    }
}

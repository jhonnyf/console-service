<?php

namespace SenventhCode\ConsoleService\App\View\Components;

use App\Models\Languages;
use Illuminate\View\Component;

class NavLanguages extends Component
{
    public $route;
    public $route_params;
    public $language_id;
    public $languages;
    public $class_item;

    public function __construct(string $route, array $routeParams = [], int $languageId = null, array $classItem = [])
    {
        $this->route        = $route;
        $this->route_params = $routeParams;
        $this->language_id  = $languageId;
        $this->languages    = Languages::where('active', '<>', 2);
        $this->class_item   = $classItem;
    }

    public function render()
    {
        return view('console-service::components.nav-languages');
    }
}

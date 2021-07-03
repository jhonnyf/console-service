<?php

namespace SenventhCode\ConsoleService\App\View\Components;

use App\Models\Categories;
use Illuminate\View\Component;

class CategoriesList extends Component
{
    public $category;

    public function __construct(Categories $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        return view('console-service::components.categories-list');
    }
}

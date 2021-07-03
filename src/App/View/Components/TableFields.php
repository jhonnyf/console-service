<?php

namespace SenventhCode\ConsoleService\App\View\Components;

use Illuminate\View\Component;

class TableFields extends Component
{
    public $tableFields;
    public $tableValues;
    public $route;
    public $extraData;

    public function __construct($tableFields, $tableValues, $route, $extraData = [])
    {
        $this->tableFields = $tableFields;
        $this->tableValues = $tableValues;
        $this->route       = $route;
        $this->extraData   = $extraData;
    }

    public function render()
    {
        return view('console-service::components.table-fields');
    }
}

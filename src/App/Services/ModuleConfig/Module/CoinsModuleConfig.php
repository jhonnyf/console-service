<?php

namespace SenventhCode\ConsoleService\App\Services\ModuleConfig\Module;

use Illuminate\Http\Request;
use SenventhCode\ConsoleService\App\Services\ModuleConfig\AbstractModuleConfig;

class CoinsModuleConfig extends AbstractModuleConfig
{
    public $Route     = 'coins';
    public $TableName = 'coins';
    public $Name      = 'Moeda';

    public function setNav(Request $request, int $id = null): array
    {
        $response[] = [
            'name'  => 'Principal',
            'route' => route('coins.form', ['id' => $id]),
        ];

        return $response;
    }
}
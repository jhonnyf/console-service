<?php

namespace SenventhCode\ConsoleService\App\Services\ModuleConfig\Module;

use Illuminate\Http\Request;
use SenventhCode\ConsoleService\App\Services\ModuleConfig\AbstractModuleConfig;

class LanguagesModuleConfig extends AbstractModuleConfig
{
    public $Route     = 'languages';
    public $TableName = 'languages';
    public $Name      = 'Linguagem';

    public function setNav(Request $request, int $id = null): array
    {
        $response[] = [
            'name'  => 'Principal',
            'route' => route('languages.form', ['id' => $id]),
        ];

        return $response;
    }
}
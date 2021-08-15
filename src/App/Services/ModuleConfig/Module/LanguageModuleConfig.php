<?php

namespace SenventhCode\ConsoleService\App\Services\ModuleConfig\Module;

use Illuminate\Http\Request;
use SenventhCode\ConsoleService\App\Services\ModuleConfig\AbstractModuleConfig;

class LanguageModuleConfig extends AbstractModuleConfig
{
    public $Route     = 'language';
    public $TableName = 'languages';
    public $Name      = 'Linguagem';

    public function setNav(Request $request, int $id = null): array
    {
        $response[] = [
            'name'  => 'Principal',
            'route' => route('language.form', ['id' => $id]),
        ];

        return $response;
    }
}
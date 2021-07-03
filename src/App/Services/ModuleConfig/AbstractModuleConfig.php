<?php

namespace SenventhCode\ConsoleService\App\Services\ModuleConfig;

use Illuminate\Http\Request;

class AbstractModuleConfig
{
    public function setData(Request $request): array
    {
        return [];
    }

    public function setCondition(Request $request): array
    {
        return [];
    }

    public function setNav(Request $request, int $id = null): array
    {
        return [];
    }
}

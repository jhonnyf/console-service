<?php

namespace SenventhCode\ConsoleService\App\Services\Metadata\Modules;

use SenventhCode\ConsoleService\App\Services\Metadata\Interfaces\RulesInterface;

abstract class Categories implements RulesInterface
{
    public static function tableRules(array $columns): array
    {
        return $columns;
    }

    public static function baseRules(array $columns): array
    {

        $columns['default']['type'] = 'hidden';

        return $columns;
    }
}

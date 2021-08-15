<?php

namespace SenventhCode\ConsoleService\App\Services\Metadata\Modules;

use SenventhCode\ConsoleService\App\Services\Metadata\Interfaces\RulesInterface;

abstract class Languages implements RulesInterface
{

    public static function tableRules(array $columns): array
    {
        unset($columns['default']);
        unset($columns['active']);

        return $columns;
    }

    public static function baseRules(array $columns): array
    {
        $columns['default']['type']        = 'hidden';
        $columns['default']['elementType'] = 'input';
        $columns['default']['default']     = 0;

        return $columns;
    }

}

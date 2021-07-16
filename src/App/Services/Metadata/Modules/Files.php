<?php

namespace SenventhCode\ConsoleService\App\Services\Metadata\Modules;

use SenventhCode\ConsoleService\App\Services\Metadata\Interfaces\RulesInterface;

abstract class Files implements RulesInterface
{
    public static function tableRules(array $columns): array
    {
        unset($columns['active']);
        unset($columns['password']);
        unset($columns['remember_token']);
        unset($columns['category_id']);

        return $columns;
    }

    public static function baseRules(array $columns): array
    {

        unset($columns['slug']);

        return $columns;
    }

}

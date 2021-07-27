<?php

namespace SenventhCode\ConsoleService\App\Services\Metadata\Modules;

use SenventhCode\ConsoleService\App\Services\Metadata\Interfaces\RulesInterface;

abstract class Contents implements RulesInterface
{
    public static function tableRules(array $columns): array
    {
        unset($columns['content']);
        unset($columns['link']);
        unset($columns['video']);

        return $columns;
    }

    public static function baseRules(array $columns): array
    {
        $columns['title']['required'] = true;
        $columns['slug']['readonly']  = true;

        $columns['content']['elementType'] = 'textarea';
        $columns['content']['class'] = ['ckeditor'];

        return $columns;
    }

}

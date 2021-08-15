<?php

namespace SenventhCode\ConsoleService\App\Services\Metadata\Modules;

use SenventhCode\ConsoleService\App\Services\Metadata\Interfaces\RulesInterface;

abstract class Languages implements RulesInterface
{
    public static $tableExport = [];

    public static function tableRules(array $columns): array
    {

        $columns['language']['label']   = 'Linguagem';
        $columns['code']['label']       = 'Código';
        $columns['created_at']['label'] = 'Criado em';
        $columns['updated_at']['label'] = 'Atualizado em';

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

    public static function getTableExport()
    {
        return static::$tableExport;
    }

    public static function tableExport(array $columns)
    {
        $columns['languages']['id']['label']         = 'ID';
        $columns['languages']['active']['label']     = 'Status';
        $columns['languages']['language']['label']   = 'Linguagem';
        $columns['languages']['code']['label']       = 'Código';
        $columns['languages']['default']['label']    = 'Padrão';
        $columns['languages']['created_at']['label'] = 'Criado em';
        $columns['languages']['updated_at']['label'] = 'Atualizado em';

        return $columns;
    }

}

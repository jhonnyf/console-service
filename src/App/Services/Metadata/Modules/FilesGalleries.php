<?php

namespace SenventhCode\ConsoleService\App\Services\Metadata\Modules;

use SenventhCode\ConsoleService\App\Services\Metadata\Interfaces\RulesInterface;

abstract class FilesGalleries implements RulesInterface
{
    public static $tableExport = [];

    public static function tableRules(array $columns): array
    {
        $columns['file_gallery']['label'] = 'Tipo de galeria';
        $columns['module']['label']       = 'Module';
        $columns['created_at']['label']   = 'Criado em';
        $columns['updated_at']['label']   = 'Atualizado em';

        unset($columns['active']);

        return $columns;
    }

    public static function baseRules(array $columns): array
    {

        $columns['file_gallery']['label'] = 'Tipo de galeria';

        $columns['module']['label'] = 'Module';

        return $columns;
    }

    public static function getTableExport()
    {
        return static::$tableExport;
    }

    public static function tableExport(array $columns)
    {
        $columns['files_galleries']['id']['label']           = 'ID';
        $columns['files_galleries']['active']['label']       = 'Status';
        $columns['files_galleries']['file_gallery']['label'] = 'Tipo de galeria';
        $columns['files_galleries']['module']['label']       = 'Modulo';
        $columns['files_galleries']['created_at']['label']   = 'Criado em';
        $columns['files_galleries']['updated_at']['label']   = 'Atualizado em';

        return $columns;
    }

}

<?php

namespace SenventhCode\ConsoleService\App\Services\Metadata;

use Illuminate\Support\Facades\DB;

class Metadata
{

    public static function tableFields(string $tableName): array
    {
        $columns   = static::tableMetadata($tableName);
        $className = static::createNameClass($tableName);

        $pathClass = static::checkClass($className);
        return $pathClass::tableRules($columns);
    }

    public static function tableExport(string $tableName, array $extraTables = [])
    {
        $columns[$tableName] = static::tableMetadata($tableName);
        $className           = static::createNameClass($tableName);

        $pathClass   = static::checkClass($className);
        $extraTables = $pathClass::getTableExport();
        if (count($extraTables) > 0) {
            foreach ($extraTables as $table) {
                $columns[$table] = static::tableMetadata($table);
            }
        }

        return $pathClass::tableExport($columns);
    }

    private static function tableMetadata(string $table): array
    {
        return static::fields(DB::select("DESCRIBE {$table};"));
    }

    private static function createNameClass(string $tableName): string
    {
        $className = str_replace('_', ' ', $tableName);
        $className = ucwords($className);
        $className = str_replace(' ', '', $className);

        return $className;
    }

    private static function checkClass(string $className): string
    {
        $path = "\SenventhCode\ConsoleService\App\Services\Metadata\Modules\Master";
        if (class_exists("\SenventhCode\ConsoleService\App\Services\Metadata\Modules\\{$className}")) {
            $path = "\SenventhCode\ConsoleService\App\Services\Metadata\Modules\\{$className}";
        }

        return $path;
    }

    private static function fields(array $fields): array
    {
        $metadata = [];
        foreach ($fields as $field) {

            $position_int = strpos($field->Type, "(");

            $metadata[$field->Field]['name'] = $field->Field;
            $metadata[$field->Field]['type'] = $position_int === false ? $field->Type : substr($field->Type, 0, $position_int);
        }

        return $metadata;
    }

}

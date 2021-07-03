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
        $fields    = $pathClass::tableRules($columns);

        return $fields;
    }

    public static function formFields(string $tableName, array $formValues = []): array
    {
        $columns   = static::tableMetadata($tableName);
        $className = static::createNameClass($tableName);

        $pathClass = static::checkClass($className);
        $fields    = $pathClass::formRules($columns, $formValues);

        return $fields;
    }

    public static function checkClass(string $className): string
    {
        $path = "\SenventhCode\ConsoleService\App\Services\Metadata\Master";
        if (file_exists(app_path("Services/Metadata/{$className}.php"))) {
            $path = "\App\Services\Metadata\\{$className}";
        }

        return $path;
    }

    public static function formRulesMain(array $columns, array $formValues = []): array
    {
        unset($columns['active']);
        unset($columns['created_at']);
        unset($columns['updated_at']);

        $columns = static::formatFields($columns, $formValues);

        return $columns;
    }

    public static function formatFields(array $columns, array $formValues = []): array
    {
        $fields = [];

        $text   = ['varchar', 'char'];
        $number = ['bigint', 'tinyint', 'int', 'decimal', 'bigint unsigned'];

        foreach ($columns as $column) {

            $value = isset($formValues[$column['name']]) ? $formValues[$column['name']] : '';
            if (strlen($column['default']) > 0 && empty($value)) {
                $value = $column['default'];
            }

            $element = 'input';

            if ($column['key'] === 'pri') {
                $type = 'hidden';
            } elseif (in_array($column['type'], $text)) {
                $type = 'text';
            } elseif (in_array($column['type'], $number)) {
                $type = 'number';
            } elseif ($column['type'] === 'date') {
                $type = 'date';
            } elseif ($column['type'] === 'datetime') {
                $type  = 'datetime-local';
                $value = str_replace(" ", "T", $value);
            } else {
                exit("Tipo não definido - <b>{$column['type']}</b>");
            }

            $fields[$column['name']] = [
                'element'    => $element,
                'name'       => $column['name'],
                'type'       => $type,
                'max_length' => $column['max_length'],
                'value'      => $value,
            ];
        }

        return $fields;
    }

    private static function tableMetadata(string $table): array
    {
        return static::fields(static::describe($table));
    }

    private static function describe(string $table): array
    {
        return DB::select("DESCRIBE {$table};");
    }

    private static function fields(array $fields): array
    {
        foreach ($fields as $field) {

            $max_length   = null;
            $position_int = strpos($field->Type, "(");
            if ($position_int !== false) {

                preg_match('/[^a-z]+/', $field->Type, $matches);

                $max_length = str_replace('(', '', $matches[0]);
                $max_length = str_replace(')', '', $max_length);
            }

            $metadata[$field->Field]['name']       = $field->Field;
            $metadata[$field->Field]['type']       = $position_int === false ? $field->Type : substr($field->Type, 0, $position_int);
            $metadata[$field->Field]['max_length'] = trim($max_length);
            $metadata[$field->Field]['key']        = strtolower($field->Key);
            $metadata[$field->Field]['default']    = $field->Default;
        }

        return $metadata;
    }

    private static function createNameClass(string $tableName): string
    {
        $className = str_replace('_', ' ', $tableName);
        $className = ucwords($className);
        $className = str_replace(' ', '', $className);

        return $className;
    }

}

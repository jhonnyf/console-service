<?php

namespace SenventhCode\ConsoleService\App\Services;

class TableFieldsService
{
    public static function format(object $row, array $column): ?string
    {
        $value     = '';
        $parameter = isset($column['parameter']) ? $column['parameter'] : $column['name'];

        if (strpos($parameter, "->")) {
            foreach (explode("->", $parameter) as $property) {
                $row = static::getProperty($property, $row);
            }

            $value = $row;
        } else {
            if (in_array($column['type'], ['datetime', 'timestamp'])) {
                $value = empty($row->$parameter) == false ? date('d/m/Y H:i:s', strtotime($row->$parameter)) : '';
            } elseif ($column['type'] == 'date') {
                $value = empty($row->$parameter) == false ? date('d/m/Y', strtotime($row->$parameter)) : '';
            } else {
                $value = $row->$parameter;
            }
        }

        return $value;
    }

    private static function getProperty($property, $object)
    {
        return $object->{$property};
    }
}

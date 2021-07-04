<?php

namespace SenventhCode\ConsoleService\App\Services\Metadata;

use SenventhCode\ConsoleService\App\Services\Metadata\Interfaces\RulesInterface;
abstract class Users implements RulesInterface
{
    public static function tableRules(array $columns): array
    {
        unset($columns['active']);
        unset($columns['password']);

        // $columns['user_type_id']['parameter'] = "userType->user_type";

        return $columns;
    }

    public static function baseRules(array $columns): array
    {        
        $columns['first_name']['required'] = true;
        $columns['email']['required']      = true;
        $columns['document']['required']   = true;

        unset($columns['password']);
        unset($columns['category_id']);

        return $columns;
    }

}

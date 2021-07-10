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
        $columns['first_name']['label']    = 'Nome';
        $columns['first_name']['required'] = true;

        $columns['email']['label']       = 'E-mail';
        $columns['email']['required']    = true;
        $columns['email']['type']        = 'email';
        $columns['email']['elementType'] = 'input';

        $columns['document']['label']    = 'Documento';
        $columns['document']['required'] = true;

        $columns['last_name']['label'] = 'Sobrenome';
        $columns['phone']['label']     = 'Telefone';
        $columns['cellphone']['label'] = 'Celular';

        unset($columns['password']);
        unset($columns['category_id']);
        unset($columns['remember_token']);

        return $columns;
    }

}

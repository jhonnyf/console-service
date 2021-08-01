<?php

namespace SenventhCode\ConsoleService\App\Services\Metadata\Modules;

use SenventhCode\ConsoleService\App\Services\Metadata\Interfaces\RulesInterface;

abstract class Users implements RulesInterface
{
    public static $tableExport = ['users_extensions', 'users_addresses'];

    public static function tableRules(array $columns): array
    {
        $columns['first_name']['label'] = 'Nome';
        $columns['last_name']['label']  = 'Sobrenome';
        $columns['email']['label']      = 'E-mail';
        $columns['document']['label']   = 'Documento';
        $columns['phone']['label']      = 'Telefone';
        $columns['cellphone']['label']  = 'Celular';
        $columns['created_at']['label'] = 'Criado em';
        $columns['updated_at']['label'] = 'Atualizado em';

        unset($columns['active']);
        unset($columns['password']);
        unset($columns['remember_token']);
        unset($columns['category_id']);

        return $columns;
    }

    public static function getTableExport()
    {
        return static::$tableExport;
    }

    public static function tableExport(array $columns)
    {

        $columns['users']['first_name']['label'] = 'Nome';
        $columns['users']['last_name']['label']  = 'sobrenome';
        $columns['users']['email']['label']      = 'E-mail';
        $columns['users']['document']['label']   = 'Documento';
        $columns['users']['phone']['label']      = 'Telefone';
        $columns['users']['cellphone']['label']  = 'Celular';
        $columns['users']['created_at']['label'] = 'Criado em';

        $columns['users_addresses']['zipcode']['label']    = 'CEP';
        $columns['users_addresses']['address']['label']    = 'Endereço';
        $columns['users_addresses']['number']['label']     = 'Número';
        $columns['users_addresses']['complement']['label'] = 'Complemento';
        $columns['users_addresses']['district']['label']   = 'Bairro';
        $columns['users_addresses']['city']['label']       = 'Cidade';
        $columns['users_addresses']['state']['label']      = 'Estado';
        $columns['users_addresses']['country']['label']    = 'País';

        unset($columns['users']['active']);
        unset($columns['users']['password']);
        unset($columns['users']['remember_token']);
        unset($columns['users']['category_id']);
        unset($columns['users']['updated_at']);

        unset($columns['users_addresses']['id']);
        unset($columns['users_addresses']['active']);
        unset($columns['users_addresses']['user_id']);
        unset($columns['users_addresses']['created_at']);
        unset($columns['users_addresses']['updated_at']);

        unset($columns['users_extensions']['user_id']);
        unset($columns['users_extensions']['created_at']);
        unset($columns['users_extensions']['updated_at']);

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

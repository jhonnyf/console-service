<?php

namespace SenventhCode\ConsoleService\App\Services\Metadata\Modules;

use SenventhCode\ConsoleService\App\Services\Metadata\Interfaces\RulesInterface;

abstract class UsersAddresses implements RulesInterface
{
    private static $states = [
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins',
    ];

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
        $columns['user_id']['type'] = 'hidden';

        $columns['zipcode']['label']    = 'CEP *';
        $columns['address']['label']    = 'Endereço';
        $columns['number']['label']     = 'Numero *';
        $columns['complement']['label'] = 'Complemento';
        $columns['district']['label']   = 'Bairro';
        $columns['city']['label']       = 'Cidade';
        $columns['state']['label']      = 'Estado';
        $columns['country']['label']    = 'País';

        $columns['state']['elementType'] = 'select';
        $columns['state']['options']     = self::$states;

        return $columns;
    }

}

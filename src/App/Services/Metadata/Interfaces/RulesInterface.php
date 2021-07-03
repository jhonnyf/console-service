<?php

namespace SenventhCode\ConsoleService\App\Services\Metadata\Interfaces;

interface RulesInterface
{
    /**
     * @param array $columns
     * @return array
     */

    public static function tableRules(array $columns): array;

    /**
     * @param array $columns
     * @return array
     */

    public static function formRules(array $columns): array;
}

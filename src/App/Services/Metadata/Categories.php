<?php

namespace SenventhCode\ConsoleService\App\Services\Metadata;

use SenventhCode\ConsoleService\App\Services\Metadata\Interfaces\RulesInterface;

abstract class Categories implements RulesInterface
{
    public static function tableRules(array $columns): array
    {
        return $columns;
    }

    public static function formRules(array $columns, array $formValues = []): array
    {
        $columns = Metadata::formRulesMain($columns, $formValues);

        $columns['default']['type'] = 'hidden';

        return $columns;
    }
}

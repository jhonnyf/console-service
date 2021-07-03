<?php

namespace SenventhCode\ConsoleService\App\Services\Metadata;

use SenventhCode\ConsoleService\App\Services\Metadata\Interfaces\RulesInterface;

abstract class Products implements RulesInterface
{
    public static function tableRules(array $columns): array
    {
        unset($columns['active']);

        return $columns;
    }

    public static function formRules(array $columns, array $formValues = []): array
    {
        $columns = Metadata::formRulesMain($columns, $formValues);

        $columns['sku']['required']   = true;
        $columns['stock']['readonly'] = true;

        unset($columns['combo_code']);

        return $columns;
    }

}

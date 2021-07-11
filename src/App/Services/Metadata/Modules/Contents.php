<?php

namespace App\Services\Metadata;

use SenventhCode\ConsoleService\App\Services\Metadata\Interfaces\RulesInterface;
use SenventhCode\ConsoleService\App\Services\Metadata\Metadata;

abstract class Contents implements RulesInterface
{
    public static function tableRules(array $columns): array
    {
        unset($columns['content']);
        unset($columns['link']);
        unset($columns['video']);

        return $columns;
    }

    public static function formRules(array $columns, array $formValues = []): array
    {
        $columns = Metadata::formRulesMain($columns, $formValues);

        $columns['language_id']['type'] = 'hidden';
        $columns['reference_id']['type'] = 'hidden';
        $columns['title']['required']   = true;
        $columns['slug']['readonly']    = true;
        $columns['content']['type']     = 'textarea';

        return $columns;
    }

}

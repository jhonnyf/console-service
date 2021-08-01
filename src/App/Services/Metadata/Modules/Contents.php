<?php

namespace SenventhCode\ConsoleService\App\Services\Metadata\Modules;

use SenventhCode\ConsoleService\App\Services\Metadata\Interfaces\RulesInterface;

abstract class Contents implements RulesInterface
{
    public static function tableRules(array $columns): array
    {
        unset($columns['content']);
        unset($columns['link']);
        unset($columns['video']);

        return $columns;
    }

    public static function baseRules(array $columns): array
    {
        $columns['slug']['readonly'] = true;
        $columns['slug']['label'] = 'Slug';

        $columns['title']['required'] = true;
        $columns['title']['label']    = 'Título';

        $columns['date']['label']     = 'Data';
        $columns['subtitle']['label'] = 'Subtítulo';
        $columns['link']['label']     = 'Link';
        $columns['video']['label']    = 'Vídeo';

        $columns['content']['elementType'] = 'textarea';
        $columns['content']['label']       = 'Conteúdo';
        $columns['content']['class']       = ['ckeditor'];

        return $columns;
    }

}

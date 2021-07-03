<?php

namespace SenventhCode\ConsoleService\App\Services\ModuleConfig\Module;

use Illuminate\Http\Request;
use SenventhCode\ConsoleService\App\Services\ModuleConfig\AbstractModuleConfig;

class CategoriesModuleConfig extends AbstractModuleConfig
{
    public $Route     = 'categories';
    public $TableName = 'categories';
    public $Name      = 'Categoria';

    public function setData(Request $request): array
    {
        return ['category_id' => $request->category_id];
    }

    public function setNav(Request $request, int $id = null): array
    {
        $response[] = [
            'name'  => 'Principal',
            'route' => route('categories.form', ['id' => $id, 'category_id' => $request->category_id]),
        ];

        if (is_null($id) === false) {

            $response[] = [
                'name'  => 'Conteúdo',
                'route' => route('categories.content', ['id' => $id, 'category_id' => $request->category_id]),
            ];

            $response[] = [
                'name'  => 'Arquivos',
                'route' => route('files.listGalleries', ['module' => 'categories', 'link_id' => $id, 'category_id' => $request->category_id]),
            ];

        }

        return $response;
    }
}

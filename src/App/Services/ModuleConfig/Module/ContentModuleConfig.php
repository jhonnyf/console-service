<?php

namespace SenventhCode\ConsoleService\App\Services\ModuleConfig\Module;

use App\Models\Category;
use Illuminate\Http\Request;
use SenventhCode\ConsoleService\App\Services\ModuleConfig\AbstractModuleConfig;

class ContentModuleConfig extends AbstractModuleConfig
{
    public $Route           = 'content';
    public $TableName       = 'contents';
    public $Name            = 'Conteúdo';
    public $EnableLanguages = true;

    public function setData(Request $request): array
    {
        return ['category_id' => $request->category_id];
    }

    public function setCondition(Request $request): array
    {
        $links = Category::find($request->category_id)
            ->contents()
            ->get()
            ->keyby('id')
            ->toArray();

        return ['id' => array_keys($links)];
    }

    public function setNav(Request $request, int $id = null): array
    {
        $response[] = [
            'name'  => 'Principal',
            'route' => route('content.form', ['id' => $id, 'category_id' => $request->category_id]),
        ];

        if (is_null($id) === false) {

            $response[] = [
                'name'  => 'Arquivos',
                'route' => route('file.list-galleries', ['module' => 'content', 'link_id' => $id, 'category_id' => $request->category_id]),
            ];
        }

        return $response;
    }
}

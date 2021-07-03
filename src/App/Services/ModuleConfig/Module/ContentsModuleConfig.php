<?php

namespace SenventhCode\ConsoleService\App\Services\ModuleConfig\Module;

use App\Models\Categories;
use Illuminate\Http\Request;
use SenventhCode\ConsoleService\App\Services\ModuleConfig\AbstractModuleConfig;

class ContentsModuleConfig extends AbstractModuleConfig
{
    public $Route     = 'contents';
    public $TableName = 'contents';
    public $Name      = 'Conteúdo';

    public function setData(Request $request): array
    {
        return ['category_id' => $request->category_id];
    }

    public function setCondition(Request $request): array
    {
        $links = Categories::find($request->category_id)
            ->contentsCategory()
            ->get()
            ->keyby('id')
            ->toArray();

        return ['id' => array_keys($links)];
    }

    public function setNav(Request $request, int $id = null): array
    {
        $response[] = [
            'name'  => 'Principal',
            'route' => route('contents.form', ['id' => $id, 'category_id' => $request->category_id]),
        ];

        if (is_null($id) === false) {

            $response[] = [
                'name'  => 'Arquivos',
                'route' => route('files.listGalleries', ['module' => 'contents', 'link_id' => $id, 'category_id' => $request->category_id]),
            ];

        }

        return $response;
    }
}

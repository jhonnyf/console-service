<?php

namespace SenventhCode\ConsoleService\App\Services\ModuleConfig\Module;

use App\Models\Category;
use Illuminate\Http\Request;
use SenventhCode\ConsoleService\App\Services\ModuleConfig\AbstractModuleConfig;

class UserModuleConfig extends AbstractModuleConfig
{
    public $Route     = 'user';
    public $TableName = 'users';
    public $Name      = 'Usuário';

    public function setData(Request $request): array
    {
        return ['category_id' => $request->category_id];
    }

    public function setCondition(Request $request): array
    {
        $links = Category::find($request->category_id)
            ->users()
            ->get()
            ->keyBy('id')
            ->toArray();

        return ['id' => array_keys($links)];
    }

    public function setNav(Request $request, int $id = null): array
    {
        $response[] = [
            'name'  => 'Principal',
            'route' => route('user.form', ['id' => $id, 'category_id' => $request->category_id]),
        ];

        if (is_null($id) === false) {

            $response[] = [
                'name'  => 'Extensão',
                'route' => route('user.extension', ['id' => $id, 'category_id' => $request->category_id]),
            ];
            
            $response[] = [
                'name'  => 'Endereços',
                'route' => route('user.address', ['id' => $id, 'category_id' => $request->category_id]),
            ];

            $response[] = [
                'name'  => 'Categorias',
                'route' => route('user.category', ['id' => $id, 'category_id' => $request->category_id]),
            ];

            $response[] = [
                'name'  => 'Senha',
                'route' => route('user.password', ['id' => $id, 'category_id' => $request->category_id]),
            ];

            $response[] = [
                'name'  => 'Arquivos',
                'route' => route('file.list-galleries', ['module' => 'user', 'link_id' => $id, 'category_id' => $request->category_id]),
            ];

        }

        return $response;
    }
}

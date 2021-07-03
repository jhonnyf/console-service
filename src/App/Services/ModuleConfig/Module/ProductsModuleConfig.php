<?php

namespace SenventhCode\ConsoleService\App\Services\ModuleConfig\Module;

use Illuminate\Http\Request;
use SenventhCode\ConsoleService\App\Services\ModuleConfig\AbstractModuleConfig;

class ProductsModuleConfig extends AbstractModuleConfig
{
    public $Route     = 'products';
    public $TableName = 'products';
    public $Name      = 'Produto';

    public function setNav(Request $request, int $id = null): array
    {
        $response[] = [
            'name'  => 'Principal',
            'route' => route("{$this->Route}.form", ['id' => $id]),
        ];

        if (is_null($id) === false) {

            $response[] = [
                'name'  => 'Conteúdo',
                'route' => route("{$this->Route}.content", ['id' => $id]),
            ];

            $response[] = [
                'name'  => 'Grupo de produtos',
                'route' => route("{$this->Route}.combo-code", ['id' => $id]),
            ];

            $response[] = [
                'name'  => 'Preço',
                'route' => route("{$this->Route}.price", ['id' => $id]),
            ];

            $response[] = [
                'name'  => 'Arquivos',
                'route' => route('files.listGalleries', ['module' => 'products', 'link_id' => $id]),
            ];

        }

        return $response;
    }
}
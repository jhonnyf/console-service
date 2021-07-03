<?php

namespace SenventhCode\ConsoleService\App\Services\ModuleConfig\Module;

use Illuminate\Http\Request;
use SenventhCode\ConsoleService\App\Services\ModuleConfig\AbstractModuleConfig;

class FilesGalleriesModuleConfig extends AbstractModuleConfig
{
    public $Route     = 'filesGalleries';
    public $TableName = 'files_galleries';
    public $Name      = 'Tipo de galeria';

    public function setNav(Request $request, int $id = null): array
    {
        $response[] = [
            'name'  => 'Principal',
            'route' => route('filesGalleries.form', ['id' => $id]),
        ];

        return $response;
    }
}

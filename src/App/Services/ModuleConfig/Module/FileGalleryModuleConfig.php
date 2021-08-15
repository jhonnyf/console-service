<?php

namespace SenventhCode\ConsoleService\App\Services\ModuleConfig\Module;

use Illuminate\Http\Request;
use SenventhCode\ConsoleService\App\Services\ModuleConfig\AbstractModuleConfig;

class FileGalleryModuleConfig extends AbstractModuleConfig
{
    public $Route     = 'file-gallery';
    public $TableName = 'files_galeries';
    public $Name      = 'Tipo de galeria';

    public function setNav(Request $request, int $id = null): array
    {
        $response[] = [
            'name'  => 'Principal',
            'route' => route('file-gallery.form', ['id' => $id]),
        ];

        return $response;
    }
}

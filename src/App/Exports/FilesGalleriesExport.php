<?php

namespace App\Exports;

use App\Models\FileGallery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use SenventhCode\ConsoleService\App\Services\Metadata\Metadata;

class FilesGalleriesExport implements FromView
{

    public function view(): View
    {
        $tableValues = FileGallery::where('active', '<>', 2);

        $data['tableFields'] = Metadata::tableExport('files_galleries');
        $data['tableValues'] = $tableValues->get();

        return view('console-service::module-base.export', $data);
    }
}

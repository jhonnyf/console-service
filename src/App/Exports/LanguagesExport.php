<?php

namespace App\Exports;

use App\Models\Language;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use SenventhCode\ConsoleService\App\Services\Metadata\Metadata;

class LanguagesExport implements FromView
{

    public function view(): View
    {
        $tableValues = Language::where('active', '<>', 2);

        $data['tableFields'] = Metadata::tableExport('languages');
        $data['tableValues'] = $tableValues->get();

        return view('console-service::module-base.export', $data);
    }
}

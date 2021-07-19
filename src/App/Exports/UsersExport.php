<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use SenventhCode\ConsoleService\App\Services\Metadata\Metadata;

class UsersExport implements FromView
{
    public $category_id;

    public function __construct($category_id)
    {
        $this->category_id = $category_id;
    }

    public function view(): View
    {
        $tableValues = User::where('active', '<>', 2)
            ->where('category_id', $this->category_id);

        $data['tableFields'] = Metadata::tableExport('users');
        $data['tableValues'] = $tableValues->get();

        return view('console-service::user.export', $data);
    }
}

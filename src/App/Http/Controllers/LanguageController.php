<?php

namespace SenventhCode\ConsoleService\App\Http\Controllers;

use App\Exports\LanguagesExport;
use App\Models\Language as Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use SenventhCode\ConsoleService\App\Http\Requests\LanguagesStore;
use SenventhCode\ConsoleService\App\Http\Requests\LanguagesUpdate;

class LanguageController extends MainController
{
    public function __construct()
    {
        $this->Route = 'language';
        parent::__construct(Model::class);
    }

    public function store(LanguagesStore $request)
    {
        $response = Model::create($request->all());

        return redirect()->route("{$this->Route}.form", ['id' => $response->id]);
    }

    public function update(int $id, LanguagesUpdate $request)
    {
        Model::find($id)->fill($request->all())->save();

        return redirect()->route("{$this->Route}.form", ['id' => $id]);
    }

    /**
     * EXPORT
     */

    public function export()
    {
        return Excel::download(new LanguagesExport, 'languages.xlsx');
    }
}

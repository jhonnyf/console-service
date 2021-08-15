<?php

namespace SenventhCode\ConsoleService\App\Http\Controllers;

use App\Exports\FilesGalleriesExport;
use App\Models\FileGallery as Model;
use Maatwebsite\Excel\Facades\Excel;
use SenventhCode\ConsoleService\App\Http\Requests\FilesGalleriesStore;
use SenventhCode\ConsoleService\App\Http\Requests\FilesGalleriesUpdate;

class FileGalleryController extends MainController
{
    public function __construct()
    {
        $this->Route = 'file-gallery';
        parent::__construct(Model::class);
    }

    public function store(FilesGalleriesStore $request)
    {
        $response = Model::create($request->all());

        return redirect()->route("{$this->Route}.form", ['id' => $response->id]);
    }

    public function update(int $id, FilesGalleriesUpdate $request)
    {
        Model::find($id)->fill($request->all())->save();

        return redirect()->route("{$this->Route}.form", ['id' => $id]);
    }

    /**
     * EXPORT
     */

    public function export()
    {
        return Excel::download(new FilesGalleriesExport, 'file-gallery.xlsx');
    }
}

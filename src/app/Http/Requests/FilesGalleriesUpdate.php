<?php

namespace SenventhCode\ConsoleService\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilesGalleriesUpdate extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'           => 'required|exists:files_galleries',
            'file_gallery' => 'required|string|min:3',
            'module'       => 'required|string|min:3',
        ];
    }
}

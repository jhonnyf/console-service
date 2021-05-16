<?php

namespace SenventhCode\ConsoleService\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilesGalleriesStore extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file_gallery' => 'required|string|min:3',
            'module'       => 'required|string|min:3',
        ];
    }
}

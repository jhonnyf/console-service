<?php

namespace SenventhCode\ConsoleService\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUpload extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'file' => 'required|file|max:4000'
        ];
    }
}

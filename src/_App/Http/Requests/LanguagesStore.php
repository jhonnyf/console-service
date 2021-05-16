<?php

namespace SenventhCode\ConsoleService\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguagesStore extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'language' => 'required|string|min:3',
            'code'     => 'required|string|min:2',
            'default'  => 'required|boolean',
        ];
    }
}

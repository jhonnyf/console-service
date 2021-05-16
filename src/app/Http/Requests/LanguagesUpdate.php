<?php

namespace SenventhCode\ConsoleService\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguagesUpdate extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'       => 'required|integer|exists:languages',
            'language' => 'required|string|min:3',
            'code'     => 'required|string|min:2',
            'default'  => 'required|boolean',
        ];
    }
}

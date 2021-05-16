<?php

namespace SenventhCode\ConsoleService\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Password extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password'    => 'required|min:6',
            'co-password' => 'required|min:6|same:password',
        ];
    }
}

<?php

namespace SenventhCode\ConsoleService\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersStore extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
            'first_name'  => 'required|string|min:3',
            'email'       => 'required|string|unique:users|email:rfc,dns',
            'password'    => 'nullable',
            'document'    => 'required|unique:users',
            'phone'       => 'nullable|min:8',
            'cellphone'   => 'nullable|min:8',
        ];
    }
}

<?php

namespace SenventhCode\ConsoleService\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UsersUpdate extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'id'          => 'required|exists:users',
            'category_id' => 'required|integer|exists:categories,id',
            'first_name'  => 'required|string|min:3',
            'email'       => "required|string|unique:users,email,{$request->id},id",
            'password'    => 'nullable',
            'document'    => "required|unique:users,document,{$request->id},id",
            'phone'       => 'nullable|min:8',
            'cellphone'   => 'nullable|min:8',
        ];
    }
}

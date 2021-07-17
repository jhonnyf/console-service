<?php

namespace SenventhCode\ConsoleService\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersAddressUpdate extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'      => 'required|exists:users_addresses',
            'zipcode' => 'required|min:8',
            'number'  => 'required',
        ];
    }
}

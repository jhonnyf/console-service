<?php

namespace SenventhCode\ConsoleService\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoinsUpdate extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'     => 'required|integer|exists:coins',
            'coin'   => 'required|string|min:3',
            'symbol' => 'required|string',
        ];
    }
}

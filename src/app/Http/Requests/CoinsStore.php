<?php

namespace SenventhCode\ConsoleService\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoinsStore extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'coin'   => 'required|string|min:3',
            'symbol' => 'required|string',
        ];
    }
}

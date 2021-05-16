<?php

namespace SenventhCode\ConsoleService\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesUpdate extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'          => 'required|exists:categories',
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }
}

<?php

namespace SenventhCode\ConsoleService\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesStore extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }
}

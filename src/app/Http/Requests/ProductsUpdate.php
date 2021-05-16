<?php

namespace SenventhCode\ConsoleService\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsUpdate extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id'              => 'required|integer|exists:products',
            'sku'             => 'required|integer|unique:products,sku',
            'weight'          => 'numeric',
            'width'           => 'numeric',
            'height'          => 'numeric',
            'length'          => 'numeric',
            'stock'           => 'integer',
            'release_date'    => 'date',
            'expiration_date' => 'date',
        ];
    }
}

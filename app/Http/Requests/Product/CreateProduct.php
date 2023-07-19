<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|string",
            "slug" => "required|string|unique:products",
            "description" => "required|string",
            "price" => "required|numeric",
            "stock" => "required|numeric",
            "weight" => "required|numeric",
            "category_id" => "required|exists:categories,id",
            'thumbnails' => 'required|array',
            'thumbnails.*' => 'image|mimes:png,jpg,jpeg',
        ];
    }
}

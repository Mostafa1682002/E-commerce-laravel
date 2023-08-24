<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "category_name" => "required|unique:categories,category_name,$this->id",
            "category_description" => "string"
        ];
    }

    public function messages()
    {
        return [
            "category_name.required" => "اسم القسم مطلوب",
            "category_name.unique" => "اسم القسم موجود مسبقا",
        ];
    }
}

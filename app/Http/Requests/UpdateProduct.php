<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
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
            "product_name" => "required|unique:products,product_name,$this->id",
            "categorie_id" => "required|exists:categories,id",
            "price" => "required|numeric",
            "image" => "mimes:png,jpg,jpeg",
            "discount" => "numeric|max:100",
        ];
    }


    public function messages()
    {
        return  [
            "product_name.required" => "اسم المنتج مطلوب",
            "product_name.unique" => "اسم المنتج موجود مسبقا",
            "categorie_id.required" => "القسم مطلوب",
            "categorie_id.exists" => "القسم غير صالح",
            "price.required" => "السعر مطلوب",
            "price.numeric" => "يرجي ادخال السعر بالارقام فقط",
            "discount.numeric" => "يرجي ادخال التخفيض بالارقام فقط",
            "discount.max" => "التخفيض لابد ان يكون اقل من 100",
            "image.mimes" => "يجب ان تكون الصوره  من النوع : png,jpg,jpegفقط"
        ];
    }
}
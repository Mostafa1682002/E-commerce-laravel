<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            "List_products.*.product_name" => "required|unique:products,product_name,$this->id",
            "List_products.*.categorie_id" => "required|exists:categories,id",
            "List_products.*.price" => "required|numeric",
            "List_products.*.discount" => "numeric|max:100",
            "List_products.*.image" => "required|mimes:png,jpg,jpeg"
        ];
    }
    public function messages()
    {
        return [
            "List_products.*.product_name.required" => "اسم المنتج مطلوب",
            "List_products.*.product_name.unique" => "اسم المنتج موجود مسبقا",
            "List_products.*.categorie_id.required" => "القسم مطلوب",
            "List_products.*.categorie_id.exists" => "القسم غير صالح",
            "List_products.*.price.required" => "السعر مطلوب",
            "List_products.*.price.numeric" => "يرجي ادخال السعر بالارقام فقط",
            "List_products.*.discount.numeric" => "يرجي ادخال التخفيض بالارقام فقط",
            "List_products.*.discount.max" => "التخفيض لابد ان يكون اقل من 100",
            "List_products.*.image.required" => "صوره المنتج مطلوبه",
            "List_products.*.image.mimes" => "يجب ان تكون الصوره  من النوع : png,jpg,jpegفقط"
        ];
    }
}
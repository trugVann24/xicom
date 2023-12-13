<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules =  [
            'name' => ['required', 'string'],
            'quantity' => ['required'],
            'image' => ['required'],
            'slug' => ['required', 'string'],
            'description' => ['required', 'string'],

        ];
        if ($this->isMethod('post')) {
            $rules['name'][] = 'unique:products';
        } elseif ($this->isMethod('put')) {
            $rules['name'][] = Rule::unique('products')->ignore($this->route('product'));
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'name.string' => 'Tên sản phẩm phải là chuỗi',
            'quantity.required' => 'Số lượng sản phẩm không được để trống',
            'image.required' => 'Hình ảnh sản phẩm không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'description.string' => 'Mô tả phải là chuỗi',
            'slug.required' => 'Slug không được để trống',
            'slug.string' => 'Slug phải là chuỗi',
        ];
    }
}

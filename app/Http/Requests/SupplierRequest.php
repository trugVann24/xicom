<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'address' => ['required', 'string'],
            'phone' => ['required',  'max:11'],

        ];
        if ($this->isMethod('post')) {
            $rules['name'][] = 'unique:suppliers';
        } elseif ($this->isMethod('put')) {
            $rules['name'][] = Rule::unique('suppliers')->ignore($this->route('supplier'));
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên nhà cung cấp không được để trống',
            'name.string' => 'Tên nhà cung cấp phải là chuỗi',
            'name.unique' => 'Tên nhà cung cấp đã tồn tại',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Chưa đúng định dạng email',
            'address.required' => 'Địa chỉ không được để trống',
            'address.string' => 'Địa chỉ phải là chuỗi',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.max' => 'Số điện thoại tối đa 11 số',
        ];
    }
}

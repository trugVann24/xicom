<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WarrantyRequest extends FormRequest
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
            'warranty_period' => ['string', 'required'],
            'warranty_description' => ['string', 'required'],

        ];
        if ($this->isMethod('post')) {
            $rules['warranty_period'][] = 'unique:warranties';
        } elseif ($this->isMethod('put')) {
            $rules['warranty_period'][] = Rule::unique('warranties')->ignore($this->route('warranties'));
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'warranty_period.required' => 'Thời gian bảo hành không được để trống',
            'warranty_period.unique' => 'Thời gian bảo hành đã tồn tại',
            'warranty_description.required' => 'Chi tiết bảo hành không được để trống',
            'warranty_period.string' => 'Thời gian bảo hành phải là chuỗi',
            'warranty_description.string' => 'Chi tiết bảo hành phải là chuỗi',
        ];
    }
}

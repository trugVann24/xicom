<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePermissionRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('permissions', 'name')->ignore($this->permission)]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên permission không được để trống',
            'name.string' => 'Tên permission là một chuỗi',
            'name.max' => 'Tên permission tối đa 100 ký tự',
            'name.unique' => 'Tên permission đã tồn tại',
        ];
    }
}

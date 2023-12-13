<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CreateRoleRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:30', Rule::unique('roles', 'name')->ignore($this->role)],
            'permissions' => ['sometimes', 'array']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên role không được để trống',
            'name.string' => 'Tên role là một chuỗi',
            'name.max' => 'Tên role tối đa 30 ký tự',
            'name.unique' => 'Tên role đã tồn tại',
        ];
    }
}

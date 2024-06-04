<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'f_name' => 'nullable',
            'l_name' => 'nullable',
            'company_name' => 'nullable',
            'phone' => 'nullable|min:10|max:10',
            'display_name' => 'nullable',
            'state_id' => [Rule::exists('states', 'id')->where('is_active', true), 'nullable'],
            'address' => 'nullable',
            'zip_code' => 'nullable',
            'image' => 'nullable|image',
        ];
    }
}

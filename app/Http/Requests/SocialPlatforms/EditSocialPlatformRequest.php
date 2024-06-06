<?php

namespace App\Http\Requests\SocialPlatforms;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditSocialPlatformRequest extends FormRequest
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
            'SocialPlatformId' => [Rule::exists('socials', 'id')->whereNull('deleted_at'), 'required'],
            'name' => ['string', 'required'],
            'icon' => 'nullable|mimes:ico,jpg',
            
        ];
    }
}

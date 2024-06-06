<?php

namespace App\Http\Requests\SocialPlatforms;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditSocialLinkRequest extends FormRequest
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
            'SocialLinkId' => [Rule::exists('social_linkes', 'id')->whereNull('deleted_at'), 'required'],
            'link' => ['url', 'required'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStoryBookRequest extends FormRequest
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
            'title' => 'string',
            'categories' => 'string',
            'playable_url' => 'url',
            'subscription_type' => [Rule::in(['free', 'paid'])],
            'cover_image' => 'image|mimes:jpeg,jpg,png'
        ];
    }
}

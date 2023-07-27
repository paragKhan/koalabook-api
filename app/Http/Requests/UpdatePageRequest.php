<?php

namespace App\Http\Requests;

use App\Rules\ValidateJsonPageText;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
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
            'text' => 'string',
            'audio_id' => 'string',
            'image' => 'image|mimes:jpeg,jpg,png'
        ];
    }
}

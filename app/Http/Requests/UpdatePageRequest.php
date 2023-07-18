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
            'audio_url' => 'url|exclude',
            'image' => 'image|mimes:jpeg,jpg,png'
        ];
    }

    public function validated($key = null, $default = null)
    {
        if($this->has('audio_url')){
            preg_match('/\d+/', $this->audio_url, $matches);
            $audio_id = $matches[0];

            return array_merge(parent::validated(), ['audio_id' => $audio_id]);
        }

        return parent::validated();
    }
}

<?php

namespace App\Http\Requests;

use App\Rules\ValidateJsonPageText;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePageRequest extends FormRequest
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
            'model_type' => ['required', 'exclude', Rule::in(['story-book', 'listening-book'])],
            'model_id' => ['required', 'exclude',
                $this->model_type == 'story-book'
                    ? Rule::exists('story_books', 'id')
                    : Rule::exists('listening_books', 'id')
            ],
            'text' => 'required|string',
            'audio_url' => 'required|url|exclude',
            'image' => 'required|image|mimes:jpeg,jpg,png'
        ];
    }

    public function validated($key = null, $default = null)
    {
        preg_match('/\d+/', $this->audio_url, $matches);
        $audio_id = $matches[0];

        return array_merge(parent::validated(), ['audio_id' => $audio_id]);
    }
}

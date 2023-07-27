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
            'audio_id' => 'required|string',
            'image' => 'required|image|mimes:jpeg,jpg,png'
        ];
    }
}

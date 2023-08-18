<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'fname' => 'required|string|min:3|max:50',
            'lname' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50',
            'address' => 'required|string|min:3|max:100',
            'zip' => 'required|string|min:3|max:10',
            'country' => ['required', 'string', Rule::in(['Deutschland', 'Österreich', 'Schweiz'])]
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated();

        $validated['password'] = Hash::make($validated['password']);

        return $validated;
    }
}

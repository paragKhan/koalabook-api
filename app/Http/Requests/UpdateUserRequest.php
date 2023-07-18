<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateUserRequest extends FormRequest
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
            'name' => 'string|min:3|max:50',
            'email' => 'email|unique:users,email,' . $this->user->id,
            'password' => 'string|min:6|max:50'
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated();

        if ($this->has('password'))
            $data['password'] = Hash::make($data['password']);

        return $data;
    }
}

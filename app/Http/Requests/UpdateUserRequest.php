<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
            'fname' => 'required|string|min:3|max:50',
            'lname' => 'required|string|min:3|max:50',
            'email' => 'email|unique:users,email,' . $this->user->id,
            'password' => 'string|min:6|max:50',
            'address' => 'string|min:3|max:100',
            'zip' => 'string|min:3|max:10',
            'country' => ['string', Rule::in(['Deutschland', 'Österreich', 'Schweiz'])]
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

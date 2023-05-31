<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }

    function messages()
    {
        return [
            'username.required' => 'Username tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
        ];
    }

    public function authenticate()
    {
        if (!Auth::attempt($this->only('username', 'password'), $this->boolean('remember'))) {
            throw ValidationException::withMessages([
                // 'username' => trans('auth.failed'),
                'username' => 'Username dan Password tidak terdaftar!',
            ]);
        }
    }
}

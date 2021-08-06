<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => ['required', 'password:web'],
            'password' => ['required', 'string', 'min:8', 'confirmed',
                function ($attribute, $value, $fail) {
                    if (Hash::check($value, Auth::user()->getAuthPassword())) {
                        $fail('新パスワードが旧パスワードと同じです。違うパスワードを設定してください。');
                    }
                }],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'old_password' => '旧パスワード',
            'password' => '新パスワード',
            'password_confirmation' => 'パスワード確認用',
        ];
    }
}

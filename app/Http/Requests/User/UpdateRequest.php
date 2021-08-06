<?php

namespace App\Http\Requests\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
    public function rules(Request $request)
    {
        // dd(Auth::user()->email);
        // dd($request->email);
        if(Auth::user()->email == $request->email) {
            return [
                'img'     => ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
                'name'    => ['required', 'string', 'max:255'],
                'profile' => ['nullable', 'string', 'max:1000'],
            ];
        } else {
            return [
                'img'     => ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
                'name'    => ['required', 'string', 'max:255'],
                'email'   => ['required', 'string', 'max:255', 'unique:users'],
                'profile' => ['nullable', 'string', 'max:1000'],
            ];
        }

    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'img'     => 'プロフィール画像',
            'name'    => '名前',
            'email'   => 'メールアドレス',
            'profile' => 'プロフィール',
        ];
    }
}

<?php

namespace App\Http\Requests\Api\Manage;

use App\Http\Requests\Api\AbstractApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends AbstractApiFormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'email' =>['required', 'string', 'max:255', 'email', Rule::unique('App\Models\Manage')->ignore($this->id)],
            'password' => ['required', 'string', 'regex:/^[!-~]+$/', 'min:6'],
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
            'name' => '管理者名',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
}

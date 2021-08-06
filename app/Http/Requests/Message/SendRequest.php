<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class SendRequest extends FormRequest
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
            'message_detail' => ['required', 'string', 'max:255'],
            'message_file' => ['nullable', 'array', 'max:3'],
            'message_file.*' => ['nullable', 'file', 'mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,image/png,image/jpeg,image/gif', 'max:2048'],
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
            'message_detail' => 'メッセージ',
            'message_file' => '添付ファイル',
            'message_file.0' => '添付ファイル１',
            'message_file.1' => '添付ファイル２',
            'message_file.2' => '添付ファイル３',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'message_file.max' => '添付ファイルは最大３つまで送信できます。',
            'message_file.0.max' => '添付ファイル１のサイズが大きすぎます。',
            'message_file.1.max' => '添付ファイル２のサイズが大きすぎます。',
            'message_file.2.max' => '添付ファイル３のサイズが大きすぎます。',
        ];
    }
}

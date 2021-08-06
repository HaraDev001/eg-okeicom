<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        if(is_null($request->img)) {
            return [
                'email'     => 'required|email|max:255',
                'name'      => 'required|max:255',
                'class'     => 'required|integer',
                'subject'   => 'required|integer',
                'detail'    => 'required|max:1000',
                'captcha'   => 'required|captcha'
            ];
        } else {
            return [
                'email'     => 'required|email|max:255',
                'name'      => 'required|max:255',
                'class'     => 'required|integer',
                'subject'   => 'required|integer',
                'img'       => 'image',
                'detail'    => 'required|max:1000',
                'captcha'   => 'required|captcha'
            ];
        }

    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    // public function attributes() {
    //     return [
    //         'email' => 'メールアドレス',
    //         'name' => 'お名前／表示名',
    //         'class' => '区分',
    //         'subject' => '件名',
    //         'img' => '画像',
    //         'detail' => '内容',
    //         'captcha' => 'キャプチャ',
    //     ];
    // }
    public function messages()
    {
        return [
            'email.required'     => 'メールアドレスは必須です。',
            'email.email'        => 'メールアドレスを正しく入力してください。',
            'email.max'          => 'メールアドレスは255文字以内です。',
            'name.required'      => 'お名前／表示名は必須です。',
            'name.max'           => 'お名前／表示名は255文字以内です。',
            'class.required'     => '区分は必須です。',
            'class.integer'      => '区分を正しく入力してください。',
            'subject.required'   => '件名は必須です。',
            'subject.integer'    => '件名を正しく入力してください。',
            'img.image'          => '画像は jpg、jpeg、png、bmp、gif、svg、webp のみです。',
            'detail.required'    => '内容は必須です。',
            'detail.max'         => '内容は1000文字以内です。',
            'captcha.required'   => '入力は必須です。',
            'captcha.captcha'    => '画像に表示されている文字を入力してください。',
        ];
    }
}

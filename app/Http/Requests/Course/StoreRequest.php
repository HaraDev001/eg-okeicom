<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'img1'       => ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png', 'max:3072'],
            'img2'       => ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png', 'max:3072'],
            'img3'       => ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png', 'max:3072'],
            'img4'       => ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png', 'max:3072'],
            'img5'       => ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png', 'max:3072'],
            'categories' => ['required', 'array', 'max:5'],
            'title'      => ['required', 'string', 'max:255'],
            'detail'     => ['nullable', 'string', 'max:1000'],
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
            'img1' => '画像１',
            'img2' => '画像２',
            'img3' => '画像３',
            'img4' => '画像４',
            'img5' => '画像５',
            'categories' => 'カテゴリー',
            'title' => 'タイトル',
            'detail' => '詳細',
        ];
    }
}

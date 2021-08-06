<?php

namespace App\Http\Requests\Lesson;

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
            'courses_id' => ['required', 'numeric'],
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'start' => ['required', 'date_format:H:i'],
            'finish' => ['required', 'date_format:H:i', 'after:start'],
            'detail' =>['nullable', 'string', 'max:1000'],
            'price' =>['required', 'numeric', 'between:0,500000'],
            'cancel_rate' =>['required', 'numeric', 'between:0,100'],
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
            'courses_id' => 'コースID',
            'title' => 'タイトル',
            'type' => '放送タイプ',
            'date' => '日付',
            'start' => '開始時間',
            'finish' => '終了時間',
            'detail' => '詳細',
            'price' => '金額',
            'cancel_rate' => 'キャンセル手数料率',
        ];
    }
}

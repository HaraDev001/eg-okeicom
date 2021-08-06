<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class AbstractApiFormRequest
 * @package App\Http\Requests\Api
 */
abstract class AbstractApiFormRequest extends FormRequest
{
    /**
     * [override] バリデーション失敗時ハンドリング
     *
     * @param Validator $validator
     * @throw HttpResponseException
     * @see FormRequest::failedValidation()
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                "response" => "error",
                "message" => 'エラーが発生しました。',
                "data" => null,
                "errors" => $validator->errors()
            ])
        );
    }
}

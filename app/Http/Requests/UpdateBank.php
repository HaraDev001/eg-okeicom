<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBank extends FormRequest
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
        if($request->input('yucho_name')) {
            return [
                'yucho_mark'     => 'required|numeric',
                'yucho_number'   => 'required|numeric',
                'yucho_name'     => 'required|max:255',
            ];
        } else {
            return [
                'other_financial_name' => 'required|max:255',
                'other_branch_name'    => 'required|max:255',
                'other_branch_number'  => 'required|numeric',
                'other_type'           => 'required',
                'other_number'         => 'required|numeric',
                'other_name'           => 'required|max:255',
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
            // 口座番号
            'yucho_mark'     => '口座記号',
            'yucho_number'   => '口座番号',
            'yucho_name'     => '口座名義人',

            // その他銀行
            'other_financial_name' => '金融機関名',
            'other_branch_name'    => '支店名',
            'other_branch_number'  => '支店番号',
            'other_type'           => '口座種別',
            'other_number'         => '口座番号',
            'other_name'           => '口座名義人',
        ];
    }
}

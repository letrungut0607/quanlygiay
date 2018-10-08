<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemTienVonRequest extends FormRequest
{
    public function authorize()
    {
        return kiemtra_admin();
    }

    public function rules()
    {
        return [
            'ngaythem' => 'required',
            'sotien' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ngaythem.required' => 'Vui lòng nhập ngày thêm',
            'sotien.required' => 'Vui lòng nhập số tiền vốn'
        ];
    }
}

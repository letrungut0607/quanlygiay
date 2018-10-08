<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemRutTienRequest extends FormRequest
{
    public function authorize()
    {
        return kiemtra_admin();
    }

    public function rules()
    {
        return [
            'ngayrut' => 'required',
            'sotien' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'ngayrut.required' => 'Vui lòng nhập ngày rút',
            'sotien.required' => 'Vui lòng nhập số tiền rút'
        ];
    }
}

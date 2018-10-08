<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuaNhaPhanPhoiRequest extends FormRequest
{
    public function authorize()
    {
        return kiemtra_admin();
    }

    public function rules()
    {
        return [
            'tennhaphanphoi' => 'required',
            'tinh' => 'required|min:3',
            'huyen' => 'required|min:3',
            'sodienthoai' => 'regex:/^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$/'
        ];
    }

    public function messages()
    {
        return [
            'tennhaphanphoi.required' => 'Vui lòng nhập tên nhà phân phối',
            'tinh.required' => 'Vui lòng nhập tỉnh cho nhà phân phối',
            'tinh.min' => 'Vui lòng nhập tỉnh từ 3 ký tự',
            'huyen.required' => 'Vui lòng nhập huyện cho nhà phân phối',
            'huyen.min' => 'Vui lòng nhập huyện từ 3 ký tự',
            'sodienthoai.regex' => 'Số điện thoại không hợp lệ'
        ];
    }
}

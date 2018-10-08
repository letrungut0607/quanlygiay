<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuaNhanVienSanXuatRequest extends FormRequest
{
    public function authorize()
    {
        return kiemtra_admin();
    }

    public function rules()
    {
        return [
            'sanpham_id' => 'required|exists:sanpham,id',
            'dongia' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'sanpham_id.required' => 'Vui lòng chọn sản phẩm',
            'sanpham_id.exists' => 'Vui lòng chọn sản phẩm',
            'dongia.required' => 'Vui lòng nhập đơn giá'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemNhanVienSanXuatRequest extends FormRequest
{
    public function authorize()
    {
        return kiemtra_admin();
    }

    public function rules()
    {
        return [
            'nhanvien_id' => 'required|exists:nhanvien,id',
            'sanpham_id' => 'required|exists:sanpham,id',
            'dongia' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nhanvien_id.required' => 'Vui lòng chọn nhân viên',
            'nhanvien_id.exists' => 'Vui lòng chọn nhân viên',
            'sanpham_id.required' => 'Vui lòng chọn sản phẩm',
            'sanpham_id.exists' => 'Vui lòng chọn sản phẩm',
            'dongia.required' => 'Vui lòng nhập đơn giá'
        ];
    }
}

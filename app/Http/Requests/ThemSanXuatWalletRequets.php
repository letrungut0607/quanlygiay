<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemSanXuatWalletRequets extends FormRequest
{
    public function authorize()
    {
        return kiemtra_admin();
    }

    public function rules()
    {
        return [
           'nguyenlieu_id' => 'required|exists:nguyenlieu,id',
           'nhanvien_id' => 'required|exists:nhanvien,id',
           'sanpham_id' => 'required|exists:sanpham,id',
           'sodaysanxuat' => 'required',
           'sokg' => 'required|numeric',
           'sogoisanxuatduoc' => 'required|not_in:0'
        ];
    }

    public function messages()
    {
        return [
            'nguyenlieu_id.required' => 'Vui lòng chọn nguyên liệu',
            'nguyenlieu_id.exists' => 'Vui lòng chọn nguyên liệu',
            'nhanvien_id.required' => 'Vui lòng chọn nhân viên',
            'nhanvien_id.exists' => 'Vui lòng chọn nhân viên',
            'sanpham_id.required' => 'Vui lòng chọn sản phẩm',
            'sodaysanxuat.required' => 'Vui lòng nhập số dãy sản xuất',
            'sanpham_id.exists' => 'Vui lòng chọn sản phẩm',
            'sokg.required' => 'Vui lòng nhập số kg phôi sản xuất',
            'sokg.numeric' => 'Vui lòng nhập số kg phôi sản xuất là số',
        ];
    }
}

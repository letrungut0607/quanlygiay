<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemSanXuatNapKinRequets extends FormRequest
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
           'soluongto' => 'required',
           'soluongtrenmaydem' => 'required',
           'soluongthanhpham' => 'required',
           'soluongthuctethung' => 'required',
           'sokg' => 'required|numeric',
           'sogoiconlai' => 'required',
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
            'sanpham_id.exists' => 'Vui lòng chọn sản phẩm',
            'soluongto.required' => 'Vui lòng nhập số lượng tờ',
            'soluongtrenmaydem.required' => 'Vui lòng nhập số lượng trên máy đếm',
            'soluongthanhpham.required' => 'Vui lòng nhập số số thùng / số gói',
            'soluongthuctethung.required' => 'Vui lòng nhập số lượng thức tế(Thùng)',
            'sokg.required' => 'Vui lòng nhập số kg phôi sản xuất',
            'sokg.numeric' => 'Vui lòng nhập số kg phôi sản xuất là số',
            'sogoiconlai.required' => 'Vui lòng nhập số gói còn lại',
        ];
    }
}

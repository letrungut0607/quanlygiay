<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuaSanPhamRequest extends FormRequest
{
    public function authorize()
    {
        return kiemtra_admin();
    }

    public function rules()
    {
        return [
           'loaisanpham_id' => 'required|exists:loaisanpham,id',
           'tensanpham' => 'required',
           'giasanpham' => 'required|not_in:0',
           'sogoitrenthung' => 'required|not_in:0',
           'sototrengoi' => 'required|not_in:0'
        ];
    }

    public function messages()
    {
        return [
            'loaisanpham_id.required' => 'Vui lòng chọn loại sản phẩm',
            'loaisanpham_id.exists' => 'Vui lòng chọn loại sản phẩm',
            'tensanpham.required' => 'Vui lòng nhập tên sản phẩm',
            'giasanpham.required' => 'Vui lòng nhập giá sản phẩm',
            'giasanpham.not_in' => 'Vui lòng nhập giá sản phẩm lớn hơn 0',
            'sogoitrenthung.required' => 'Vui lòng nhập số gói / thùng',
            'sogoitrenthung.not_in' => 'Vui lòng nhập số gói / thùng lớn hơn 0',
            'sototrengoi.required' => 'Vui lòng nhập số tờ / gói',
            'sototrengoi.not_in' => 'Vui lòng nhập số tờ / gói lớn hơn 0',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuaNguyenLieuRequest extends FormRequest
{
    public function authorize()
    {
        return kiemtra_admin();
    }

    public function rules()
    {
        return [
            'manguyenlieu' => 'required|unique:nguyenlieu,manguyenlieu,' . $this->id,
            'tennguyenlieu' => 'required',
            'donvitinh' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'manguyenlieu.required' => 'Vui lòng nhập mã nguyên liệu',
            'manguyenlieu.unique' => 'Mã nguyên liệu này đã tồn tại',
            'tennguyenlieu.required' => 'Vui lòng nhập tên nguyên liệu',
            'donvitinh.required' => 'Vui lòng nhập đơn vị tính'
        ];
    }
}

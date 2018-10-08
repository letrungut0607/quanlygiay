<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuaNhanVienRequest extends FormRequest
{
    public function authorize()
    {
        return kiemtra_admin();
    }

    public function rules()
    {
        return [
            'manhanvien' => 'required|unique:nhanvien,manhanvien,' . $this->id,
            'tennhanvien' => 'required|min:3',
            'taikhoan' => 'required|min:3|unique:nhanvien,taikhoan,' . $this->id,
            'password' => 'min:5',
            'repassword' => 'same:password',
            'phanquyen' => 'required|in:0,1'
        ];
    }

    public function messages()
    {
        return [
            'manhanvien.required' => 'Vui lòng nhập mã nhân viên',
            'manhanvien.unique' => 'Mã nhân viên này đã tồn tại',
            'tennhanvien.required' => 'Vui lòng nhập tên nhân viên',
            'tennhanvien.min' => 'Vui lòng nhập tên nhân viên từ 3 ký tự',
            'taikhoan.required' => 'Vui lòng nhập tài khoản đăng nhập',
            'taikhoan.min' => 'Vui lòng nhập tài khoản đăng nhập từ 3 ký tự',
            'taikhoan.unique' => 'Tài khoản đăng nhập này đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu nhân viên',
            'password.min' => 'Vui lòng nhập mật khẩu từ 5 ký tự',
            'repassword.same' => 'Mật khẩu nhập lại không khớp',
            'phanquyen.required' => 'Vui lòng chọn quyền cho nhân viên',
            'phanquyen.in' => 'Vui lòng chọn quyền cho nhân viên'
        ];
    }
}

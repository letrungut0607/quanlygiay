<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ThemNhapKhoRequest extends FormRequest
{

   public function authorize()
   {
      return kiemtra_admin();
   }
   
   public function rules()
   {
      $rules = [];
      $rules['soluongnhap'] = 'required';
      $rules['manhapkho'] = 'required|unique:nhapkho,manhapkho';

      if($this->request->get('soluongnhap'))
      {
        foreach($this->request->get('soluongnhap') as $key => $val)
        {
           $rules['soluongnhap.'.$key] = 'required';
           if($val <= 0)
              $rules['soluongnhap.'.$key] = 'not_in:0';  
        }

        foreach($this->request->get('gianhap') as $key => $val)
        {
           $rules['gianhap.'.$key] = 'required';
           if($val <= 0)
              $rules['gianhap.'.$key] = 'not_in:0';  
        }

        foreach($this->request->get('nguyenlieu_id') as $key => $val)
        {
          $rules['nguyenlieu_id.'.$key] = 'exists:nguyenlieu,id';
        }

      }
      return $rules;
   }


   public function messages()
   {
      $messages = [];

      $messages['soluongnhap.required'] = 'Bạn chưa chọn nguyên liệu nào để nhập hàng';

      $messages['manhapkho.required'] = 'Vui lòng nhập mã nhập kho';

      $messages['soluongnhap.unique'] = 'Mã nhập kho đã tồn tại';

      if($this->request->get('soluongnhap'))
      {
        $list_tennguyenlieu = $this->request->get('tennguyenlieu');

        foreach($this->request->get('soluongnhap') as $key => $val)
        {
           $messages['soluongnhap.'.$key.'.required'] = 'Vui lòng nhập số lượng của nguyên liệu '.($list_tennguyenlieu[$key]);
           $messages['soluongnhap.'.$key.'.not_in'] = 'Số lượng nhập của nguyên liệu '.($list_tennguyenlieu[$key]). ' phải lớn hơn 0';
        }

        foreach($this->request->get('gianhap') as $key => $val)
        {
           $messages['gianhap.'.$key.'.required'] = 'Vui lòng nhập số lượng của nguyên liệu '.($list_tennguyenlieu[$key]);
           $messages['gianhap.'.$key.'.not_in'] = 'Giá nhập của nguyên liệu '.($list_tennguyenlieu[$key]). ' phải lớn hơn 0';
        }

        foreach($this->request->get('nguyenlieu_id') as $key => $val)
        {
           $messages['nguyenlieu_id.'.$key.'.exists'] = 'Vui lòng chọn nguyên liệu ';
        }
      }
      
      return $messages;
   }
}

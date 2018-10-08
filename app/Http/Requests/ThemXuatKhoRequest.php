<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ThemXuatKhoRequest extends FormRequest
{

   public function authorize()
   {
      return kiemtra_admin();
   }
   
   public function rules()
   {
      $rules = [];
      $rules['soluongxuat'] = 'required';
      $rules['giaxuat'] = 'required';
      $rules['sanpham_id'] = 'required';

      $rules['nhaphanphoi_id'] = 'required|exists:nhaphanphoi,id';
      $rules['maxuatkho'] = 'required|unique:xuatkho,maxuatkho';

      if($this->request->get('soluongxuat'))
      {
        foreach($this->request->get('soluongxuat') as $key => $val)
        {
           $rules['soluongxuat.'.$key] = 'required';
           if($val <= 0)
              $rules['soluongxuat.'.$key] = 'not_in:0';  
        }

        foreach($this->request->get('giaxuat') as $key => $val)
        {
           $rules['giaxuat.'.$key] = 'required';
           if($val <= 0)
              $rules['giaxuat.'.$key] = 'not_in:0';  
        }

        foreach($this->request->get('sanpham_id') as $key => $val)
        {
          $rules['sanpham_id.'.$key] = 'exists:sanpham,id';
        }

      }
      return $rules;
   }


   public function messages()
   {
      $messages = [];

      $messages['soluongxuat.required'] = 'Bạn chưa chọn sản phẩm nào để xuất kho';
      $messages['giaxuat.required'] = 'Bạn chưa chọn sản phẩm nào để xuất kho';
      $messages['sanpham_id.required'] = 'Bạn chưa chọn sản phẩm nào để xuất kho';

      $messages['maxuatkho.required'] = 'Vui lòng nhập mã xuất kho';

      $messages['maxuatkho.unique'] = 'Mã xuất kho đã tồn tại';

      $messages['nhaphanphoi_id.required'] = 'Vui lòng chọn nhà phân phối sản phẩm';
     $messages['nhaphanphoi_id.exists'] = 'Vui lòng chọn nhà phân phối sản phẩm';

      if($this->request->get('soluongxuat'))
      {
        $list_tensanpham = $this->request->get('tensanpham');

        foreach($this->request->get('soluongxuat') as $key => $val)
        {
           $messages['soluongxuat.'.$key.'.required'] = 'Vui lòng nhập số lượng số lượng thùng '.($list_tensanpham[$key]);
           $messages['soluongxuat.'.$key.'.not_in'] = 'Số lượng nhập số lượng thùng '.($list_tensanpham[$key]). ' phải lớn hơn 0';
        }

        foreach($this->request->get('giaxuat') as $key => $val)
        {
           $messages['giaxuat.'.$key.'.required'] = 'Vui lòng nhập giá xuất của sản phẩm '.($list_tensanpham[$key]);
           $messages['giaxuat.'.$key.'.not_in'] = 'Giá xuất của sản phẩm '.($list_tensanpham[$key]). ' phải lớn hơn 0';
        }

        foreach($this->request->get('sanpham_id') as $key => $val)
        {
           $messages['sanpham_id.'.$key.'.exists'] = 'Vui lòng chọn sản phẩm ';
        }
      }
      
      return $messages;
   }
}

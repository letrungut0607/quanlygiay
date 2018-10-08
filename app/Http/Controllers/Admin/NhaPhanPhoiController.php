<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ThemNhaPhanPhoiRequest;
use App\Http\Requests\SuaNhaPhanPhoiRequest;
use App\Models\Nhaphanphoi;

class NhaPhanPhoiController extends Controller
{
	public function getIndex()
	{
		$data = [
			'all_nhaphanphoi' => Nhaphanphoi::all()
		];

		return view('admin.nhaphanphoi.index', $data);
	}

   public function getThem()
   {
   	return view('admin.nhaphanphoi.them');
   }

   public function postThem(ThemNhaPhanPhoiRequest $request)
   {
   	$nhaphanphoi = new Nhaphanphoi;
      $nhaphanphoi->tinh = $request->tinh;
      $nhaphanphoi->huyen = $request->huyen;

      $diadiem = $request->tinh . ' ' . $request->huyen;

      $diadiem_slug = str_slug($diadiem);

      $array_slug_diadiem = explode('-', $diadiem_slug);
      $manhaphanphoi_viettat = 'NPP_';
      foreach ($array_slug_diadiem as $value) {
         $manhaphanphoi_viettat .= ucfirst($value[0]) . '_';
      }

      $nhaphanphoi->manhaphanphoi = rtrim($manhaphanphoi_viettat, '_');
   	$nhaphanphoi->tennhaphanphoi = $request->tennhaphanphoi;
      $nhaphanphoi->diachi = $request->diachi;
      $nhaphanphoi->sodienthoai = $request->sodienthoai;
      $nhaphanphoi->ghichu = $request->ghichu;
   	$nhaphanphoi->congno = 0;
   	$nhaphanphoi->save();

      $nhaphanphoi->manhaphanphoi = ($nhaphanphoi->manhaphanphoi.'_'.$nhaphanphoi->id);
      $nhaphanphoi->save();

   	return redirect()->route('nhaphanphoi.them')
	   	->with('thongbao', 'Thêm nhà phân phối thành công');
   }

   public function getSua($id)
   {
      $nhaphanphoi = Nhaphanphoi::findOrFail($id);
      $data = [
         'nhaphanphoi' => $nhaphanphoi
      ];

      return view('admin.nhaphanphoi.sua', $data);
   }

   public function postSua($id, SuaNhaPhanPhoiRequest $request)
   {
      $nhaphanphoi = Nhaphanphoi::findOrFail($id);

      if($request->has('congno'))
      {
         $congno = str_replace(',', '', $request->congno);
         if(!is_numeric($congno) || $congno < 0)
         {
            return redirect()->back()
               ->with('thongbao', 'Lỗi nhập dữ liệu vui lòng nhập lại')
               ->with('danger', 'true')
               ->withInput();
         }

         $nhaphanphoi->congno = $congno;
      }

      $nhaphanphoi = new Nhaphanphoi;
      $nhaphanphoi->tinh = $request->tinh;
      $nhaphanphoi->huyen = $request->huyen;

      $diadiem = $request->tinh . ' ' . $request->huyen;

      $diadiem_slug = str_slug($diadiem);

      $array_slug_diadiem = explode('-', $diadiem_slug);
      $manhaphanphoi_viettat = 'NPP_';
      foreach ($array_slug_diadiem as $value) {
         $manhaphanphoi_viettat .= ucfirst($value[0]) . '_';
      }

      $nhaphanphoi->manhaphanphoi = rtrim($manhaphanphoi_viettat, '_');
      $nhaphanphoi->tennhaphanphoi = $request->tennhaphanphoi;
      $nhaphanphoi->diachi = $request->diachi;
      $nhaphanphoi->sodienthoai = $request->sodienthoai;
      $nhaphanphoi->ghichu = $request->ghichu;
      
      $nhaphanphoi->save();

      $nhaphanphoi->manhaphanphoi = ($nhaphanphoi->manhaphanphoi.'_'.$nhaphanphoi->id);
      $nhaphanphoi->save();

      return redirect()->route('nhaphanphoi.index')
         ->with('thongbao', 'Chỉnh sửa nhà phân phối thành công');
   }
}

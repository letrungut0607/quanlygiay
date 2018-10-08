<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nhanviensanxuat;
use App\Models\Nhanvien;
use App\Models\Sanpham;
use App\Http\Requests\ThemNhanVienSanXuatRequest;
use App\Http\Requests\SuaNhanVienSanXuatRequest;

class NhanVienSanXuatController extends Controller
{
   public function getIndex()
	{
		$data = [
			'all_nhanviensanxuat' => Nhanviensanxuat::all()
		];

		return view('admin.nhanviensanxuat.index', $data);
	}

   public function getThem()
   {
      $data = [
         'all_nhanvien' => Nhanvien::all(),
         'all_sanpham' => Sanpham::all()
      ];

   	return view('admin.nhanviensanxuat.them', $data);
   }

   public function postThem(ThemNhanVienSanXuatRequest $request)
   {
      $dongia = str_replace(',', '', $request->dongia);
      if(!is_numeric($dongia) || $dongia <= 0)
      {
         return redirect()->back()
            ->with('thongbao', 'Lỗi nhập dữ liệu vui lòng nhập lại')
            ->with('danger', 'true')
            ->withInput();
      }

      $nhanvien_id = $request->nhanvien_id;
      $sanpham_id = $request->sanpham_id;
      $check_exist = Nhanviensanxuat::where('sanpham_id', $sanpham_id)
         ->where('nhanvien_id', $nhanvien_id)
         ->first();

      if($check_exist)
      {
         return redirect()
            ->back()
            ->with('thongbao', 'Nhân viên sản xuất với sản phẩm vừa chọn đã tồn tại')
            ->with('danger', 'true')
            ->withInput();
      }

   	$nhanviensanxuat = new Nhanviensanxuat;
   	$nhanviensanxuat->nhanvien_id = $nhanvien_id;
   	$nhanviensanxuat->sanpham_id = $sanpham_id;
      $nhanviensanxuat->dongia = $dongia;
   	$nhanviensanxuat->save();

   	return redirect()->route('nhanviensanxuat.them')
	   	->with('thongbao', 'Thêm nhân viên sản xuất thành công');
   }

   public function getSua($id)
   {
      $nhanviensanxuat = Nhanviensanxuat::findOrFail($id);
      $data = [
         'nhanviensanxuat' => $nhanviensanxuat,
         'all_nhanvien' => Nhanvien::all(),
         'all_sanpham' => Sanpham::all()
      ];

      return view('admin.nhanviensanxuat.sua', $data);
   }

   public function postSua($id, SuaNhanVienSanXuatRequest $request)
   {
      $nhanviensanxuat = Nhanviensanxuat::findOrFail($id);

      $dongia = str_replace(',', '', $request->dongia);
      if(!is_numeric($dongia) || $dongia <= 0)
      {
         return redirect()->back()
            ->with('thongbao', 'Lỗi nhập dữ liệu vui lòng nhập lại')
            ->with('danger', 'true')
            ->withInput();
      }

      $nhanvien_id = $nhanviensanxuat->id;
      $sanpham_id = $request->sanpham_id;
      $check_exist = Nhanviensanxuat::where('sanpham_id', $sanpham_id)
         ->where('nhanvien_id', $nhanvien_id)
         ->first();

      if($check_exist && $sanpham_id != $nhanviensanxuat->sanpham_id)
      {
         return redirect()
            ->back()
            ->with('thongbao', 'Nhân viên sản xuất với sản phẩm vừa chọn đã tồn tại')
            ->with('danger', 'true')
            ->withInput();
      }

      $nhanviensanxuat->sanpham_id = $sanpham_id;
      $nhanviensanxuat->dongia = $dongia;
      $nhanviensanxuat->save();

      return redirect()->route('nhanviensanxuat.index')
         ->with('thongbao', 'Chỉnh sửa nhân viên sản xuất thành công');
   }
}

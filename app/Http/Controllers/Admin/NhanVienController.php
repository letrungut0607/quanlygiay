<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ThemNhanVienRequest;
use App\Http\Requests\SuaNhanVienRequest;
use App\Models\Nhanvien;
use Hash;

class NhanVienController extends Controller
{
   public function getIndex()
	{
		$data = [
			'all_nhanvien' => Nhanvien::all()
		];

		return view('admin.nhanvien.index', $data);
	}

   public function getThem()
   {
   	return view('admin.nhanvien.them');
   }

   public function postThem(ThemNhanVienRequest $request)
   {
   	$nhanvien = new Nhanvien;
   	$nhanvien->manhanvien = $request->manhanvien;
   	$nhanvien->tennhanvien = $request->tennhanvien;
      $nhanvien->taikhoan = $request->taikhoan;
      $nhanvien->password = Hash::make($request->password);
      $nhanvien->phanquyen = intval($request->phanquyen);;
   	$nhanvien->save();

   	return redirect()->route('nhanvien.them')
	   	->with('thongbao', 'Thêm nhân viên thành công');
   }

   public function getSua($id)
   {
      $nhanvien = Nhanvien::findOrFail($id);

      $data = [
         'nhanvien' => $nhanvien
      ];

      return view('admin.nhanvien.sua', $data);
   }

   public function postSua($id, SuaNhanVienRequest $request)
   {
      $nhanvien = Nhanvien::findOrFail($id);
      $nhanvien->manhanvien = $request->manhanvien;
      $nhanvien->tennhanvien = $request->tennhanvien;
      $nhanvien->taikhoan = $request->taikhoan;
      if(!empty($request->password))
      {
         $nhanvien->password = Hash::make($request->password);
      }
      
      $nhanvien->phanquyen = 0;
      $nhanvien->save();

      return redirect()->route('nhanvien.index')
         ->with('thongbao', 'Chỉnh sửa nhân viên thành công');
   }
}

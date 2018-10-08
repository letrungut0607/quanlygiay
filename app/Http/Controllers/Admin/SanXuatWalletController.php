<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sanxuatwallet;
use App\Models\Nguyenlieu;
use App\Models\Sanpham;
use App\Models\Nhanviensanxuat;
use App\Models\Nhanvien;
use App\Http\Requests\ThemSanXuatWalletRequets;
use DateTime;

class SanXuatWalletController extends Controller
{
   public function getIndex()
	{
		$data = [
			'all_sanxuatwallet' => Sanxuatwallet::all()
		];

		return view('admin.sanxuatwallet.index', $data);
	}

   public function getChiTiet($id)
   {
      $nhapkho = Nhapkho::findOrFail($id);
      $data = [
         'nhapkho' => $nhapkho
      ];

      return view('admin.nhapkho.chitiet', $data);
   }

   public function getThem()
   {
   	$data = [
			'all_nguyenlieu' => Nguyenlieu::all(),
         'all_nhanvien' => Nhanvien::orderBy('id')->get(),
         'all_sanpham' => Sanpham::all()
		];

   	return view('admin.sanxuatwallet.them', $data);
   }

   public function postThem(ThemSanXuatWalletRequets $request)
   {
      $nguyenlieu_id = $request->nguyenlieu_id;
      $sokg = $request->sokg;
      $nguyenlieu = Nguyenlieu::findOrFail($nguyenlieu_id);

      if($sokg > $nguyenlieu->soluongtonkho)
      {
         return redirect()->back()
            ->with('thongbao', 'Số lượng của nguyên liệu không đủ để sản xuất')
            ->with('danger', 'true')
            ->withInput();
      }

      $sogoisanxuatduoc = intval(str_replace(',', '', $request->sogoisanxuatduoc));
      $sodaysanxuat = intval(str_replace(',', '', $request->sodaysanxuat));
      $sodaysanxuat_dachia = intval($sodaysanxuat / count($request->nhanvien_id));

      foreach ($request->nhanvien_id as $nhanvien_id) {
         $sanxuatwallet = new Sanxuatwallet;
         $sanxuatwallet->nguyenlieu_id = $nguyenlieu_id;
         $sanxuatwallet->nhanvien_id = $nhanvien_id;
         $sanxuatwallet->sanpham_id = $request->sanpham_id;
         $sanxuatwallet->sodaysanxuat = $sodaysanxuat;
         $sanxuatwallet->sodaysanxuat_dachia = $sodaysanxuat_dachia;
         $sanxuatwallet->sogoisanxuatduoc = $sogoisanxuatduoc;
         $sanxuatwallet->sokg = $sokg;
         $sanxuatwallet->ngaysanxuat = new DateTime;
         $sanxuatwallet->save();
      }
      

      $nguyenlieu->soluongtonkho = ($nguyenlieu->soluongtonkho - $sokg);
      $nguyenlieu->save();

      $sanpham = Sanpham::findOrFail($request->sanpham_id);
      $sanpham->soluong = ($sanpham->soluong + $sogoisanxuatduoc);
      $sanpham->save();

      return redirect()->route('sanxuatwallet.them')->with('thongbao', 'Thêm nhân viên sản xuất wallet thành công');
   }

   public function getSua($id)
   {}
}

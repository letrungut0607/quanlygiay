<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sanxuatnapkin;
use App\Models\Nhanvien;
use App\Models\Nhanviensanxuat;
use App\Models\Sanpham;
use App\Models\Nguyenlieu;
use App\Http\Requests\ThemSanXuatNapKinRequets;
use DateTime;

class SanXuatNapKinController extends Controller
{
   public function getIndex()
	{
		$data = [
			'all_sanxuatnapkin' => Sanxuatnapkin::all()
		];

		return view('admin.sanxuatnapkin.index', $data);
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

      return view('admin.sanxuatnapkin.them', $data);
   }

   public function postThem(ThemSanXuatNapKinRequets $request)
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

      if(! in_array($request->buoithuchien, ['1', '2', '3']))
      {
         return redirect()->back()
            ->with('thongbao', 'Nhập sai dữ liệu vui lòng nhập lại')
            ->with('danger', 'true')
            ->withInput();
      }

      $soluongthanhpham = intval(str_replace(',', '', $request->soluongthanhpham));
      $soluongthuctethung = intval(str_replace(',', '', $request->soluongthuctethung));
      $sogoiconlai = intval(str_replace(',', '', $request->sogoiconlai));
      $soluongtrenmaydem = intval(str_replace(',', '', $request->soluongtrenmaydem));
      $soluongto = intval(str_replace(',', '', $request->soluongto));

      $soluongthuctethung_dachia = intval($soluongthuctethung / count($request->nhanvien_id));


      foreach ($request->nhanvien_id as $nhanvien_id) {
         
         $sanxuatnapkin = new Sanxuatnapkin;
         $sanxuatnapkin->buoithuchien = $request->buoithuchien;
         $sanxuatnapkin->nhanvien_id = $nhanvien_id;
         $sanxuatnapkin->sanpham_id = $request->sanpham_id;
         $sanxuatnapkin->nguyenlieu_id = $nguyenlieu_id;
         $sanxuatnapkin->soluongto = $soluongto;
        
         $sanxuatnapkin->soluongtrenmaydem = ($soluongtrenmaydem * 2);
         $sanxuatnapkin->soluongthanhpham = $soluongthanhpham;
         $sanxuatnapkin->soluongthuctethung = $soluongthuctethung;
         $sanxuatnapkin->soluongthuctethung_dachia = $soluongthuctethung_dachia;
         $sanxuatnapkin->sogoiconlai = $sogoiconlai;
         $sanxuatnapkin->trongluong = ($sokg / $sanxuatnapkin->soluongtrenmaydem);
         $sokg_thanhpham = ($sanxuatnapkin->trongluong * $sanxuatnapkin->soluongthanhpham);

         $sanxuatnapkin->sokg = $sokg_thanhpham;
         $sanxuatnapkin->ngaysanxuat = dinh_dang_ngay_mysql($request->ngaysanxuat);
         $sanxuatnapkin->save();
      }

      

      $nguyenlieu->soluongtonkho = ($nguyenlieu->soluongtonkho - $sokg);

      $nguyenlieu->save();

      $sanpham = Sanpham::findOrFail($request->sanpham_id);
      $sanpham->soluong = ($sanpham->soluong + $sanxuatnapkin->soluongthanhpham);
      $sanpham->save();

      return redirect()->route('sanxuatnapkin.them')->with('thongbao', 'Thêm nhân viên sản xuất napkin thành công');
   }

   public function getSua($id)
   {}
}

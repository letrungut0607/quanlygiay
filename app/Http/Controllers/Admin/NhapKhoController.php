<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nhapkho;
use App\Models\Chitietnhapkho;
use App\Models\Nguyenlieu;
use App\Http\Requests\ThemNhapKhoRequest;
use DateTime;

class NhapKhoController extends Controller
{
   public function getIndex()
	{
		$data = [
			'all_nhapkho' => Nhapkho::all()
		];

		return view('admin.nhapkho.index', $data);
	}

   public function getChiTiet($id)
   {
      $nhapkho = Nhapkho::findOrFail($id);
      $data = [
         'nhapkho' => $nhapkho
      ];

      return view('admin.nhapkho.chitiet', $data);
   }

   public function getThem(Request $request)
   {
      $nhapkho_nguyenlieu = [];
      
      if($request->has('nhapkho_nguyenlieu'))
      {
         $list_nhapkho = explode('|', $request->nhapkho_nguyenlieu);

         foreach ($list_nhapkho as $nguyenlieu_id) {
            $nguyenlieu = Nguyenlieu::find($nguyenlieu_id);

            if($nguyenlieu)
            {
               $info_nguyenlieu = [
                  'id' => $nguyenlieu->id,
                  'tennguyenlieu' => $nguyenlieu->tennguyenlieu,
               ];

               array_push($nhapkho_nguyenlieu, $info_nguyenlieu);
            }
         }
      }

   	$data = [
			'all_nguyenlieu' => Nguyenlieu::all(),
         'nhapkho_nguyenlieu' => $nhapkho_nguyenlieu,
		];

   	return view('admin.nhapkho.them', $data);
   }

   public function postThem(ThemNhapKhoRequest $request)
   {
   	$nhapkho = new Nhapkho;
      $nhapkho->manhapkho = $request->manhapkho;
      $nhapkho->nhanvien_id = 1;
      $nhapkho->ngaynhap = new DateTime;
      $nhapkho->ghichu = $request->ghichunhapkho;
      $nhapkho->save();
      $nhapkho_id = $nhapkho->id;

      $count_nguyenlieu_id = count($request->nguyenlieu_id);
      $list_nguyenlieu = $request->nguyenlieu_id;
      $list_soluongnhap = $request->soluongnhap;
      $list_gianhap = $request->gianhap;
      $tongtien = 0;
      for ($i=0; $i < $count_nguyenlieu_id; $i++) { 

         $chitietnhapkho = new Chitietnhapkho;
         $nguyenlieu_id = $list_nguyenlieu[$i];
         $soluongnhap = intval(str_replace(',', '', $list_soluongnhap[$i]));
         $gianhap = intval(str_replace(',', '', $list_gianhap[$i]));

         $chitietnhapkho->nhapkho_id = $nhapkho_id;
         $chitietnhapkho->nguyenlieu_id = $nguyenlieu_id;
         $chitietnhapkho->soluong = $soluongnhap;
         $chitietnhapkho->dongia = $gianhap;
         $chitietnhapkho->save();

         $nguyenlieu = Nguyenlieu::find($nguyenlieu_id);
         $soluong_hientai = $nguyenlieu->soluongtonkho;
         $nguyenlieu->soluongtonkho = $soluong_hientai + $soluongnhap;
         $nguyenlieu->save();
         
         $tongtien += $soluongnhap * $gianhap;
      }

      $nhapkho->tongtien = $tongtien;
      $nhapkho->save();

      return redirect()->route('nhapkho.index')->with('thongbao', 'Nhập kho thành công');
   }

   public function getSua($id)
   {}
}

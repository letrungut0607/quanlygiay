<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Nguyenlieu;
use DB;

class ThongKeController extends Controller
{
   public function getNguyenLieuTonKho()
   {
      $data = [
         'all_nguyenlieutonkho' => Nguyenlieu::where('soluongtonkho', '>', 0)
            ->get()
      ];

      return view('admin.thongke.tonkho', $data);
   }

   public function getDoanhThu(Request $request)
   {
      $data = [
         'doanhthu' => $this->get_doanhthu($request),
         'nhapkho' => $this->get_nhapkho($request),
         'tienhancong' => $this->get_tiennhancong($request),
         'phithem' => $this->get_data_tienvon($request)
      ];

      return view('admin.thongke.doanhthu', $data);
   }

   private function get_data_tienvon($request)
   {
      $query_tienvon = DB::table('tienvon');

      if($request->has('data_thang'))
      {
         $query_tienvon->whereMonth('tienvon.ngaythem', $request->data_thang);
      }

      if($request->has('data_nam'))
      {
         $query_tienvon->whereYear('tienvon.ngaythem', $request->data_nam);
      }

      if($request->has('data_tunam') && $request->has('data_dennam'))
      {
         $data_tunam = $request->data_tunam;
         $data_dennam = $request->data_dennam;
         $query_tienvon->whereYear('tienvon.ngaythem', '>=', $data_tunam);
         $query_tienvon->whereYear('tienvon.ngaythem', '<=', $data_dennam);
      }

      $tongtien_von = $query_tienvon->sum('sotien');

      $query_ruttien = DB::table('lichsuruttien');

      if($request->has('data_thang'))
      {
         $query_ruttien->whereMonth('lichsuruttien.ngayrut', $request->data_thang);
      }

      if($request->has('data_nam'))
      {
         $query_ruttien->whereYear('lichsuruttien.ngayrut', $request->data_nam);
      }

      if($request->has('data_tunam') && $request->has('data_dennam'))
      {
         $data_tunam = $request->data_tunam;
         $data_dennam = $request->data_dennam;
         $query_ruttien->whereYear('lichsuruttien.ngayrut', '>=', $data_tunam);
         $query_ruttien->whereYear('lichsuruttien.ngayrut', '<=', $data_dennam);
      }

      $tongtien_darut = $query_ruttien->sum('sotien');

      $data = [
         'tongtien_darut' => $tongtien_darut,
         'tongtien_von' => $tongtien_von,
      ];

      return $data;
   }

   private function get_doanhthu($request)
   {
      $query_doanhthu = DB::table('xuatkho')
      ->select(
         DB::raw('SUM(phanphoisanpham.soluong) as total_sales'), 
         DB::raw('SUM(phanphoisanpham.soluong * phanphoisanpham.dongia) as total_price'),
         DB::raw('YEAR(xuatkho.ngayxuatkho) as ngayxuatkho'), 
         DB::raw('SUM(CASE WHEN MONTH(xuatkho.ngayxuatkho) = 1 THEN (phanphoisanpham.soluong * phanphoisanpham.dongia) ELSE 0 END) as thang1'),
         DB::raw('SUM(CASE WHEN MONTH(xuatkho.ngayxuatkho) = 2 THEN (phanphoisanpham.soluong * phanphoisanpham.dongia) ELSE 0 END) as thang2'),
         DB::raw('SUM(CASE WHEN MONTH(xuatkho.ngayxuatkho) = 3 THEN (phanphoisanpham.soluong * phanphoisanpham.dongia) ELSE 0 END) as thang3'),
         DB::raw('SUM(CASE WHEN MONTH(xuatkho.ngayxuatkho) = 4 THEN (phanphoisanpham.soluong * phanphoisanpham.dongia) ELSE 0 END) as thang4'),
         DB::raw('SUM(CASE WHEN MONTH(xuatkho.ngayxuatkho) = 5 THEN (phanphoisanpham.soluong * phanphoisanpham.dongia) ELSE 0 END) as thang5'),
         DB::raw('SUM(CASE WHEN MONTH(xuatkho.ngayxuatkho) = 6 THEN (phanphoisanpham.soluong * phanphoisanpham.dongia) ELSE 0 END) as thang6'),
         DB::raw('SUM(CASE WHEN MONTH(xuatkho.ngayxuatkho) = 7 THEN (phanphoisanpham.soluong * phanphoisanpham.dongia) ELSE 0 END) as thang7'),
         DB::raw('SUM(CASE WHEN MONTH(xuatkho.ngayxuatkho) = 8 THEN (phanphoisanpham.soluong * phanphoisanpham.dongia) ELSE 0 END) as thang8'),
         DB::raw('SUM(CASE WHEN MONTH(xuatkho.ngayxuatkho) = 9 THEN (phanphoisanpham.soluong * phanphoisanpham.dongia) ELSE 0 END) as thang9'),
         DB::raw('SUM(CASE WHEN MONTH(xuatkho.ngayxuatkho) = 10 THEN (phanphoisanpham.soluong * phanphoisanpham.dongia) ELSE 0 END) as thang10'),
         DB::raw('SUM(CASE WHEN MONTH(xuatkho.ngayxuatkho) = 11 THEN (phanphoisanpham.soluong * phanphoisanpham.dongia) ELSE 0 END) as thang11'),
         DB::raw('SUM(CASE WHEN MONTH(xuatkho.ngayxuatkho) = 12 THEN (phanphoisanpham.soluong * phanphoisanpham.dongia) ELSE 0 END) as thang12')
      );

      $query_doanhthu->join('phanphoisanpham', 'xuatkho.id', '=', 'phanphoisanpham.xuatkho_id');



      if($request->has('data_thang'))
      {
         $query_doanhthu->whereMonth('xuatkho.ngayxuatkho', $request->data_thang);
      }

      if($request->has('data_nam'))
      {
         $query_doanhthu->whereYear('xuatkho.ngayxuatkho', $request->data_nam);
      }

      if($request->has('data_tunam') && $request->has('data_dennam'))
      {
         $data_tunam = $request->data_tunam;
         $data_dennam = $request->data_dennam;
         $query_doanhthu->whereYear('xuatkho.ngayxuatkho', '>=', $data_tunam);
         $query_doanhthu->whereYear('xuatkho.ngayxuatkho', '<=', $data_dennam);
      }

      $query_doanhthu->groupBy('ngayxuatkho');
      $query_doanhthu->orderBy('ngayxuatkho');
      $thongke = $query_doanhthu->get();

      $tongso_daban = 0;
      $tongtien = 0;

      foreach ($thongke as $sanpham) {
         $tongso_daban += $sanpham->total_sales;
         $tongtien += $sanpham->total_price;
      }

      $data = [
         'tongtien' => $tongtien,
         'tongso_daban' => $tongso_daban,
         'data' => $thongke
      ];

      return $data;
   }

   private function get_nhapkho($request)
   {
      $query_nhapkho = DB::table('chitietnhapkho')
      ->select(DB::raw('SUM(chitietnhapkho.soluong) as total_input'), DB::raw('SUM(chitietnhapkho.soluong * chitietnhapkho.dongia) as total_price'));

      $query_nhapkho->join('nhapkho', 'nhapkho.id', '=', 'chitietnhapkho.nhapkho_id');
      if($request->has('data_thang'))
      {
         $query_nhapkho->whereMonth('nhapkho.ngaynhap', $request->data_thang);
      }

      if($request->has('data_nam'))
      {
         $query_nhapkho->whereYear('nhapkho.ngaynhap', $request->data_nam);
      }

      if($request->has('data_tunam') && $request->has('data_dennam'))
      {
         $data_tunam = $request->data_tunam;
         $data_dennam = $request->data_dennam;
         $query_nhapkho->whereYear('nhapkho.ngaynhap', '>=', $data_tunam);
         $query_nhapkho->whereYear('nhapkho.ngaynhap', '<=', $data_dennam);
      }

      $thongke = $query_nhapkho->get();
      $tongso_nhapkho = 0;
      $tongtien = 0;

      foreach ($thongke as $sanpham) {
         $tongso_nhapkho += $sanpham->total_input;
         $tongtien += $sanpham->total_price;
      }

      $data = [
         'tongtien' => $tongtien,
         'tongso_nhapkho' => $tongso_nhapkho
      ];

      return $data;
   }

   private function get_tiennhancong($request)
   {
      $query_sanxuatnapkin = DB::table('sanxuatnapkin')
      ->select(DB::raw('SUM(sanxuatnapkin.soluongthuctethung_dachia * sanpham.giasanpham) as tien_napkin'));

      $query_sanxuatnapkin->join('sanpham', 'sanpham.id', '=', 'sanxuatnapkin.sanpham_id');


      if($request->has('data_thang'))
      {
         $query_sanxuatnapkin->whereMonth('sanxuatnapkin.ngaysanxuat', $request->data_thang);
      }

      if($request->has('data_nam'))
      {
         $query_sanxuatnapkin->whereYear('sanxuatnapkin.ngaysanxuat', $request->data_nam);
      }

      if($request->has('data_tunam') && $request->has('data_dennam'))
      {
         $data_tunam = $request->data_tunam;
         $data_dennam = $request->data_dennam;
         $query_sanxuatnapkin->whereYear('sanxuatnapkin.ngaysanxuat', '>=', $data_tunam);
         $query_sanxuatnapkin->whereYear('sanxuatnapkin.ngaysanxuat', '<=', $data_dennam);
      }

      $thongke_napkin = $query_sanxuatnapkin->first();
      $tongtien_sanxuatnapkin = $thongke_napkin->tien_napkin;
      

      //WALLET 
      $query_sanxuatwallet = DB::table('sanxuatwallet')
      ->select(DB::raw('SUM(sanxuatwallet.sodaysanxuat_dachia * sanpham.giasanpham) as tien_wallet'));

      $query_sanxuatwallet->join('sanpham', 'sanpham.id', '=', 'sanxuatwallet.sanpham_id');

      if($request->has('data_thang'))
      {
         $query_sanxuatwallet->whereMonth('sanxuatwallet.ngaysanxuat', $request->data_thang);
      }

      if($request->has('data_nam'))
      {
         $query_sanxuatwallet->whereYear('sanxuatwallet.ngaysanxuat', $request->data_nam);
      }

      if($request->has('data_tunam') && $request->has('data_dennam'))
      {
         $data_tunam = $request->data_tunam;
         $data_dennam = $request->data_dennam;
         $query_sanxuatwallet->whereYear('sanxuatwallet.ngaysanxuat', '>=', $data_tunam);
         $query_sanxuatwallet->whereYear('sanxuatwallet.ngaysanxuat', '<=', $data_dennam);
      }

      $thongke_wallet = $query_sanxuatwallet->first();
      $tongtien_sanxuatwallet = $thongke_wallet->tien_wallet;

      $data = [
         'tongtien_sanxuatnapkin' => $tongtien_sanxuatnapkin,
         'tongtien_sanxuatwallet' => $tongtien_sanxuatwallet
      ];

      return $data;
   }
}

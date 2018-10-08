<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Xuatkho;
use App\Models\Phanphoisanpham;
use App\Models\Sanpham;
use App\Models\Nhaphanphoi;
use App\Http\Requests\ThemXuatKhoRequest;
use DateTime;

class XuatKhoController extends Controller
{
   public function getIndex(Request $request)
	{
		$data = [
			'all_xuatkho' => $this->get_data($request)
		];

		return view('admin.xuatkho.index', $data);
	}

   public function getChiTiet($id)
   {
      $xuatkho = Xuatkho::findOrFail($id);
      $data = [
         'xuatkho' => $xuatkho
      ];

      return view('admin.xuatkho.chitiet', $data);
   }

   public function getThem()
   {
   	$data = [
			'all_sanpham' => Sanpham::all(),
         'all_nhaphanphoi' => Nhaphanphoi::all()
		];

   	return view('admin.xuatkho.them', $data);
   }

   public function postThem(ThemXuatKhoRequest $request)
   {
      $list_sanpham = $request->sanpham_id;
      $list_soluongxuat = $request->soluongxuat;
      $list_giaxuat = $request->giaxuat;
      $count_sanpham_id = count($request->sanpham_id);
      $tongtien_check = 0;

      for ($i=0; $i < $count_sanpham_id; $i++) { 
         $sanpham_id = $list_sanpham[$i];
         $sanpham = Sanpham::find($sanpham_id);
         if(!$sanpham)
            return redirect()->back()
            ->with('thongbao', 'Lỗi dữ liệu');

         $soluongxuat = intval(str_replace(',', '', $list_soluongxuat[$i]));
         $giaxuat = intval(str_replace(',', '', $list_giaxuat[$i]));

         if($sanpham->soluong < ($soluongxuat * $sanpham->sogoitrenthung))
         {
            return redirect()->back()
            ->with('thongbao', 'Sản phẩm (' . $sanpham->tensanpham. ') không đủ số lượng để xuất kho')
            ->with('danger', 'true')
            ->withInput();
         }

         $tongtien_check += $soluongxuat * $giaxuat;
      }

      $sotientratruoc = intval(str_replace(',', '', $request->sotientratruoc));

      if($sotientratruoc > $tongtien_check)
      {
         return redirect()->back()
            ->with('thongbao', 'Số tiền trả trước không thể lớn hơn tổng tiền của phiếu xuất này - ' .number_format($tongtien_check))
            ->with('danger', 'true')
            ->withInput();
      }

      $nhaphanphoi_id = $request->nhaphanphoi_id;
      $nhaphanphoi = Nhaphanphoi::find($nhaphanphoi_id);
      if(!$nhaphanphoi)
      {
         return redirect()->back()
            ->with('thongbao', 'Lỗi dữ liệu');
      }

   	$xuatkho = new Xuatkho;
      $xuatkho->maxuatkho = $request->maxuatkho;
      $xuatkho->nhaphanphoi_id = $nhaphanphoi_id;
      $xuatkho->ngayxuatkho = new DateTime;
      $xuatkho->ghichu = $request->ghichuxuatkho;
      $xuatkho->sotientratruoc = $sotientratruoc;
      $xuatkho->save();
      $xuatkho_id = $xuatkho->id;

      $tongtien = 0;

      for ($i=0; $i < $count_sanpham_id; $i++) { 

         $phanphoisanpham = new Phanphoisanpham;
         $sanpham_id = $list_sanpham[$i];
         $soluongxuat = intval(str_replace(',', '', $list_soluongxuat[$i]));
         $giaxuat = intval(str_replace(',', '', $list_giaxuat[$i]));

         $phanphoisanpham->xuatkho_id = $xuatkho_id;
         $phanphoisanpham->sanpham_id = $sanpham_id;
         $phanphoisanpham->soluong = $soluongxuat;
         $phanphoisanpham->thanhtien = ($soluongxuat * $giaxuat);
         $phanphoisanpham->dongia = $giaxuat;
         $phanphoisanpham->save();

         $sanpham = Sanpham::find($sanpham_id);
         $sanpham->soluong = ($sanpham->soluong - ($soluongxuat * $sanpham->sogoitrenthung));
         $sanpham->save();
         
         $tongtien += $phanphoisanpham->thanhtien;

      }

      $xuatkho->tongtien = $tongtien;
      $xuatkho->save();

      $msg = '';

      if($sotientratruoc > 0)
      {
         if($sotientratruoc == $tongtien)
         {
            $msg = 'đã thanh toán đầy đủ số tiền là (' .number_format($tongtien). ')';
         }
         else
         {
            $msg = 'với số tiền trả trước là (' .number_format($sotientratruoc). ')';
            $nhaphanphoi->congno = ($nhaphanphoi->congno + ($tongtien - $sotientratruoc));
            $nhaphanphoi->save();
         }
      }

      return redirect()->route('xuatkho.index')->with('thongbao', 'Xuất kho thành công ' . $msg);
   }

   public function getSua($id)
   {}

   private function get_data($request)
   {
      if($request->all())
      {
         $query = Xuatkho::select('*');

         if($request->has('tu_thang') && $request->has('tu_nam') && $request->has('den_thang') && $request->has('den_nam'))
         {         
            $from_date = $request->tu_nam.'-'.$request->tu_thang.'-1';
            $to_date = $request->den_nam.'-'.$request->den_thang.'-31';
            $query->whereDate('ngayxuatkho', '>=', $from_date);
            $query->whereDate('ngayxuatkho', '<=', $to_date);
         }

         else
         {
            if($request->has('tu_thang'))
            {
               $query->whereMonth('xuatkho.ngayxuatkho', $request->tu_thang);
            }

            if($request->has('den_thang'))
            {
               $query->whereMonth('xuatkho.ngayxuatkho', $request->den_thang);
            }

            if($request->has('tu_nam'))
            {
               $query->whereYear('xuatkho.ngayxuatkho', $request->tu_nam);
            }

            if($request->has('den_nam'))
            {
               $query->whereYear('xuatkho.ngayxuatkho', $request->den_nam);
            }
         }

         return $query->get();
      }

      return Xuatkho::all();
   }
}

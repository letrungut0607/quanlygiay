<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class LuongNhanVienController extends Controller
{
	public function getLuongNhanVienNapKin(Request $request)
	{
		$data = [
			'data' => $this->get_data_luongnhanviennapkin($request)
		];

		return view('admin.luong.nhanviennapkin', $data);
	}

	public function getLuongNhanVienWallet(Request $request)
	{
		$data = [
			'data' => $this->get_data_luongnhanvienwallet($request)
		];

		return view('admin.luong.nhanvienwallet', $data);
	}

	private function get_data_luongnhanviennapkin($request)
	{
		$query = DB::table('sanxuatnapkin');
		$query->select(
			DB::raw('nhanvien.manhanvien'),
			DB::raw('nhanvien.tennhanvien'),
         DB::raw('SUM(sanxuatnapkin.soluongthuctethung_dachia * sanpham.giasanpham) as tienluong')
      );

		$query->join('sanpham', 'sanpham.id', '=', 'sanxuatnapkin.sanpham_id');
		$query->join('nhanvien', 'nhanvien.id', '=', 'sanxuatnapkin.nhanvien_id');

		$dieukien_loc = '';

		if($request->has('tu_thang') && $request->has('tu_nam') && $request->has('den_thang') && $request->has('den_nam'))
      {
         $from_date = $request->tu_nam.'-'.$request->tu_thang.'-1';
         $to_date = $request->den_nam.'-'.$request->den_thang.'-31';
         $query->whereDate('ngaysanxuat', '>=', $from_date);
         $query->whereDate('ngaysanxuat', '<=', $to_date);

         $dieukien_loc .= 'từ tháng '.$request->tu_thang.' năm '.$request->tu_nam.' đến tháng '.$request->den_thang.' năm '.$request->den_nam;
      }
      else
      {
      	$query->whereMonth('sanxuatnapkin.ngaysanxuat', date('m'));
      	$query->whereYear('sanxuatnapkin.ngaysanxuat', date('Y'));

      }

      if(Auth::user()->phanquyen === 0)
      {
      	$nhanvien_id = Auth::user()->id;
      	$query->where('sanxuatnapkin.nhanvien_id', $nhanvien_id);
      }

		$query->groupBy('nhanvien.manhanvien');
		$query->groupBy('nhanvien.tennhanvien');

		$data = [
			'all_luong' => $query->get(),
			'dieukien_loc' => $dieukien_loc,
		];
		
		return $data;

	}

	private function get_data_luongnhanvienwallet($request)
	{
		$query = DB::table('sanxuatwallet');
		$query->select(
			DB::raw('nhanvien.manhanvien'),
			DB::raw('nhanvien.tennhanvien'),
         DB::raw('SUM(sanxuatwallet.sodaysanxuat_dachia * sanpham.giasanpham) as tienluong')
      );

		$query->join('sanpham', 'sanpham.id', '=', 'sanxuatwallet.sanpham_id');
		$query->join('nhanvien', 'nhanvien.id', '=', 'sanxuatwallet.nhanvien_id');
		$dieukien_loc = '';

		if($request->has('tu_thang') && $request->has('tu_nam') && $request->has('den_thang') && $request->has('den_nam'))
      {
         $from_date = $request->tu_nam.'-'.$request->tu_thang.'-1';
         $to_date = $request->den_nam.'-'.$request->den_thang.'-31';
         $query->whereDate('ngaysanxuat', '>=', $from_date);
         $query->whereDate('ngaysanxuat', '<=', $to_date);

         $dieukien_loc .= 'từ tháng '.$request->tu_thang.' năm '.$request->tu_nam.' đến tháng '.$request->den_thang.' năm '.$request->den_nam;
      }
      else
      {
      	$query->whereMonth('sanxuatwallet.ngaysanxuat', date('m'));
      	$query->whereYear('sanxuatwallet.ngaysanxuat', date('Y'));

      }

      if(Auth::user()->phanquyen === 0)
      {
      	$nhanvien_id = Auth::user()->id;
      	$query->where('sanxuatwallet.nhanvien_id', $nhanvien_id);
      }

		$query->groupBy('nhanvien.manhanvien');
		$query->groupBy('nhanvien.tennhanvien');

		$data = [
			'all_luong' => $query->get(),
			'dieukien_loc' => $dieukien_loc,
		];

		return $data;
	}
}
<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ThemSanPhamRequest;
use App\Http\Requests\SuaSanPhamRequest;
use App\Models\Sanpham;
use App\Models\Loaisanpham;

class SanPhamController extends Controller
{
   public function getIndex()
	{
		$data = [
			'all_sanpham' => Sanpham::all()
		];

		return view('admin.sanpham.index', $data);
	}

   public function getThem()
   {
   	$data = [
			'all_loaisanpham' => Loaisanpham::all()
		];

   	return view('admin.sanpham.them', $data);
   }

   public function postThem(ThemSanPhamRequest $request)
   {
   	$sanpham = new Sanpham;
   	$sanpham->loaisanpham_id = $request->loaisanpham_id;
   	$sanpham->tensanpham = $request->tensanpham;
      $sanpham->giasanpham = intval(str_replace(',', '', $request->giasanpham));
      $sanpham->sogoitrenthung = intval(str_replace(',', '', $request->sogoitrenthung));
      $sanpham->sototrengoi = intval(str_replace(',', '', $request->sototrengoi));
   	$sanpham->save();

   	return redirect()->route('sanpham.them')
	   	->with('thongbao', 'Thêm sản phẩm thành công');
   }

   public function getSua($id)
   {
      $sanpham = Sanpham::findOrFail($id);
      $data = [
         'sanpham' => $sanpham,
         'all_loaisanpham' => Loaisanpham::all()
      ];

      return view('admin.sanpham.sua', $data);
   }

   public function postSua($id, SuaSanPhamRequest $request)
   {
      $sanpham = Sanpham::findOrFail($id);
      $sanpham->loaisanpham_id = $request->loaisanpham_id;
      $sanpham->tensanpham = $request->tensanpham;
      $sanpham->giasanpham = intval(str_replace(',', '', $request->giasanpham));
       $sanpham->sogoitrenthung = intval(str_replace(',', '', $request->sogoitrenthung));
      $sanpham->sototrengoi = intval(str_replace(',', '', $request->sototrengoi));
      $sanpham->save();

      return redirect()->route('sanpham.index')
         ->with('thongbao', 'Chỉnh sửa sản phẩm thành công');
   }
}

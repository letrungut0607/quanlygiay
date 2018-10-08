<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ThemNguyenLieuRequest;
use App\Http\Requests\SuaNguyenLieuRequest;
use App\Models\Nguyenlieu;

class NguyenLieuController extends Controller
{
	public function getIndex()
	{
		$data = [
			'all_nguyenlieu' => Nguyenlieu::all()
		];

		return view('admin.nguyenlieu.index', $data);
	}

   public function getThem()
   {
   	return view('admin.nguyenlieu.them');
   }

   public function postThem(ThemNguyenLieuRequest $request)
   {
   	$nguyenlieu = new Nguyenlieu;
   	$nguyenlieu->manguyenlieu = $request->manguyenlieu;
   	$nguyenlieu->tennguyenlieu = $request->tennguyenlieu;
   	$nguyenlieu->donvitinh = $request->donvitinh;
   	$nguyenlieu->soluongtonkho = 0;
   	$nguyenlieu->save();

   	return redirect()->route('nguyenlieu.them')
	   	->with('thongbao', 'Thêm nguyên liệu thành công');
   }

   public function getSua($id)
   {
      $nguyenlieu = Nguyenlieu::findOrFail($id);

      $data = [
         'nguyenlieu' => $nguyenlieu
      ];

      return view('admin.nguyenlieu.sua', $data);
   }

   public function postSua($id, SuaNguyenLieuRequest $request)
   {
      $nguyenlieu = Nguyenlieu::findOrFail($id);

      $nguyenlieu->manguyenlieu = $request->manguyenlieu;
      $nguyenlieu->tennguyenlieu = $request->tennguyenlieu;
      $nguyenlieu->donvitinh = $request->donvitinh;
      $nguyenlieu->save();

      return redirect()->route('nguyenlieu.index')
         ->with('thongbao', 'Sửa nguyên liệu thành công');
   }
}

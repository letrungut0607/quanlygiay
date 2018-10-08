<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tienvon;
use App\Models\Lichsuruttien;
use App\Http\Requests\ThemTienVonRequest;
use App\Http\Requests\ThemRutTienRequest;

class TienVonController extends Controller
{
	public function getIndex()
	{
		$data = [
			'all_tienvon' => Tienvon::all(),
		];

		return view('admin.tienvon.index', $data);
	}

	public function getLichSuRutTien()
	{
		$data = [
			'all_lichsuruttien' => Lichsuruttien::all(),
		];

		return view('admin.tienvon.lichsuruttien', $data);
	}

	public function getThemTienVon()
	{
		return view('admin.tienvon.them');
	}

	public function postThemTienVon(ThemTienVonRequest $request)
	{
		$sotien = intval(str_replace(',', '', $request->sotien));
		if($sotien <= 0)
		{
			return redirect()->back()
            ->with('thongbao', 'Số tiền thêm không thể nhỏ hơn hoặc bằng 0')
            ->with('danger', 'true')
            ->withInput();
		}

		$tienvon = new Tienvon;
		$tienvon->ngaythem = dinh_dang_ngay_mysql($request->ngaythem);
		$tienvon->sotien = $sotien;
		$tienvon->ghichu = $request->ghichu;
		$tienvon->save();
		
		return redirect()->route('tienvon.them')
	   	->with('thongbao', 'Thêm tiền vốn thành công');
	}

	public function getRutTien()
	{
		return view('admin.tienvon.ruttien');
	}

	public function postRutTien(ThemRutTienRequest $request)
	{
		$sotien = intval(str_replace(',', '', $request->sotien));
		$sotienvon = Tienvon::tongso_tienvon();
		$tong_sotien_darut = Lichsuruttien::tongtien_darut();

		if($sotien <= 0)
		{
			return redirect()->back()
            ->with('thongbao', 'Số tiền rút không thể nhỏ hơn hoặc bằng 0')
            ->with('danger', 'true')
            ->withInput();
		}

		if(($sotien + $tong_sotien_darut) > $sotienvon)
		{
			return redirect()->back()
            ->with('thongbao', 'Số tiền rút không thể lớn hơn số tiền vốn')
            ->with('danger', 'true')
            ->withInput();
		}

		$lichsuruttien = new Lichsuruttien;
		$lichsuruttien->ngayrut = dinh_dang_ngay_mysql($request->ngayrut);
		$lichsuruttien->sotien = $sotien;
		$lichsuruttien->ghichu = $request->ghichu;
		$lichsuruttien->save();
		
		return redirect()->route('tienvon.ruttien')
	   	->with('thongbao', 'Rút tiền thanh công');
	}
}
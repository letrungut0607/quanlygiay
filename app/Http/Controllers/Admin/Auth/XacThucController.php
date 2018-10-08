<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class XacThucController extends Controller
{

   public function __construct()
   {
      $this->middleware('checknhanvien', ['except' => 'getDangXuat']);
   }

   public function getDangNhap()
   {
   	return view('admin.auth.dangnhap');
   }

   public function postDangNhap(Request $request)
   {
      $taikhoan = $request->taikhoan;
      $password = $request->password;
      $login = [
         'taikhoan' => $taikhoan, 
         'password' => $password, 
      ];

      if (Auth::attempt($login)) {
         return redirect()->route('admin.dashboard')->with('thongbao', 'Đăng nhập tài khoản của bạn thành công');
      } else {
         return redirect()->back()->with('thongbao', 'Tài khoản không hợp lệ')->with('danger', 'true');
      }
   }

   public function getDangXuat()
   {
      Auth::logout();
      return redirect()->route('admin.login')->with('thongbao', 'Đăng xuất tài khoản của bạn thành công');
   }

}

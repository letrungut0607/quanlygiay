<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuanLyController extends Controller
{
   public function getQuanLy()
   {
   	return view('admin.common.quanly');
   }
}

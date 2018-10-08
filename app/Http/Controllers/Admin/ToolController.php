<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Nhanviensanxuat;
use App\Models\Lichsucongno;
use App\Models\Xuatkho;
use App\Models\Nhaphanphoi;
use DateTime;

class ToolController extends Controller
{
	public function postXoaBo(Request $request)
	{
		if(isset($request->del_dulieu) && intval($request->del_dulieu) > 0)
      {
      	$array_request = explode('_', $request->del_dulieu);
         $id = $array_request[0];
         $table = $array_request[1];
         
         $this->xoaDuLieu($table, $id);
         return redirect()->back()->with('thongbao', 'Đã xóa vĩnh viễn');        
      }
	}

   private function xoaDuLieu($table, $id)
   {
   	DB::table($table)->where('id', $id)->delete();
   }

   public function ajaxChonSanPhamSanXuat(Request $request)
   {
      if ($request->has('nhanvien_id')) {
         $nhanvien_id = $request->nhanvien_id;
         $all_nhanviensanxuat = Nhanviensanxuat::where('nhanvien_id', $nhanvien_id)->get();
         
         $data = ['all_nhanviensanxuat' => $all_nhanviensanxuat];

         return view('admin.common.ajax-sanpham', $data);
      }
   }

   public function ajaxGetSoTienConNo(Request $request)
   {
      if ($request->has('xuatkho_id')) {
         $xuatkho_id = $request->xuatkho_id;
         $xuatkho = Xuatkho::find($xuatkho_id);
         $result = [];
         if(!$xuatkho)
         {
            $result['status'] = 'err';
            $result['sotienconno'] = 0;
            return response()->json($result);
         }

         $sotienconno = ($xuatkho->tongtien - $xuatkho->sotientratruoc);
         $result['status'] = 'ok';
         $result['sotienconno'] = $sotienconno;
         $result['nhaphanphoi'] = $xuatkho->nhaphanphoi;
         
         
         return response()->json($result);
      }
   }

   public function ajaxTraNo(Request $request)
   {
      $xuatkho_id = $request->xuatkho_id;
      $sotientra = $request->sotientra;
      $xuatkho = Xuatkho::find($xuatkho_id);
      $sotientra = intval(str_replace(',', '', $sotientra));
      $result = [];

      if($sotientra <= 0)
      {
         $result['status'] = 'err';
         $result['msg'] = 'Số tiền trả không thể nhỏ hơn hoặc bằng 0';
         return response()->json($result);
      }

      if(!$xuatkho)
      {
         $result['status'] = 'err';
         $result['msg'] = 'Không tồn tại xuất kho';
         return response()->json($result);
      }

     

      if($sotientra > ($xuatkho->tongtien - $xuatkho->sotientratruoc))
      {
         $result['status'] = 'err';
         $result['msg'] = 'Số tiền trả không thể lớn hơn số tiền còn nợ hoặc phiếu xuất này không còn nợ';
         return response()->json($result);
      }

      if($xuatkho->tongtien == $xuatkho->sotientratruoc)
      {
         $result['status'] = 'err';
         $result['msg'] = 'Phiếu xuất này đã trả hoàn thành số tiền nợ';
         return response()->json($result);
      }


      $xuatkho->sotientratruoc = ($xuatkho->sotientratruoc + $sotientra);
      $xuatkho->save();

      $nhaphanphoi = Nhaphanphoi::find($xuatkho->nhaphanphoi_id);
      $nhaphanphoi->congno = ($nhaphanphoi->congno - $sotientra);
      $nhaphanphoi->save();
      
      $lichsucongno = new Lichsucongno;
      $lichsucongno->xuatkho_id = $xuatkho->id;
      $lichsucongno->sotiendatra = $sotientra;
      $lichsucongno->ngaytra = new DateTime;
      $lichsucongno->save();

      $result['status'] = 'ok';
      $result['msg'] = 'Đã trả tiền thành công với số tiền là ' .number_format($sotientra);
      return response()->json($result);
   }

   public function getLichSuCongNo(Request $request)
   {
      $xuatkho_id = $request->xuatkho_id;
      $xuatkho = Xuatkho::find($xuatkho_id);

      $result = [];

      if(!$xuatkho || count($xuatkho->lichsucongno) == 0)
      {
         return 'err';
      }

      $data['msg'] = 'Lịch sử công nợ của nhà phân phối' . $xuatkho->nhaphanphoi->tennhanphanphoi;
      $data['all_lichsucongno'] = $xuatkho->lichsucongno;
      return view('admin.common.ajax-lichsucongno', $data);
   }
}

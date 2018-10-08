@extends('layouts.admin')
@section('title', 'Chi tiết nhập kho')
@section('content')
<div id="content">
	<div id="content-header">
	  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('nhapkho.index') }}" class="tip-bottom">Nhập kho</a> <a href="#" class="current">Chi tiết nhập kho kho</a>
	</div>
  <div class="container-fluid">
    <div class="row-fluid" style="margin-top: -20px">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
            <h5 >Thông tin nhập kho</h5>
          </div>
          <div class="widget-content">
            <div class="row-fluid" style="margin-top: 5px">
              <div class="span5">
                <table class="">
                  <tbody>
                    <tr>
                      <td><b>Nhân viên nhập kho </b></td>
                    </tr>
                    <tr>
                      <td><h4>{{ $nhapkho->nhanvien->tennhanvien }}</h4></td>
                    </tr>
                    <tr>
                      <td><b>Mã nhân viên: </b>{{ $nhapkho->nhanvien->manhanvien }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="span7">
                <table class="table table-bordered table-invoice">
                  <tbody>
                    <tr>
                      <td>Mã nhập kho:</td>
                      <td><strong>{{ $nhapkho->manhapkho }}</strong></td>
                    </tr>
                    <tr>
                      <td>Ngày nhập:</td>
                      <td><strong>{{ dinh_dang_ngay_gio($nhapkho->ngaynhap) }}</strong></td>
                    </tr>
                    <tr>
                      <td>Ghi chú:</td>
                      <td><strong>{{ $nhapkho->ghichu }}</strong></td>
                    </tr>
                  <tr>
                </tbody>
                </table>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span12">
                <table class="table table-bordered table-invoice-full">
                  <thead>
                    <tr>
                      <th class="head0">STT</th>
                      <th class="head1">Nguyên liệu</th>
                      <th class="head0 right">Số lượng</th>
                      <th class="head1 right">Giá nhập</th>
                      <th class="head0 right">Thành tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php 
                  $stt = 1;
                  $soluongnhap = 0;
                  @endphp
                  @foreach ($nhapkho->chitietnhapkho as $chitietnhapkho)
	               <tr>
                     <td>{{ $stt }}</td>
                     <td>{{ $chitietnhapkho->nguyenlieu->tenguyenlieu }}</td>
                     <td class="right">{{ number_format
                      ($chitietnhapkho->soluong) }}</td>
                     <td class="right">
                     {{ number_format($chitietnhapkho->dongia) }}</td>
                     <td class="right"><strong>{{ number_format($chitietnhapkho->dongia*$chitietnhapkho->soluong) }}</strong></td>
                  </tr>
                  @php 
                  $stt++; 
                  $soluongnhap += $chitietnhapkho->soluong;
                  @endphp
                  @endforeach
                  </tbody>
                  <tfoot>
                    <td colspan="3">Tổng tiền</td>
                    <td>{{ number_format($soluongnhap) }}</td>
                    <td>{{ number_format($nhapkho->tongtien) }}</td>
                  </tfoot>
                </table>
               <div class="row-fluid">
	              <div class="span12">
                  <a class="btn btn-success" href="{{ route('nhapkho.index') }}">Quay lại</a>
	              </div>
	            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
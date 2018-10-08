@extends('layouts.admin')
@section('title', 'Chi tiết xuất kho')
@section('content')
<div id="content">
	<div id="content-header">
	  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('xuatkho.index') }}" class="tip-bottom">xuất kho</a> <a href="#" class="current">Chi tiết xuất kho kho</a>
	</div>
  <div class="container-fluid">
    <div class="row-fluid" style="margin-top: -20px">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
            <h5 >Thông tin xuất kho</h5>
          </div>
          <div class="widget-content">
            <div class="row-fluid" style="margin-top: 5px">
              <div class="span5">
                <table class="">
                  <tbody>
                    <tr>
                      <td><b>Nhà phân phối </b></td>
                    </tr>
                    <tr>
                      <td><h4>{{ $xuatkho->nhaphanphoi->tennhaphanphoi }}</h4></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="span7">
                <table class="table table-bordered table-invoice">
                  <tbody>
                    <tr>
                      <td>Mã xuất kho:</td>
                      <td><strong>{{ $xuatkho->maxuatkho }}</strong></td>
                    </tr>
                    <tr>
                      <td>Ngày xuất:</td>
                      <td><strong>{{ dinh_dang_ngay_gio($xuatkho->ngayxuat) }}</strong></td>
                    </tr>
                    <tr>
                      <td>Tiền trả trước:</td>
                      <td><strong>{{ number_format($xuatkho->sotientratruc) }}</strong></td>
                    </tr>
                    <tr>
                      <td>Ghi chú:</td>
                      <td><strong>{{ $xuatkho->ghichu }}</strong></td>
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
                      <th class="head1">Sản phẩm</th>
                      <th class="head0 right">Số lượng thùng</th>
                      <th class="head1 right">Số lượng dây trên thùng</th>
                      <th class="head1 right">Giá xuất</th>
                      <th class="head0 right">Thành tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php 
                  $stt = 1;
                  $soluongnhap = 0;
                  $soluongdaytrenthung = 0;
                  @endphp
                  @foreach ($xuatkho->phanphoisanpham as $phanphoisanpham)
	               <tr>
                     <td>{{ $stt }}</td>
                     <td>{{ $phanphoisanpham->sanpham->tensanpham }}</td>
                     <td class="right">{{ number_format
                      ($phanphoisanpham->soluong) }}</td>
                      <td class="right">{{ number_format
                      ($phanphoisanpham->soluongdaytrenthung) }}</td>
                     <td class="right">
                     {{ number_format($phanphoisanpham->dongia) }}</td>
                     <td class="right"><strong>{{ number_format($phanphoisanpham->thanhtien) }}</strong></td>
                  </tr>
                  @php 
                  $stt++; 
                  $soluongnhap += $phanphoisanpham->soluong;
                  $soluongdaytrenthung += $phanphoisanpham->soluongdaytrenthung;
                  @endphp
                  @endforeach
                  </tbody>
                  <tfoot>
                    <td colspan="2">Tổng cộng</td>
                    <td colspan="1"><strong>{{ number_format($soluongnhap) }}</strong></td>
                    <td colspan="2"><strong>{{ number_format($soluongdaytrenthung) }}</strong></td>
                    <td colspan="1"><strong>{{ number_format($xuatkho->tongtien) }}</strong></td>
                  </tfoot>
                </table>
               <div class="row-fluid">
	              <div class="span12">
                  <a class="btn btn-success" href="{{ route('xuatkho.index') }}">Quay lại</a>
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
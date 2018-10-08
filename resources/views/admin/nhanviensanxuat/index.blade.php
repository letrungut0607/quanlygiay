@extends('layouts.admin')
@section('title', 'Danh sách nhân viên sản xuất')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('nhanviensanxuat.index') }}" class="tip-bottom">Nhân viên sản xuất</a></div>
  <h1>Danh sách nhân viên sản xuất đang có</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
  <div class="row-fluid">
    <div class="widget-box">
        <form action="{{ route('tool.xoabo') }}" method="post" id="dulieu_check_multi">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="widget-title"> 
          <span class="icon"><i class="icon-th"></i></span>
          <h5>Tất cả nhân viên sản xuất</h5>
          <span class="mytool"><a class="btn btn-mini btn-info" href="{{ route('nhanviensanxuat.them') }}"><i class="icon-plus-sign"></i> Thêm mới</a></span>
        </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Mã nhân viên</th>
                  <th>Tên nhân viên</th>
                  <th>Sản phẩm</th>
                  <th>Đơn giá</th>
                  <th>Ngày tạo</th>
                  <th>Công cụ</th>
                </tr>
              </thead>
              <tbody>
                @foreach($all_nhanviensanxuat as $nhanvien)
                <tr>
                  <td>{{ $nhanvien->nhanvien->manhanvien }}</td>
                  <td>{{ $nhanvien->nhanvien->tennhanvien }}</td>
                  <td>{{ $nhanvien->sanpham->tensanpham }}</td>
                  <td>{{ number_format($nhanvien->dongia) }}</td>
                  <td>{{ dinh_dang_ngay_gio($nhanvien->created_at) }}</td>
                  <td>
                    <a href="{{ route('nhanviensanxuat.sua', $nhanvien->id) }}" class="btn btn-mini btn-info">Sửa</a>
                    <button type="button" class="btn btn-mini btn-danger xacnhan" data-action="{{ route('tool.xoabo') }}" name="del_dulieu" data-value="{{ $nhanvien->id . '_' . 'nhanviensanxuat'}}">Xóa</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </form>
      </div>
  </div>
</div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/admin/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/admin/matrix.tables.js') }}"></script> 
@endsection
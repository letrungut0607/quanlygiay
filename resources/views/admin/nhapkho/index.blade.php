@extends('layouts.admin')
@section('title', 'Danh sách nhập kho')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('nhapkho.index') }}" class="tip-bottom">Nhập kho</a></div>
  <h1>Danh sách nhập kho đang có</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
  <div class="row-fluid">
    <div class="widget-box">
        <form action="{{ route('tool.xoabo') }}" method="post" id="dulieu_check_multi">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="widget-title"> 
          <span class="icon"><i class="icon-th"></i></span>
          <h5>Tất cả nhập kho</h5>
          <span class="mytool"><a class="btn btn-mini btn-info" href="{{ route('nhapkho.them') }}"><i class="icon-plus-sign"></i> Thêm mới</a></span>
        </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Mã nhập kho</th>
                  <th>Tên nhân viên</th>
                  <th>Tổng tiền</th>
                  <th>Ngày nhập</th>
                  <th>Công cụ</th>
                </tr>
              </thead>
              <tbody>
                @foreach($all_nhapkho as $nhapkho)
                <tr>
                  <td>{{ $nhapkho->manhapkho }}</td>
                  <td>{{ $nhapkho->nhanvien->tennhanvien }}</td>
                  <td>{{ number_format($nhapkho->tongtien) }}</td>
                  <td>{{ dinh_dang_ngay_gio($nhapkho->ngaynhap) }}</td>
                  <td>
                    <a href="{{ route('nhapkho.chitiet', $nhapkho->id) }}" class="btn btn-mini btn-info">chi tiết</a>
                    <button type="button" class="btn btn-mini btn-danger xacnhan" data-action="{{ route('tool.xoabo') }}" name="del_dulieu" data-value="{{ $nhapkho->id . '_' . 'nhapkho'}}">Xóa</button>
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
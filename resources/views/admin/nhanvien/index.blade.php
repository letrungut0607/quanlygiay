@extends('layouts.admin')
@section('title', 'Danh sách nhân viên')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('nhanvien.index') }}" class="tip-bottom">Nhân viên</a></div>
  <h1>Danh sách nhân viên đang có</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
  <div class="row-fluid">
    <div class="widget-box">
        <form action="{{ route('tool.xoabo') }}" method="post" id="dulieu_check_multi">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="widget-title"> 
          <span class="icon"><i class="icon-th"></i></span>
          <h5>Tất cả nhân viên</h5>
          <span class="mytool"><a class="btn btn-mini btn-info" href="{{ route('nhanvien.them') }}"><i class="icon-plus-sign"></i> Thêm mới</a></span>
        </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Mã nhân viên</th>
                  <th>Tên nhân viên</th>
                  <th>Nhóm quyền</th>
                  <th>Ngày tạo</th>
                  <th>Công cụ</th>
                </tr>
              </thead>
              <tbody>
                @foreach($all_nhanvien as $nhanvien)
                <tr>
                  <td>{{ $nhanvien->manhanvien }}</td>
                  <td>{{ $nhanvien->tennhanvien }}</td>
                  <td>{{ $nhanvien->phanquyen === 0 ? 'Nhân viên sản xuất' : 'Quản trị' }}</td>
                  <td>{{ dinh_dang_ngay_gio($nhanvien->created_at) }}</td>
                  <td>
                    <a href="{{ route('nhanvien.sua', $nhanvien->id) }}" class="btn btn-mini btn-info">Sửa</a>
                    <button type="button" class="btn btn-mini btn-danger xacnhan" data-action="{{ route('tool.xoabo') }}" name="del_dulieu" data-value="{{ $nhanvien->id . '_' . 'nhanvien'}}">Xóa</button>
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
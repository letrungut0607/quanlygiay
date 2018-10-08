@extends('layouts.admin')
@section('title', 'Danh sách sản xuất wallet')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('sanxuatwallet.index') }}" class="tip-bottom">sản xuất wallet</a></div>
  <h1>Danh sách sản xuất wallet đang có</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
  <div class="row-fluid">
    <div class="widget-box">
        <form action="{{ route('tool.xoabo') }}" method="post" id="dulieu_check_multi">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="widget-title"> 
          <span class="icon"><i class="icon-th"></i></span>
          <h5>Tất cả sản xuất wallet</h5>
          <span class="mytool"><a class="btn btn-mini btn-info" href="{{ route('sanxuatwallet.them') }}"><i class="icon-plus-sign"></i> Thêm mới</a></span>
        </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Tên nhân viên</th>
                  <th>Nguyên liệu</th>
                  <th>Sản phẩm</th>
                  <th>Số dãy</th>
                  <th>Số gói sản xuất</th>
                  <th>Công cụ</th>
                </tr>
              </thead>
              <tbody>
                @foreach($all_sanxuatwallet as $sanxuatwallet)
                <tr>
                  <td>{{ $sanxuatwallet->nhanvien->tennhanvien }}</td>
                  <td>{{ $sanxuatwallet->nguyenlieu->tennguyenlieu }}</td>
                  <td>{{ $sanxuatwallet->sanpham->tensanpham }}</td>
                  <td>{{ $sanxuatwallet->sodaysanxuat }}</td>
                  <td>{{ number_format($sanxuatwallet->sogoisanxuatduoc) }}</td>
                  <td>
                    <button type="button" class="btn btn-mini btn-danger xacnhan" data-action="{{ route('tool.xoabo') }}" name="del_dulieu" data-value="{{ $sanxuatwallet->id . '_' . 'sanxuatwallet'}}">Xóa</button>
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
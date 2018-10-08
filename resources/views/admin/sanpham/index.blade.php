@extends('layouts.admin')
@section('title', 'Danh sách sản phẩm')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('sanpham.index') }}" class="tip-bottom">Sản phẩm</a></div>
  <h1>Danh sách sản phẩm đang có</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
  <div class="row-fluid">
    <div class="widget-box">
        <form action="{{ route('tool.xoabo') }}" method="post" id="dulieu_check_multi">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="widget-title"> 
          <span class="icon"><i class="icon-th"></i></span>
          <h5>Tất cả sản phẩm</h5>
          <span class="mytool"><a class="btn btn-mini btn-info" href="{{ route('sanpham.them') }}"><i class="icon-plus-sign"></i> Thêm mới</a></span>
        </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Tên sản phẩm</th>
                  <th>Loại sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Giá sản phẩm</th>
                  <th>Số gói / thùng </th>
                  <th>Ngày tạo</th>
                  <th>Công cụ</th>
                </tr>
              </thead>
              <tbody>
                @foreach($all_sanpham as $sanpham)
                <tr>
                  <td>{{ $sanpham->tensanpham }}</td>
                  <td>{{ $sanpham->loaisanpham->tenloai }}</td>
                  <td>{{ number_format($sanpham->soluong) }}</td>
                  <td>{{ number_format($sanpham->giasanpham) }}</td>
                  <td>{{ number_format($sanpham->sogoitrenthung) }}</td>
                  <td>{{ dinh_dang_ngay_gio($sanpham->created_at) }}</td>
                  <td>
                    <a href="{{ route('sanpham.sua', $sanpham->id) }}" class="btn btn-mini btn-info">Sửa</a>
                    <button type="button" class="btn btn-mini btn-danger xacnhan" data-action="{{ route('tool.xoabo') }}" name="del_dulieu" data-value="{{ $sanpham->id . '_' . 'sanpham'}}">Xóa</button>
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
@extends('layouts.admin')
@section('title', 'Thống kê tồn kho')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('thongke.nguyenlieutonkho') }}" class="tip-bottom">Thống kê tồn kho</a></div>
  <h1>Danh sách thống kê tồn kho</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
  <div class="row-fluid">
    <div class="widget-box">

      <div class="widget-title"> 
        <span class="icon"><i class="icon-th"></i></span>
        <h5>Tất cả thống kê tồn kho</h5>
        <span class="mytool"><a class="btn btn-mini btn-info" href="{{ route('thongke.nguyenlieutonkho') }}"><i class="icon-plus-sign"></i> Thêm mới</a></span>
      </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered data-table">
            <thead>
              <tr>
                <th>Mã nguyên liệu</th>
                <th>Tên nguyên liệu</th>
                <th>Đơn vị tính</th>
                <th>Số lượng tồn kho</th>
                <th>Công cụ</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($all_nguyenlieutonkho as $nguyenlieu)
            @php
              $style_row = '';
              if($nguyenlieu->soluongtonkho <= 5)
                $style_row = 'rgba(255, 0, 0, 0.12)';
            @endphp
            <tr style="background-color: {{ $style_row }}">
              <td>{{ $nguyenlieu->manguyenlieu }}</td>
              <td>{{ $nguyenlieu->tennguyenlieu }}</td>
              <td>{{ $nguyenlieu->donvitinh }}</td>
              <td>{{ $nguyenlieu->soluongtonkho }}</td>
              <td>
                <a href="{{ route('nhapkho.them') }}?nhapkho_nguyenlieu={{ $nguyenlieu->id }}" class="btn btn-info btn-mini" target="_bank">Nhập kho</a>
              </td>
            </tr>
            @endforeach   
            </tbody>
          </table>
        </div>

      </div>
  </div>
</div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/admin/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/admin/matrix.tables.js') }}"></script> 
@endsection
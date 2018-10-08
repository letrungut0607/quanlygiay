@extends('layouts.admin')
@section('title', 'Danh sách sản xuất napkin')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('sanxuatnapkin.index') }}" class="tip-bottom">sản xuất napkin</a></div>
  <h1>Danh sách sản xuất napkin đang có</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
  <div class="row-fluid">
    <div class="widget-box">
        <form action="{{ route('tool.xoabo') }}" method="post" id="dulieu_check_multi">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="widget-title"> 
          <span class="icon"><i class="icon-th"></i></span>
          <h5>Tất cả sản xuất napkin</h5>
          <span class="mytool"><a class="btn btn-mini btn-info" href="{{ route('sanxuatnapkin.them') }}"><i class="icon-plus-sign"></i> Thêm mới</a></span>
        </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Tên nhân viên</th>
                  <th>Nguyên liệu</th>
                  <th>Sản phẩm</th>
                  <th>Số tờ</th>
                  <th>Số gói trên máy đếm</th>
                  <th>Số kg trên máy đếm</th>
                  <th>Thực tế(thùng)</th>
                  <th>Số gói thực tế</th>
                  <th>Số kg thành phẩm</th>
                  <th>Công cụ</th>
                </tr>
              </thead>
              <tbody>
                @foreach($all_sanxuatnapkin as $sanxuatnapkin)
                <tr>
                  <td>{{ $sanxuatnapkin->nhanvien->tennhanvien }}</td>
                  <td>{{ $sanxuatnapkin->nguyenlieu->tennguyenlieu }}</td>
                  <td>{{ $sanxuatnapkin->sanpham->tensanpham }}</td>
                  <td>{{ number_format($sanxuatnapkin->soluongto) }}</td>
                  <td>{{ number_format($sanxuatnapkin->soluongtrenmaydem) }}</td>
                  <td>{{ number_format($sanxuatnapkin->soluongthanhpham) }}</td>
                  <td>{{ number_format($sanxuatnapkin->soluongthuctethung) }}</td>
                  <td>{{ number_format($sanxuatnapkin->soluongthanhpham) }}</td>
                  <td>{{ $sanxuatnapkin->sokg }}</td>
                  <td>
                    <button type="button" class="btn btn-mini btn-danger xacnhan" data-action="{{ route('tool.xoabo') }}" name="del_dulieu" data-value="{{ $sanxuatnapkin->id . '_' . 'sanxuatnapkin'}}">Xóa</button>
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
@extends('layouts.admin')
@section('title', 'Danh sách tiền vốn')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('tienvon.index') }}" class="tip-bottom">tiền vốn</a></div>
  <h1>Danh sách tiền vốn đang có</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
  <div class="row-fluid">
    <div class="widget-box">
        <form action="{{ route('tool.xoabo') }}" method="post" id="dulieu_check_multi">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="widget-title"> 
          <span class="icon"><i class="icon-th"></i></span>
          <h5>Tất cả tiền vốn</h5>
          <span class="mytool"><a class="btn btn-mini btn-info" href="{{ route('tienvon.them') }}"><i class="icon-plus-sign"></i> Thêm mới</a>
          <a class="btn btn-mini btn-success" href="{{ route('tienvon.ruttien') }}"><i class="icon-plus-sign"></i> Rút tiền</a>
          </span>
        </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th width="150px">Ngày thêm</th>
                  <th width="150px">Số tiền vốn</th>
                  <th>Ghi chú</th>
                </tr>
              </thead>
              <tbody>
                @php
                $tongtien = 0;
                @endphp
                @foreach($all_tienvon as $tienvon)
                <tr>
                  <td>{{ dinh_dang_ngay($tienvon->ngaythem) }}</td>
                  <td>{{ number_format($tienvon->sotien) }}</td>
                  <td>{{ $tienvon->ghichu }}</td>
                </tr>
                @php
                $tongtien += $tienvon->sotien;
                @endphp
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td><strong>Tổng tiền vốn đã thêm</strong></td>
                  <td colspan="2">
                    <strong>{{ number_format($tongtien) }}</strong>
                  </td>
                </tr>
                @php
                  $tongtien_darut = App\Models\Lichsuruttien::tongtien_darut();
                @endphp
                <tr>
                  <td><strong>Tổng tiền vốn đã rút</strong></td>
                  <td colspan="2">
                    <strong>{{ number_format($tongtien_darut) }}</strong>
                  </td>
                </tr>
                <tr>
                  <td><strong>Tổng tiền còn lại</strong></td>
                  <td colspan="2">
                    <strong>{{ number_format($tongtien - $tongtien_darut) }}</strong>
                  </td>
                </tr>
              </tfoot>
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
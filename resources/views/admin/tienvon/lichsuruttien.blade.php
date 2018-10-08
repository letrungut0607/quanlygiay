@extends('layouts.admin')
@section('title', 'Danh sách lịch sử rút tiền')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('tienvon.index') }}" class="tip-bottom">lịch sử rút tiền</a></div>
  <h1>Danh sách lịch sử rút tiền đang có</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
  <div class="row-fluid">
    <div class="widget-box">
        <form action="{{ route('tool.xoabo') }}" method="post" id="dulieu_check_multi">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="widget-title"> 
          <span class="icon"><i class="icon-th"></i></span>
          <h5>Tất cả lịch sử rút tiền</h5>
        </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th width="150px">Ngày rút</th>
                  <th width="150px">Số tiền rút</th>
                  <th>Ghi chú</th>
                </tr>
              </thead>
              <tbody>
                @php
                $tongtien = 0;
                @endphp
                @foreach($all_lichsuruttien as $lichsuruttien)
                <tr>
                  <td>{{ dinh_dang_ngay($lichsuruttien->ngayrut) }}</td>
                  <td>{{ number_format($lichsuruttien->sotien) }}</td>
                  <td>{{ $lichsuruttien->ghichu }}</td>
                </tr>
                @php
                $tongtien += $lichsuruttien->sotien;
                @endphp
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td><strong>Tổng tiền đã rút</strong></td>
                  <td colspan="2">
                    <strong>{{ number_format($tongtien) }}</strong>
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
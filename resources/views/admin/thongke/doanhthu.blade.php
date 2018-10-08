@extends('layouts.admin')
@section('title', 'Thống kê doanh thu')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('thongke.doanhthu') }}" class="tip-bottom">Thống kê doanh thu</a></div>
  <h1>Thống kê doanh thu</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
  <div class="row-fluid">
    <div class="widget-box">
      <div class="myfitter clearfix">
        <div class="input_search">
          <form class="form-inline" action="{{ route('thongke.doanhthu') }}" method="get">
            <div class="input-append">
              @php
                $select_thang = Request::get('data_thang');
              @endphp
             <span class="add-on">Tháng</span>
             <select name="data_thang" class="span2">
              <option value="">Tất cả</option>
              @for ($i = 1; $i <= 12; $i++)
              <option value="{{ $i }}" {{ $select_thang == $i ? 'selected' : '' }}>Tháng {{ $i }}</option>
              @endfor
             </select>
              @php
                $select_nam = Request::get('data_nam');
              @endphp
             <span class="add-on">Năm</span>
             <select name="data_nam" class="span2">
              <option value="">Tất cả</option>
              @for ($i = 2014; $i <= date('Y'); $i++)
              <option value="{{ $i }}" {{ $select_nam == $i ? 'selected' : '' }}>Năm {{ $i }}</option>
              @endfor
             </select>
             <span class="add-on">Từ năm</span>
              @php
                $data_tunam_select = Request::get('data_tunam');
              @endphp
              <select name="data_tunam" class="span2">
              <option value="">-----</option>
              @for ($i = 2014; $i <= date('Y'); $i++)
              <option value="{{ $i }}" {{ $data_tunam_select == $i ? 'selected' : '' }}>Năm {{ $i }}</option>
              @endfor
             </select>
             <span class="add-on">Đến năm</span>
              @php
                $data_dennam_select = Request::get('data_dennam');
              @endphp
              <select name="data_dennam" class="span2">
              <option value="">-----</option>
              @for ($i = 2014; $i <= date('Y'); $i++)
              <option value="{{ $i }}" {{ $data_dennam_select == $i ? 'selected' : '' }}>Năm {{ $i }}</option>
              @endfor
             </select>
             <div class="btn-group">
              <button type="submit" class="btn btn-info">Thống kê</button>
              @if (Request::all())
              <button type="button" class="btn btn-danger" onclick="window.location='{{ route('thongke.doanhthu') }}'"><i class="icon-remove-sign"></i> Hủy lọc</button>
              @endif
            </div>
          </div>
        </form>
      </div>
    </div>
      <div class="widget-title"> 
        <span class="icon"><i class="icon-th"></i></span>
        <h5>Thống kê doanh thu</h5>
      </div>
      <div class="widget-content nopadding">
        <div class="alert alert-info" style="margin-bottom: 0px;">
        <h4>Thống kê chi tiết doanh thu</h4>
        <br>
        <div class="row-fluid">
          <div class="span6">
            <b>Tổng số sản phẩm đã xuất : </b> <span class="badge badge-info"><i>{{ number_format($doanhthu['tongso_daban']) }} sản phẩm</i></span>
            <br>
          </div>
          <div class="span6">
            <b>Tổng tiền vốn : </b> <span class="badge badge-info"><i> {{ number_format($phithem['tongtien_von']) }} vnđ</i></span>
            <br>
            <b>Tổng tiền đã rút : </b> <span class="badge badge-info"><i> {{ number_format($phithem['tongtien_darut']) }} vnđ</i></span>
            <br>
            @php
            $tong_doanhthu = $doanhthu['tongtien'] + $phithem['tongtien_von'] - $phithem['tongtien_darut'];
            @endphp
            <b>Tổng doanh thu : </b> <span class="badge badge-info"><i> {{ number_format($tong_doanhthu) }} vnđ</i></span>
            <br>
          </div>
        </div>
        <br>
        <div class="row-fluid">
          <div class="span6">
            <b>Chi phí nhập kho : </b> <span class="badge badge-info"><i>{{ number_format($nhapkho['tongtien']) }} Vnđ</i></span>
            <br>
            <b>Số lượng nhập kho : </b> <span class="badge badge-info"><i>{{ number_format($nhapkho['tongso_nhapkho']) }}</i></span>
            <hr>
            @php
            $chiphinhancong = $tienhancong['tongtien_sanxuatnapkin'] + $tienhancong['tongtien_sanxuatwallet'];
            $loinhuan = ($tong_doanhthu - $nhapkho['tongtien'] - $chiphinhancong);
            @endphp
            <b>Tổng lợi nhuận thu được (Tạm tính): </b> <span class="badge badge-info"><i>{{ number_format($loinhuan) }} Vnđ</i></span>
          </div>
          <div class="span6">
            <b>Chi phí nhân công : </b> <span class="badge badge-info"><i>{{ number_format($chiphinhancong) }} Vnđ</i></span>
            <br>
            @if ($loinhuan > 0)
              <b>Kết luận: </b> <span class="badge badge-warning"><i> Bán có lời</i></span>
            @elseif ($loinhuan == 0)
              <b>Kết luận: </b> <span class="badge badge-warning"><i> Chưa xác định</i></span>
            @elseif ($nhapkho['tongtien'] == $doanhthu['tongtien'])
              <b>Kết luận: </b> <span class="badge badge-warning"><i> Thu hồi được vốn</i></span>
            @else
              <b>Kết luận: </b> <span class="badge badge-warning"><i> Chưa thu hồi được vốn</i></span>
            @endif
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

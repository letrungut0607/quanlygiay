@extends('layouts.admin')
@section('title', 'Danh sách lương nhân viên wallet')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('luong.nhanvienwallet') }}" class="tip-bottom">lương nhân viên wallet</a></div>
  <h1>Danh sách lương nhân viên wallet {{ !empty($data['dieukien_loc']) ? $data['dieukien_loc'] : 'trong tháng này' }}</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
  <div class="row-fluid collapse{{ request()->all() ? 'in' : '' }}" id="adv_search">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-content" style="padding: 0px">
          <form class="form-horizontal" action="{{ route('luong.nhanvienwallet') }}" method="get">
            @php
              $tu_thang = Request::get('tu_thang');
              $tu_nam = Request::get('tu_nam');
              $den_thang = Request::get('den_thang');
              $den_nam = Request::get('den_nam');
            @endphp
            <div class="control-group">
              <label class="control-label">Công cụ lọc dữ liệu</label>
              <div class="controls controls-row">
                <select name="tu_thang" class="span2">
                  @for ($i = 1; $i <= 12; $i++)
                  <option value="{{ $i }}" {{ $tu_thang == $i ? 'selected' : '' }}>Tháng {{ $i }}</option>
                @endfor
                </select>
                <select name="tu_nam" class="span2">
                  @for ($i = 2014; $i <= date('Y'); $i++)
                  <option value="{{ $i }}" {{ $tu_nam == $i ? 'selected' : '' }}>Năm {{ $i }}</option>
                  @endfor
                </select>
                <span class="span1" style="width: 3px;">
                  <i class="icon-arrow-right"></i>
                </span>
                <select name="den_thang" class="span2">
                  @for ($i = 1; $i <= 12; $i++)
                  <option value="{{ $i }}" {{ $den_thang == $i ? 'selected' : '' }}>Tháng {{ $i }}</option>
                @endfor
                </select>
                <select name="den_nam" class="span2">
                  @for ($i = 2014; $i <= date('Y'); $i++)
                  <option value="{{ $i }}" {{ $den_nam == $i ? 'selected' : '' }}>Năm {{ $i }}</option>
                  @endfor
                </select>
                <button type="submit" class="btn btn-success span1">Lọc</button>
                @if (request()->all())
                <a href="{{ route('luong.nhanvienwallet') }}" class="btn btn-danger span1">Hủy</a>
                @endif
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row-fluid">
    <div class="widget-box">
      <div class="widget-title"> 
        <span class="icon"><i class="icon-th"></i></span>
        <h5>Tất cả lương nhân viên wallet {{ !empty($data['dieukien_loc']) ? $data['dieukien_loc'] : 'trong tháng này' }}</h5>
        <span class="mytool">
          <a class="btn btn-mini btn-success" href="javascript::void(0);" data-toggle="collapse" data-target="#adv_search"><i class="icon-glass"></i></i> Lọc dữ liệu</a>
          </span>
      </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered data-table">
            <thead>
              <tr>
                <th>Mã nhân viên</th>
                <th>Tên nhân viên</th>
                <th>Số tiền lương</th>
              </tr>
            </thead>
            <tbody>
              @php
                $tongtien = 0;
              @endphp
              @foreach($data['all_luong'] as $luong)
              <tr>
                <td>{{ $luong->manhanvien }}</td>
                <td>{{ $luong->tennhanvien }}</td>
                <td>{{ number_format($luong->tienluong) }}</td>
              </tr>
              @php
                $tongtien += $luong->tienluong;
              @endphp
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2"><strong>Tổng tiền lương</strong></td>
                <td><strong>{{ number_format($tongtien) }}</strong></td>
              </tr>
            </tfoot>
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
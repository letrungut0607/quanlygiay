@extends('layouts.admin')
@section('title', 'Danh sách xuất kho')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('xuatkho.index') }}" class="tip-bottom">xuất kho</a></div>
  <h1>Danh sách xuất kho đang có</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
  <div class="row-fluid collapse{{ request()->all() ? 'in' : '' }}" id="adv_search">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-content" style="padding: 0px">
          <form class="form-horizontal" action="{{ route('xuatkho.index') }}" method="get">
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
                <a href="{{ route('xuatkho.index') }}" class="btn btn-danger span1">Hủy</a>
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
        <form action="{{ route('tool.xoabo') }}" method="post" id="dulieu_check_multi">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="widget-title"> 
          <span class="icon"><i class="icon-th"></i></span>
          <h5>Tất cả xuất kho</h5>
          <span class="mytool">
          <a class="btn btn-mini btn-info" href="{{ route('xuatkho.them') }}"><i class="icon-plus-sign"></i> Thêm mới</a>
          <a class="btn btn-mini btn-success" href="javascript::void(0);" data-toggle="collapse" data-target="#adv_search"><i class="icon-glass"></i></i> Lọc dữ liệu</a>
          </span>
        </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Mã xuất kho</th>
                  <th>Nhà phân phối</th>
                  <th>Tổng tiền</th>
                  <th>Tiền còn nợ</th>
                  <th>Ngày xuất</th>
                  <th width="230px">Công cụ</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $tongtien = 0; $tongtienno = 0;
                @endphp
                @foreach($all_xuatkho as $xuatkho)
                <tr>
                  <td>{{ $xuatkho->maxuatkho }}</td>
                  <td>{{ $xuatkho->nhaphanphoi->tennhaphanphoi }}</td>
                  <td>{{ number_format($xuatkho->tongtien) }}</td>
                   <td>{{ number_format($xuatkho->tongtien - $xuatkho->sotientratruoc) }}</td>
                  <td>{{ dinh_dang_ngay_gio($xuatkho->ngayxuatkho) }}</td>
                  <td>
                    <a href="{{ route('xuatkho.chitiet', $xuatkho->id) }}" class="btn btn-mini btn-info">chi tiết</a>
                    <button type="button" class="btn btn-mini btn-danger xacnhan" data-action="{{ route('tool.xoabo') }}" name="del_dulieu" data-value="{{ $xuatkho->id . '_' . 'xuatkho'}}">Xóa</button>
                    <a href="#myAlert" data-toggle="modal" class="btn btn-mini btn-success _linkCongNo" data-id="{{ $xuatkho->id }}">Công nợ</a>
                    <a href="javascript:;" class="btn btn-mini btn-primary _linkLichSuCongNo" data-id="{{ $xuatkho->id }}">Lịch sử công nợ</a>
                  </td>
                </tr>
                @php
                  $tongtien += $xuatkho->tongtien;
                  $tongtienno += ($xuatkho->tongtien - $xuatkho->sotientratruoc);
                @endphp
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2"><strong>Tổng tiền</strong></td>
                  <td colspan="1"><strong>{{ number_format($tongtien) }}</strong></td>
                  <td colspan="3"><strong>{{ number_format($tongtienno) }}</strong></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </form>
      </div>
  </div>
</div>
</div>
<div id="myAlert" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>Trả tiền cho hóa đơn xuất</h3>
  </div>
  <div class="modal-body">
    <p>Số tiền còn nợ của nhà phân phối (<span id="_txttennhaphanphoi" style="font-weight: bold; color: blue;"></span>) trong phiếu xuất này là <span id="_txtsotienconno"></span></p>
    <hr>
    <label>
    Nhập số tiền cần trả:
    <input type="text" id="_inputsotienconno" />
    <input type="hidden" id="_hiddenxuatkho_id">
    </label>
  </div>
  <div class="modal-footer"> 
  <a class="btn btn-primary _linktrano" href="#">Đồng ý</a> 
  <a data-dismiss="modal" class="btn" href="#">Hủy bỏ</a> </div>
</div>
<div id="_loadLichSuCongNo">
</div>
@endsection
@section('script')
<script src="{{ asset('js/admin/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/admin/matrix.tables.js') }}"></script> 
<script>
  var _inputsotienconno = $("#_inputsotienconno");
  var _txtsotienconno = $("#_txtsotienconno");
  var _hiddenxuatkho_id = $("#_hiddenxuatkho_id");
  _inputsotienconno.number(true, 0);

  $("._linkCongNo").click( function(){
    var xuatkho_id = $(this).data('id');
    _inputsotienconno.focus();
    $.ajax({
      url: "{{ route('tool.get.tien.no.xuat.kho') }}",
      type: "get",
      data: {
        xuatkho_id: xuatkho_id
      },
      dataType: "json",
      success: function(data)
      {
        if(data.status == 'err')
        {
          window.location = "{{ route('xuatkho.index') }}";
        }
        else
        {
          _inputsotienconno.val(data.sotienconno);
          _txtsotienconno.html(data.sotienconno);
          $("#_txttennhaphanphoi").html(data.nhaphanphoi.tennhaphanphoi);
          _hiddenxuatkho_id.val(xuatkho_id);
        }
      }    
    });
  });

  $("._linktrano").click(function(){
    $.ajax({
      url: "{{ route('tool.tra.no') }}",
      type: "post",
      data: {
        xuatkho_id: _hiddenxuatkho_id.val(),
        sotientra: _inputsotienconno.val(),
        _token: token_key
      },
      dataType: "json",
      success: function(data)
      {
        if(data.status == "err")
        {
          hopthongbao(data.msg, "{{ route('xuatkho.index') }}", "red");
          return;
        }

        if(data.status == "ok")
        {
          hopthongbao(data.msg, "{{ route('xuatkho.index') }}");
          return;
        }
      }
    });
  });

  $("._linkLichSuCongNo").click(function()
  {
    var xuatkho_id = $(this).data('id');
    $.ajax({
      url: "{{ route('tool.get.lich.su.cong.no') }}",
      type: "get",
      data: {
        xuatkho_id: xuatkho_id
      },
      dataType: "text",
      success: function(data)
      {
        if(data == 'err')
        {
          hopthongbao("Phiếu xuất này không có lịch sử công nợ nào");
          return;
        }
        else
        {
          $("#_loadLichSuCongNo").load('tool/get-lich-su-cong-no?xuatkho_id=' + xuatkho_id);
        }

      }
    });
  });
</script>
@endsection
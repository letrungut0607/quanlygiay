@extends('layouts.admin')
@section('title', 'Thêm tiền vốn mới')
@section('style')
<link rel="stylesheet" href="{{ asset('css/admin/bootstrap-datepicker.min.css') }}" type="text/css">
@endsection
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('tienvon.index') }}" class="tip-bottom">tiền vốn</a> <a href="#" class="current">Thêm mới</a> </div>
  <h1>Thêm tiền vốn</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
 <form action="{{ route('tienvon.them') }}" method="post" class="form-horizontal">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Thông tin tiền vốn</h5>
        </div>
        <div class="widget-content nopadding">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="control-group">
            <label class="control-label">Ngày thêm:</label>
            <div class="controls">
              <input type="text" name="ngaythem" class="span11" id="ngaythem" value="{{ old('ngaythem', date('d-m-Y')) }}" autofocus data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập ngày thêm">
              <span class="help-block form-error">{{ $errors->first('ngaythem') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Số tiền vốn:</label>
            <div class="controls">
              <input type="text" name="sotien" class="span11 txt_number" value="{{ old('sotien') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập số tiền vốn">
              <span class="help-block form-error">{{ $errors->first('sotien') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Ghi chú:</label>
            <div class="controls">
              <textarea name="ghichu" class="span11">{{ old('ghichu') }}</textarea>
              <span class="help-block form-error">{{ $errors->first('sotien') }}</span>
            </div>
          </div>

        </div>
      </div>
    </div>
    <center>
      <button type="submit" class="btn btn-success">Lưu lại</button>
      <a href="{{ route('tienvon.index') }}" class="btn btn-danger">Quay lại</a>
    </center>
  </div>
  </form>
</div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/admin/masked.js') }}"></script> 
<script src="{{ asset('js/admin/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/admin/bootstrap-datepicker.vi.min.js') }}"></script>
<script>
  $("#ngaythem").mask("99-99-9999");
  $('#ngaythem').datepicker({
    language: 'vi',
    format : 'dd-mm-yyyy',
  });

  $('.txt_number').number( true, 0 );

</script>
@endsection
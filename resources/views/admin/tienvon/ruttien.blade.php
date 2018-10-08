@extends('layouts.admin')
@section('title', 'Rút tiền')
@section('style')
<link rel="stylesheet" href="{{ asset('css/admin/bootstrap-datepicker.min.css') }}" type="text/css">
@endsection
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('tienvon.index') }}" class="tip-bottom">rút tiền</a> <a href="#" class="current">Thêm mới</a> </div>
  <h1>Rút tiền</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
 <form action="{{ route('tienvon.ruttien') }}" method="post" class="form-horizontal">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Thông tin rút tiền</h5>
        </div>
        <div class="widget-content nopadding">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="control-group">
            <label class="control-label">Ngày rút:</label>
            <div class="controls">
              <input type="text" name="ngayrut" class="span11" id="ngayrut" value="{{ old('ngayrut', date('d-m-Y')) }}" autofocus data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập ngày thêm">
              <span class="help-block form-error">{{ $errors->first('ngayrut') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Số tiền rút:</label>
            <div class="controls">
              <input type="text" name="sotien" class="span11 txt_number" value="{{ old('sotien') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập số tiền rút">
              <span class="help-block form-error">{{ $errors->first('sotien') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Ghi chú:</label>
            <div class="controls">
              <textarea name="ghichu" class="span11">{{ old('ghichu') }}</textarea>
              <span class="help-block form-error">{{ $errors->first('ghichu') }}</span>
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
  $("#ngayrut").mask("99-99-9999");
  $('#ngayrut').datepicker({
    language: 'vi',
    format : 'dd-mm-yyyy',
  });

  $('.txt_number').number( true, 0 );

</script>
@endsection
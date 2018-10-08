@extends('layouts.admin')
@section('title', 'Thêm nhà phân phối mới')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('nhaphanphoi.index') }}" class="tip-bottom">Nhà phân phối</a> <a href="#" class="current">Thêm mới</a> </div>
  <h1>Thêm nhà phân phối</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
 <form action="{{ route('nhaphanphoi.them') }}" method="post" class="form-horizontal">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Thông tin nhà phân phối</h5>
        </div>
        <div class="widget-content nopadding">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="control-group">
            <label class="control-label">Tên nhà phân phối:</label>
            <div class="controls">
              <input type="text" name="tennhaphanphoi" class="span11" value="{{ old('tennhaphanphoi') }}" autofocus data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập tên nhà phân phối từ 1 ký tự">
              <span class="help-block form-error">{{ $errors->first('tennhaphanphoi') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Tỉnh:</label>
            <div class="controls">
              <input type="text" name="tinh" class="span11" value="{{ old('tinh') }}" data-validation="length" data-validation-length="min3" data-validation-error-msg-length="Vui lòng nhập tỉnh từ 3 ký tự">
              <span class="help-block form-error">{{ $errors->first('tinh') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Huyện:</label>
            <div class="controls">
              <input type="text" name="huyen" class="span11" value="{{ old('huyen') }}" data-validation="length" data-validation-length="min3" data-validation-error-msg-length="Vui lòng nhập huyện từ 3 ký tự">
              <span class="help-block form-error">{{ $errors->first('huyen') }}</span>
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label">Số điện thoại:</label>
            <div class="controls">
              <input type="text" name="sodienthoai" class="span11" value="{{ old('sodienthoai') }}">
              <span class="help-block form-error">{{ $errors->first('sodienthoai') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Địa chỉ:</label>
            <div class="controls">
              <input type="text" name="diachi" class="span11" value="{{ old('diachi') }}">
              <span class="help-block form-error">{{ $errors->first('diachi') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Ghi chú:</label>
            <div class="controls">
              <textarea name="ghichu" class="span11" style="height: 80px">{{ old('ghichu') }}</textarea>
              <span class="help-block form-error">{{ $errors->first('ghichu') }}</span>
            </div>
          </div>

        </div>
      </div>
    </div>
    <center>
      <button type="submit" class="btn btn-success">Lưu lại</button>
      <a href="{{ route('nhaphanphoi.index') }}" class="btn btn-danger">Quay lại</a>
    </center>
  </div>
  </form>
</div>
</div>
@endsection
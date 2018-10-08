@extends('layouts.admin')
@section('title', 'Chỉnh sửa nhân viên mới')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('nhanvien.index') }}" class="tip-bottom">Nhân viên</a> <a href="#" class="current">Chỉnh sửa mới</a> </div>
  <h1>Chỉnh sửa nhân viên</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
 <form action="{{ route('nhanvien.sua', $nhanvien->id) }}" method="post" class="form-horizontal">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Thông tin nhân viên</h5>
        </div>
        <div class="widget-content nopadding">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
          <div class="control-group">
            <label class="control-label">Mã nhân viên:</label>
            <div class="controls">
              <input type="text" name="manhanvien" class="span11" value="{{ $nhanvien->manhanvien }}" autofocus data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập mã nhân viên từ 1 ký tự">
              <span class="help-block form-error">{{ $errors->first('manhanvien') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Tên nhân viên:</label>
            <div class="controls">
              <input type="text" name="tennhanvien" class="span11" value="{{ $nhanvien->tennhanvien }}" data-validation="length" data-validation-length="min3" data-validation-error-msg-length="Vui lòng nhập tên nhân viên từ 3 ký tự">
              <span class="help-block form-error">{{ $errors->first('tennhanvien') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Tài khoản đăng nhập:</label>
            <div class="controls">
              <input type="text" name="taikhoan" class="span11" value="{{ $nhanvien->taikhoan }}" data-validation="length" data-validation-length="min3" data-validation-error-msg-length="Vui lòng nhập tài khoản đăng nhập từ 3 ký tự">
              <span class="help-block form-error">{{ $errors->first('taikhoan') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Mật khẩu:</label>
            <div class="controls">
              <input type="password" name="password" class="span11" value="">
              <span class="help-block form-info">Để trống nếu không muốn thay đổi</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Nhập lại mật khẩu:</label>
            <div class="controls">
              <input type="password" name="repassword" class="span11" value="" data-validation="confirmation" data-validation-confirm="password" data-validation-error-msg="Mật khẩu lập lại không khớp">
              <span class="help-block form-error">{{ $errors->first('repassword') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Thuộc nhóm quyền:</label>
            <div class="controls">
              <select name="phanquyen" class="span11">
                <option value="0" selected>Nhân viên sản xuất</option>
                <option value="1" {{ $nhanvien->phanquyen == 1 ? 'selected' : '' }}>Quản trị</option>
              </select>
              <span class="help-block form-error">{{ $errors->first('phanquyen') }}</span>
            </div>
          </div>

        </div>
      </div>
    </div>
    <center>
      <button type="submit" class="btn btn-success">Lưu lại</button>
      <a href="{{ route('nhanvien.index') }}" class="btn btn-danger">Quay lại</a>
    </center>
  </div>
  </form>
</div>
</div>
@endsection
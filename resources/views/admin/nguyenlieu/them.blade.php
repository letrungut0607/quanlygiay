@extends('layouts.admin')
@section('title', 'Thêm nguyên liệu mới')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('nguyenlieu.index') }}" class="tip-bottom">Nguyên liệu</a> <a href="#" class="current">Thêm mới</a> </div>
  <h1>Thêm nguyên liệu</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
 <form action="{{ route('nguyenlieu.them') }}" method="post" class="form-horizontal">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Thông tin nguyên liệu</h5>
        </div>
        <div class="widget-content nopadding">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="control-group">
            <label class="control-label">Mã nguyên liệu:</label>
            <div class="controls">
              <input type="text" name="manguyenlieu" class="span11" value="{{ old('manguyenlieu', time()) }}" autofocus data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập nguyên liệu từ 1 ký tự">
              <span class="help-block form-error">{{ $errors->first('manguyenlieu') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Tên nguyên liệu:</label>
            <div class="controls">
              <input type="text" name="tennguyenlieu" class="span11" value="{{ old('tennguyenlieu') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập nguyên liệu từ 1 ký tự">
              <span class="help-block form-error">{{ $errors->first('tennguyenlieu') }}</span>
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label">Đơn vị tính:</label>
            <div class="controls">
              <input type="text" name="donvitinh" class="span11" value="{{ old('donvitinh') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập nguyên liệu từ 1 ký tự">
              <span class="help-block form-error">{{ $errors->first('donvitinh') }}</span>
            </div>
          </div>

        </div>
      </div>
    </div>
    <center>
      <button type="submit" class="btn btn-success">Lưu lại</button>
      <a href="{{ route('nguyenlieu.index') }}" class="btn btn-danger">Quay lại</a>
    </center>
  </div>
  </form>
</div>
</div>
@endsection
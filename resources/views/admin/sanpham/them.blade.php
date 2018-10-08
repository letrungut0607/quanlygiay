@extends('layouts.admin')
@section('title', 'Thêm sản phẩm mới')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('sanpham.index') }}" class="tip-bottom">Sản phẩm</a> <a href="#" class="current">Thêm mới</a> </div>
  <h1>Thêm sản phẩm</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
 <form action="{{ route('sanpham.them') }}" method="post" class="form-horizontal">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Thông tin sản phẩm</h5>
        </div>
        <div class="widget-content nopadding">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="control-group">
            <label class="control-label">Tên sản phẩm:</label>
            <div class="controls">
              <input type="text" name="tensanpham" class="span11" value="{{ old('tensanpham') }}" autofocus data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập tên sản phẩm từ 1 ký tự">
              <span class="help-block form-error">{{ $errors->first('tensanpham') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Loai sản phẩm:</label>
            <div class="controls">
              <select name="loaisanpham_id" class="span11">
                @foreach($all_loaisanpham as $loaisanpham)
                <option value="{{ $loaisanpham->id }}" {{ $loaisanpham->id == old('loaisanpham_id') ? 'selected' : '' }}>
                  {{ $loaisanpham->tenloai }}
                </option>
                @endforeach
              </select>
              <span class="help-block form-error">{{ $errors->first('tensanpham') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Giá sản phẩm:</label>
            <div class="controls">
              <input type="text" name="giasanpham" class="span11 price_number" value="{{ old('giasanpham') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập giá sản phẩm">
              <span class="help-block form-error">{{ $errors->first('giasanpham') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Số gói / thùng:</label>
            <div class="controls">
              <input type="text" name="sogoitrenthung" class="span11 price_number" value="{{ old('sogoitrenthung') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập số gói / thùng">
              <span class="help-block form-error">{{ $errors->first('sogoitrenthung') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Số tờ / gói:</label>
            <div class="controls">
              <input type="text" name="sototrengoi" class="span11 price_number" value="{{ old('sototrengoi') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập số tờ / gói">
              <span class="help-block form-error">{{ $errors->first('sototrengoi') }}</span>
            </div>
          </div>
          
          {{-- <div class="control-group">
            <label class="control-label">Khối lượng (kg):</label>
            <div class="controls">
              <input type="text" name="khoiluong" class="span11" value="{{ old('khoiluong') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập khối lượng sản phẩm">
              <span class="help-block form-error">{{ $errors->first('khoiluong') }}</span>
            </div>
          </div> --}}

        </div>
      </div>
    </div>
    <center>
      <button type="submit" class="btn btn-success">Lưu lại</button>
      <a href="{{ route('sanpham.index') }}" class="btn btn-danger">Quay lại</a>
    </center>
  </div>
  </form>
</div>
</div>
@endsection
@section('script')
<script>
  $('.price_number').number( true, 0 );
</script>
@endsection
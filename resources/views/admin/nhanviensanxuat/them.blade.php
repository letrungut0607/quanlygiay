@extends('layouts.admin')
@section('title', 'Thêm nhân viên sản xuất mới')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('nhanvien.index') }}" class="tip-bottom">Nhân viên sản xuất</a> <a href="#" class="current">Thêm mới</a> </div>
  <h1>Thêm nhân viên sản xuất</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
 <form action="{{ route('nhanviensanxuat.them') }}" method="post" class="form-horizontal">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Thông tin nhân viên sản xuất</h5>
        </div>
        <div class="widget-content nopadding">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
          <div class="control-group">
            <label class="control-label">Chọn nhân viên:</label>
            <div class="controls">
              <select name="nhanvien_id">
                @foreach($all_nhanvien as $nhanvien)
                <option value="{{ $nhanvien->id }}" {{ $nhanvien->id == old('nhanvien_id') ? 'selected' : '' }}>{{ $nhanvien->manhanvien }} - {{ $nhanvien->tennhanvien }}</option>
                @endforeach
              </select>
              <span class="help-block form-error">{{ $errors->first('nhanvien_id') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Chọn sản phẩm:</label>
            <div class="controls">
              <select name="sanpham_id">
                @foreach($all_sanpham as $sanpham)
                <option value="{{ $sanpham->id }}" {{ $sanpham->id == old('sanpham_id') ? 'selected' : '' }}>{{ $sanpham->tensanpham }}</option>
                @endforeach
              </select>
              <span class="help-block form-error">{{ $errors->first('sanpham_id') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Đơn giá:</label>
            <div class="controls">
              <input type="text" name="dongia" class="span11" id="_dongia" value="{{ old('dongia') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập đơn giá">
              <span class="help-block form-error">{{ $errors->first('dongia') }}</span>
            </div>
          </div>

        </div>
      </div>
    </div>
    <center>
      <button type="submit" class="btn btn-success">Lưu lại</button>
      <a href="{{ route('nhanviensanxuat.index') }}" class="btn btn-danger">Quay lại</a>
    </center>
  </div>
  </form>
</div>
</div>
@endsection
@section('script')
  <script>
    $('select').select2();
    $('#_dongia').number( true, 0 );
  </script>
@endsection
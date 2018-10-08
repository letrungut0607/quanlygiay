@extends('layouts.admin')
@section('title', 'Thêm sản xuất wallet mới')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('sanxuatwallet.index') }}" class="tip-bottom">sản xuất wallet</a> <a href="#" class="current">Thêm mới</a> </div>
  <h1>Thêm sản xuất wallet</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
 <form action="{{ route('sanxuatwallet.them') }}" method="post" class="form-horizontal">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Thông tin sản xuất wallet</h5>
        </div>
        <div class="widget-content nopadding">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
          <div class="control-group">
            <label class="control-label">Chọn nhân viên:</label>
            <div class="controls">
              @php
              if(!empty(old('nhanvien_id')))
                $old_nhanvien_id = old('nhanvien_id');
              @endphp
              <select name="nhanvien_id[]" multiple>
              @foreach($all_nhanvien as $nhanvien)
              <option value="{{ $nhanvien->id }}" @php if(isset($old_nhanvien_id) && in_array($nhanvien->id, $old_nhanvien_id)) echo 'selected' @endphp>
              {{ $nhanvien->manhanvien }} - {{ $nhanvien->tennhanvien }}
              </option>
              @endforeach
              </select>
              <span class="help-block form-error">{{ $errors->first('nhanvien_id') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Chọn sản phẩm:</label>
            <div class="controls">
              <select name="sanpham_id">
                @foreach ($all_sanpham as $sanpham)
                <option value="{{ $sanpham->id }}" {{ ($sanpham->id == old('sanpham_id') ? 'selected' : '') }}>{{ $sanpham->tensanpham }}</option>
                @endforeach
              </select>
              <span class="help-block form-error">{{ $errors->first('sanpham_id') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Số kg phôi sản xuất:</label>
            <div class="controls">
              <input type="text" name="sokg" class="span11" value="{{ old('sokg') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập số kg phôi sản xuất">
              <span class="help-block form-error">{{ $errors->first('sokg') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Chọn nguyên liệu:</label>
            <div class="controls">
              <select name="nguyenlieu_id">
                @foreach ($all_nguyenlieu as $nguyenlieu)
                <option value="{{ $nguyenlieu->id }}"  {{ ($nguyenlieu->id == old('nguyenlieu_id') ? 'selected' : '') }}>
                  {{ $nguyenlieu->manguyenlieu }} - {{ $nguyenlieu->tennguyenlieu }}
                </option>
                @endforeach
              </select>
              <span class="help-block form-error">{{ $errors->first('nguyenlieu_id') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Số gói sản xuất được:</label>
            <div class="controls">
              <input type="text" name="sogoisanxuatduoc" class="span11 txt_number" value="{{ old('sogoisanxuatduoc') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập số gói sản xuất được">
              <span class="help-block form-error">{{ $errors->first('sogoisanxuatduoc') }}</span>
            </div>
          </div>
          
          <div class="control-group">
            <label class="control-label">Số dãy sản xuất:</label>
            <div class="controls">
              <input type="text" name="sodaysanxuat" class="span11 txt_number" value="{{ old('sodaysanxuat') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập số dãy sản xuất wallet">
              <span class="help-block form-error">{{ $errors->first('sodaysanxuat') }}</span>
            </div>
          </div>

        </div>
      </div>
    </div>
    <center>
      <button type="submit" class="btn btn-success">Lưu lại</button>
      <a href="{{ route('sanxuatwallet.index') }}" class="btn btn-danger">Quay lại</a>
    </center>
  </div>
  </form>
</div>
</div>
@endsection
@section('script')
<script>
  $('select').select2();
  $('.txt_number').number( true, 0 );
</script>
@endsection
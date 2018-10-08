@extends('layouts.admin')
@section('title', 'Thêm sản xuất napkin mới')
@section('style')
<link rel="stylesheet" href="{{ asset('css/admin/bootstrap-datepicker.min.css') }}" type="text/css">
@endsection
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('sanxuatnapkin.index') }}" class="tip-bottom">sản xuất napkin</a> <a href="#" class="current">Thêm mới</a> </div>
  <h1>Thêm sản xuất napkin</h1>
</div>
<div class="container-fluid">
 @include('partials.alert-info')
 <form action="{{ route('sanxuatnapkin.them') }}" method="post" class="form-horizontal">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Thông tin sản xuất napkin</h5>
        </div>
        <div class="widget-content nopadding">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
          <div class="control-group">
          <label class="control-label">Chọn buổi:</label>
          <div class="controls controls-row">
            <select name="buoithuchien" class="span4">
              <option value="1">Buổi sáng</option>
              <option value="2">Buổi chiều</option>
              <option value="3">Buổi tối</option>
            </select>
            <span class="span2" style="padding-top: 5px;">Chọn ngày:</span>
            <input type="text" name="ngaysanxuat" class="span3" id="ngaysanxuat" value="{{ date('d-m-Y') }}">
          </div>
          <span class="help-block form-error">{{ $errors->first('ngaysanxuat') }}</span>
          <span class="help-block form-error">{{ $errors->first('buoithuchien') }}</span>
          </div>

          <div class="control-group">
            <label class="control-label">Chọn nhân viên:</label>
            <div class="controls">
              @php
                if(!empty(old('nhanvien_id')))
                  $old_nhanvien_id = old('nhanvien_id');
              @endphp
              <select name="nhanvien_id[]" id="chon_nhanvien" multiple>
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
            <label class="control-label">Số lượng tờ:</label>
            <div class="controls">
              <input type="text" name="soluongto" class="span11 txt_number" value="{{ old('soluongto') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập số lượng tờ">
              <span class="help-block form-error">{{ $errors->first('soluongto') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Số gói trên máy đếm:</label>
            <div class="controls">
              <input type="text" name="soluongtrenmaydem" class="span11 txt_number" value="{{ old('soluongtrenmaydem') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập số lượng máy đếm">
              <span class="help-block form-error">{{ $errors->first('soluongtrenmaydem') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Số gói thực tế:</label>
            <div class="controls">
              <input type="text" name="soluongthanhpham" class="span11 txt_number" value="{{ old('soluongthanhpham') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập số thùng / số gói">
              <span class="help-block form-error">{{ $errors->first('soluongthanhpham') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Số thùng:</label>
            <div class="controls">
              <input type="text" name="soluongthuctethung" class="span11 txt_number" value="{{ old('soluongthuctethung') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập số lượng thực tế(Thùng)">
              <span class="help-block form-error">{{ $errors->first('soluongthuctethung') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Số gói còn lại:</label>
            <div class="controls">
              <input type="text" name="sogoiconlai" class="span11 txt_number" value="{{ old('sogoiconlai') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập số gói còn lại">
              <span class="help-block form-error">{{ $errors->first('sogoiconlai') }}</span>
            </div>
          </div>

{{--           <div class="control-group">
            <label class="control-label">Số gram/gói:</label>
            <div class="controls">
              <input type="text" name="trongluong" class="span11 txt_number" value="{{ old('trongluong') }}" data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập số gram trên gói">
              <span class="help-block form-error">{{ $errors->first('trongluong') }}</span>
            </div>
          </div> --}}

        </div>
      </div>
    </div>
    <center>
      <button type="submit" class="btn btn-success">Lưu lại</button>
      <a href="{{ route('sanxuatnapkin.index') }}" class="btn btn-danger">Quay lại</a>
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
  $('select').select2();
  $("#ngaysanxuat").mask("99-99-9999");
  $('#ngaysanxuat').datepicker({
    language: 'vi',
    format : 'dd-mm-yyyy',
  });

  $('.txt_number').number( true, 0 );

</script>
@endsection
@extends('layouts.admin')
@section('title', 'Nhập kho mới')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('nhapkho.index') }}" class="tip-bottom">Nhập kho</a> <a href="#" class="current">Thêm mới</a> </div>
  <h1>Nhập kho mới</h1>
</div>
<div class="container-fluid">
  @if (count($errors) > 0)
  <div class="my-alert">
    <div class="alert alert-danger">
      <button class="close" data-dismiss="alert">×</button>
      @foreach ($errors->all() as $error)
      {{ $error }} <br>
      @endforeach
    </div>
  </div>
  @endif
  @include('partials.alert-info')
 <form action="{{ route('nhapkho.them') }}" method="post" class="form-horizontal">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Thông tin nhập kho</h5>
        </div>
        <div class="widget-content nopadding">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
          <div class="control-group">
            <label class="control-label">Nhân viên nhập kho:</label>
            <div class="controls">
              Nguyễn Hoàng Phút
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Mã nhập kho:</label>
            <div class="controls">
              <input type="text" name="manhapkho" class="span11" value="{{ old('manhapkho', time()) }}" autofocus data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng nhập mã nhập kho từ 1 ký tự">
              <span class="help-block form-error">{{ $errors->first('manhapkho') }}</span>
            </div>
          </div>

          <div id="append_nguyenlieu">
          @if (old('nguyenlieu_id'))
            @for ($i = 0; $i < count(old('nguyenlieu_id')); $i++)
                @php
                  $nguyenlieu_id = old('nguyenlieu_id');
                  $tennguyenlieu = old('tennguyenlieu');
                  $soluongnhap = old('soluongnhap');
                  $gianhap = old('gianhap');
                @endphp
                <div class="control-group"> 
                    <label class="control-label">{{ $tennguyenlieu[$i] }}</label>
                    <div class="controls controls-row">
                      <input type="hidden" name="nguyenlieu_id[]" class="nguyenlieu_id" value="{{ $nguyenlieu_id[$i] }}">
                      <input type="hidden" name="tennguyenlieu[]" class="tennguyenlieu" value="{{ $tennguyenlieu[$i] }}">
                      <input type="text" name="soluongnhap[]" class="span5 txt_number" placeholder="Số lượng nhập" data-validation="required" title="Số lượng nhập" value="{{ $soluongnhap[$i] }}">
                      <input type="text" name="gianhap[]" class="span5 price_number" data-validation="required" placeholder="Đơn giá nhập" title="Đơn giá nhập" value="{{ $gianhap[$i] }}">
                      <button class="span1 btn btn-danger xoadongmoi" type="button"><i class="icon-remove-sign"></i></button>
                    </div>
                </div>
            @endfor
          @endif
          @if (!empty($nhapkho_nguyenlieu))
            @foreach($nhapkho_nguyenlieu as $nguyenlieu)
            <div class="control-group"> 
                <label class="control-label">{{ $nguyenlieu['tennguyenlieu'] }}</label>
                <div class="controls controls-row">
                  <input type="hidden" name="nguyenlieu_id[]" class="nguyenlieu_id" value="{{ $nguyenlieu['id'] }}">
                  <input type="hidden" name="tennguyenlieu[]" class="tennguyenlieu" value="{{ $nguyenlieu['tennguyenlieu'] }}">
                  <input type="text" name="soluongnhap[]" class="span5 txt_number" placeholder="Số lượng nhập" data-validation="required" title="Số lượng nhập" value="">
                  <input type="text" name="gianhap[]" class="span5 price_number" data-validation="required" placeholder="Đơn giá nhập" title="Đơn giá nhập" value="">
                  <button class="span1 btn btn-danger xoadongmoi" type="button"><i class="icon-remove-sign"></i></button>
                </div>
            </div>
            @endforeach
          @endif
          </div>

          <div class="control-group">
            <label class="control-label">Ghi chú nhập kho:</label>
            <div class="controls">
              <textarea name="ghichunhapkho" placeholder="Ghi chú nhập kho nếu cần" class="span11">{{ old('ghichunhapkho') }}</textarea>
            </div>
          </div>
          
          <div class="control-group">
          <label class="control-label">Tìm kiếm nhanh nguyên liệu:</label>
           <div class="controls">
              <select name="select_nguyenlieu_id" multiple class="chon_nguyenlieu">
                @foreach ($all_nguyenlieu as $nguyenlieu)
                  <option value="{{ $nguyenlieu->id }}">{{ $nguyenlieu->tennguyenlieu }}</option>
                @endforeach
              </select>
           </div>
          </div>

        </div>
      </div>
    </div>
    <center>
      <button type="submit" class="btn btn-success" id="save_nhaphang">Lưu lại</button>
      <a href="{{ route('nhapkho.index') }}" class="btn btn-danger">Quay lại</a>
    </center>
  </div>
  </form>
</div>
</div>
@endsection
@section('script')
<script>
  $('select').select2();
  $(document).on('click', '.xoadongmoi', function(event) {
    var target = $(event.target),
        row = target.closest('.control-group');
      row.remove();
  });

  $(".chon_nguyenlieu").change(function() {
      var giatri_chon = $(this).select2("data");
      new_giatri_chon = $(this).select2("data")[giatri_chon.length-1];
      if(giatri_chon == '---Chọn---')
        return;

      var tennguyenlieu = new_giatri_chon.text;
      var nguyenlieu_id = new_giatri_chon.id;
      var check = true;
      $.each($('.nguyenlieu_id'),function(){
        if($(this).val() == nguyenlieu_id)
          check = false;
      });

      if(check ==  true)
      {
        $('#append_nguyenlieu').append('<div class="control-group"> <label class="control-label">'+tennguyenlieu+':</label><div class="controls controls-row"> <input type="hidden" name="nguyenlieu_id[]" class="nguyenlieu_id" value="'+nguyenlieu_id+'"/> <input type="hidden" name="tennguyenlieu[]" class="tennguyenlieu" value="'+tennguyenlieu+'"/> <input type="text" name="soluongnhap[]"  class="span5 txt_number" placeholder="Số lượng nhập" title="Số lượng nhập" data-validation="required"/> <input type="text" name="gianhap[]" class="span5 price_number" placeholder="Đơn giá nhập" title="Đơn giá nhập" data-validation="required"/><button class="span1 btn btn-danger xoadongmoi" type="button"><i class="icon-remove-sign"></i></button></div></div>');
          $('.price_number').number( true, 0 );
          $('.txt_number').number( true, 0 );
          $('.txt_number_doigiaban').number( true, 0 );
          $('.txt_number').focus();
          $('#checkbox_doigiaban_'+nguyenlieu_id).uniform();
      }
      else
      {
        check = false;
      }

       
  });

  $('.price_number').number( true, 0 );
  $('.txt_number').number( true, 0 );

</script>
@endsection
@extends('layouts.admin')
@section('title', 'Xuất kho mới')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="{{ route('admin.dashboard') }}" title="Trang chủ" class="tip-bottom"><i class="icon-home"></i> Trang chủ</a> <a href="{{ route('xuatkho.index') }}" class="tip-bottom">Xuất kho</a> <a href="#" class="current">Thêm mới</a> </div>
  <h1>Xuất kho mới</h1>
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
 <form action="{{ route('xuatkho.them') }}" method="post" class="form-horizontal">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Thông tin xuất kho</h5>
        </div>
        <div class="widget-content nopadding">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          
          <div class="control-group">
          <label class="control-label">Nhà phân phối:</label>
           <div class="controls">
              <select name="nhaphanphoi_id">
                @foreach ($all_nhaphanphoi as $nhaphanphoi)
                  <option value="{{ $nhaphanphoi->id }}">{{ $nhaphanphoi->tennhaphanphoi }}</option>
                @endforeach
              </select>
           </div>
          </div>

          <div class="control-group">
            <label class="control-label">Mã xuất kho:</label>
            <div class="controls">
              <input type="text" name="maxuatkho" class="span11" value="{{ old('maxuatkho', time()) }}" autofocus data-validation="length" data-validation-length="min1" data-validation-error-msg-length="Vui lòng xuất mã xuất kho từ 1 ký tự">
              <span class="help-block form-error">{{ $errors->first('maxuatkho') }}</span>
            </div>
          </div>

          <div id="append_sanpham">
          @if (old('sanpham_id'))
            @for ($i = 0; $i < count(old('sanpham_id')); $i++)
                @php
                  $sanpham_id = old('sanpham_id');
                  $tensanpham = old('tensanpham');
                  $soluongxuat = old('soluongxuat');
                  $soluongdaytrenthung = old('soluongdaytrenthung');
                  $giaxuat = old('giaxuat');
                @endphp
                <div class="control-group"> 
                    <label class="control-label">{{ $tensanpham[$i] }}</label>
                    <div class="controls controls-row">
                      <input type="hidden" name="sanpham_id[]" class="sanpham_id" value="{{ $sanpham_id[$i] }}">
                      <input type="hidden" name="tensanpham[]" class="tensanpham" value="{{ $tensanpham[$i] }}">
                      <input type="text" name="soluongxuat[]" class="span4 txt_number" placeholder="Số lượng thùng" data-validation="required" title="Số lượng thùng" value="{{ $soluongxuat[$i] }}">
                      <input type="text" name="giaxuat[]" class="span3 price_number" data-validation="required" placeholder="Đơn giá xuất" title="Đơn giá xuất" value="{{ $giaxuat[$i] }}">
                      <button class="span1 btn btn-danger xoadongmoi" type="button"><i class="icon-remove-sign"></i></button>
                    </div>
                </div>
            @endfor
          @endif
          @if (!empty($xuatkho_sanpham))
            @foreach($xuatkho_sanpham as $sanpham)
            <div class="control-group"> 
                <label class="control-label">{{ $sanpham['tensanpham'] }}</label>
                <div class="controls controls-row">
                  <input type="hidden" name="sanpham_id[]" class="sanpham_id" value="{{ $sanpham['id'] }}">
                  <input type="hidden" name="tensanpham[]" class="tensanpham" value="{{ $sanpham['tensanpham'] }}">
                  <input type="text" name="soluongxuat[]" class="span4 txt_number" placeholder="Số lượng thùng" data-validation="required" title="Số lượng thùng" value="">
                  <input type="text" name="giaxuat[]" class="span3 price_number" data-validation="required" placeholder="Đơn giá xuất" title="Đơn giá xuất" value="">
                  <button class="span1 btn btn-danger xoadongmoi" type="button"><i class="icon-remove-sign"></i></button>
                </div>
            </div>
            @endforeach
          @endif
          </div>

          <div class="control-group">
            <label class="control-label">Số tiền trả trước:</label>
            <div class="controls">
              <input type="text" name="sotientratruoc" placeholder="Số tiền trả trước" class="span11 txt_number" value="{{ old('sotientratruoc') }}">
               <span class="help-block form-error">{{ $errors->first('sotientratruoc') }}</span>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label">Ghi chú xuất kho:</label>
            <div class="controls">
              <textarea name="ghichuxuatkho" placeholder="Ghi chú xuất kho nếu cần" class="span11">{{ old('ghichuxuatkho') }}</textarea>
            </div>
          </div>
          
          <div class="control-group">
          <label class="control-label">Tìm kiếm nhanh sản phẩm:</label>
           <div class="controls">
              <select name="select_sanpham_id" multiple class="chon_sanpham">
                @foreach ($all_sanpham as $sanpham)
                  <option value="{{ $sanpham->id }}">{{ $sanpham->tensanpham }}</option>
                @endforeach
              </select>
           </div>
          </div>

        </div>
      </div>
    </div>
    <center>
      <button type="submit" class="btn btn-success" id="save_xuatkho">Lưu lại</button>
      <a href="{{ route('xuatkho.index') }}" class="btn btn-danger">Quay lại</a>
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

  $(".chon_sanpham").change(function() {
      var giatri_chon = $(this).select2("data");
      new_giatri_chon = $(this).select2("data")[giatri_chon.length-1];
      if(giatri_chon == '---Chọn---')
        return;

      var tensanpham = new_giatri_chon.text;
      var sanpham_id = new_giatri_chon.id;
      var check = true;
      $.each($('.sanpham_id'),function(){
        if($(this).val() == sanpham_id)
          check = false;
      });

      if(check ==  true)
      {
        $('#append_sanpham').append('<div class="control-group"> <label class="control-label">'+tensanpham+':</label><div class="controls controls-row"> <input type="hidden" name="sanpham_id[]" class="sanpham_id" value="'+sanpham_id+'"/> <input type="hidden" name="tensanpham[]" class="tensanpham" value="'+tensanpham+'"/> <input type="text" name="soluongxuat[]"  class="span4 txt_number" placeholder="Số lượng thùng" title="Số lượng thùng" data-validation="required"/>  <input type="text" name="giaxuat[]" class="span3 price_number" placeholder="Đơn giá xuất" title="Đơn giá xuất" data-validation="required"/><button class="span1 btn btn-danger xoadongmoi" type="button"><i class="icon-remove-sign"></i></button></div></div>');
          $('.price_number').number( true, 0 );
          $('.txt_number').number( true, 0 );
          $('.txt_number_doigiaban').number( true, 0 );
          $('.txt_number').focus();
          $('#checkbox_doigiaban_'+sanpham_id).uniform();
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
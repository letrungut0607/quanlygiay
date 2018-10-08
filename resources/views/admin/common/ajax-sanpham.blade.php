<div class="control-group">
  <label class="control-label">Chọn sản phẩm:</label>
  <div class="controls">
    <select name="sanpham_id">
      @foreach($all_nhanviensanxuat as $nhanviensx)
      <option value="{{ $nhanviensx->sanpham->id }}">
      {{  $nhanviensx->sanpham->tensanpham }} - {{  number_format($nhanviensx->dongia) }}
      </option>
      @endforeach
    </select>
    <span class="help-block form-error">{{ $errors->first('sanpham_id') }}</span>
  </div>
</div>
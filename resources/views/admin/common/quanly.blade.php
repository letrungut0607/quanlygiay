@extends('layouts.admin')
@section('title', 'Trang chủ')
@section('style')
<link rel="stylesheet" href="{{ asset('css/admin/bootstrap-datepicker.min.css') }}" type="text/css">
@endsection
@section('content')
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="" class="tip-bottom"><i class="icon-home"></i> Xin chào bạn đến với hệ thống quản lý</a></div>
  </div>
<!--End-breadcrumbs-->
  <div class="container-fluid">   
    <div class="row-fluid"  style="margin-top: 5px;">
      @if(Auth::user()->phanquyen === 1)
      <div class="widget-box widget-plain">
        <div class="center">
          <ul class="stat-boxes2">
            <li>
              <div class="left peity_line_neutral"><span>
                <span class="bar-list">5,3,9,6,5,9,7,3,5,2</span>
                </span></div>
              <div class="right"> 
                <a href="{{ route('xuatkho.index') }}">
                  <strong>{{ App\Models\Xuatkho::count() }}</strong> Xuất kho 
                </a>
              </div>
            </li>
            <li>
              <div class="left peity_bar_neutral"><span>
                <span class="bar-list">5,3,9,6,5,9,7,3,5,2</span>
                </span></div>
              <div class="right"> 
                <a href="{{ route('sanpham.index') }}">
                  <strong>{{ App\Models\Sanpham::count() }}</strong> Sản phẩm 
                </a>
              </div>
            </li>
            <li>
              <div class="left peity_line_good"><span>
                <span class="bar-list">5,3,9,6,5,9,7,3,5,2</span>
                </span></div>
              <div class="right"> 
                <a href="{{ route('nhaphanphoi.index') }}">
                  <strong>{{ App\Models\Nhaphanphoi::count() }}</strong>Nhà phân phối
                </a>
              </div>
            </li>
            <li>
              <div class="left peity_bar_neutral"><span>
                <span class="bar-list">5,3,9,6,5,9,7,3,5,2</span>
                </span></div>
              <div class="right"> 
                <a href=""{{ route('nhapkho.index') }}>
                  <strong>{{ App\Models\Nhapkho::count() }}</strong> Nhập kho
                </a>
              </div>
            </li>
            <li>
              <div class="left peity_bar_bad"><span>
                <span class="bar-list">5,3,9,6,5,9,7,3,5,2</span>
                </span></div>
              <div class="right"> 
                <a href="{{ route('nhanvien.index') }}">
                  <strong>{{ App\Models\Nhanvien::count() }}</strong> Nhân viên
                </a>
              </div>
            </li>
            <li>
              <div class="left peity_line_good"><span>
                <span class="bar-list">5,3,9,6,5,9,7,3,5,2</span>
                </span></div>
              <div class="right"> 
                <a href="{{ route('nguyenlieu.index') }}">
                  <strong>{{ App\Models\Nguyenlieu::count() }}</strong> Nguyên liệu
                </a> 
              </div>
            </li>
          </ul>
        </div>
      </div>
      @endif

      <div class="alert alert-info alert-block">
      <h4 class="alert-heading">Xin chào bạn! {{ Auth::user()->tennhanvien }}</h4>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/admin/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/admin/bootstrap-datepicker.vi.min.js') }}"></script>
<script src="{{ asset('js/admin/jquery.peity.min.js') }}"></script>

<script>
  $(".bar-list").peity("bar");
</script>
@endsection
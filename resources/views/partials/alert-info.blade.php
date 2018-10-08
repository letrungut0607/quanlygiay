@if (session('thongbao'))
<div class="my-alert">
   @if ((session('danger')))
   <div class="alert alert-danger">
   @else
   <div class="alert alert-success">
   @endif
     <button class="close" data-dismiss="alert">×</button>
     <b>Thông báo!</b> {{ session('thongbao') }}
  </div>
</div>
@endif

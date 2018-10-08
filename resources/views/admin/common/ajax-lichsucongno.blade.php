<div id="myModal" class="modal hide">
  <div class="modal-header">
    <button data-dismiss="modal" class="close" type="button">×</button>
    <h3>{{ $msg }}</h3>
  </div>
  <div class="modal-body">
    <table class="table table-bordered data-table">
		  <thead>
		    <tr>
		      <th>Số tiền đã trả</th>
		      <th>Ngày trả</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach ($all_lichsucongno as $lichsucongno)
		  	<tr>
		  		<td>{{ number_format($lichsucongno->sotiendatra) }}</td>
		  		<td>{{ dinh_dang_ngay_gio($lichsucongno->ngaytra) }}</td>
		  	</tr>
		  	@endforeach
		  </tbody>
	  </table>
  </div>
  <div class="modal-footer"> 
  <a data-dismiss="modal" class="btn" href="#">Đóng</a> </div>
</div>

<script type="text/javascript">
  $('#myModal').modal('show');
</script>
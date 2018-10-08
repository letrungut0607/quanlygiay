
$(document).ready(function(){
	
	$('.data-table').dataTable({
		"language": {
      "lengthMenu": "Hiển thị trên trang _MENU_",
      "zeroRecords": "Không tìm thấy dữ liệu",
      "info": "Hiển thị (_PAGE_ / _PAGES_) trang",
      "infoEmpty": "Không có dữ liệu",
      "infoFiltered": "(Tìm kiếm từ _MAX_ dòng)",
      "search":         "Tìm kiếm: ",
      "paginate": {
          "first":      "Trang đầu",
          "last":       "Trang cuối",
          "next":       "Trang kế",
          "previous":   "Trang trước"
          },
      },
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>'
	});
	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
		
});

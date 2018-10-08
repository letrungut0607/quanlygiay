$.fn.editable.defaults.ajaxOptions = {type: "post"};

$('.soluong_mua').editable({
  disabled: false,
	params: function(params) {
	   params._token = token_key;
	   params.suasoluong = true;
	   params.sanpham_id = $(this).data('sanphamid');
	   return params;
	},

  success: function(response, newValue) {
    if(!response.success)
    {
      $.alert({
        title: 'Đã xảy ra lỗi trong quá trình thực hiện',
        content: response.msg_txt,
        boxWidth: '500px',
        useBootstrap: false,
        icon: 'icon-warning-sign',
        type: "red",
      });

      return false;
    }
    else
    {
      $(this).attr('data-value', newValue); 
      $('#_tongtien').text(response.tongtien);
      $(this).parents('._chitietdonhang').find('._thanhtien').text(response.thanhtien);
    }
  },

  validate: function(value) {
    if(value <= 0) {
      return 'Số lượng không thể nhỏ hơn hoặc bằng 0';
    }
  }

});

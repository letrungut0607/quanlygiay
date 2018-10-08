 href_multi = $('.select2_sanpham').data('href');
 multiple_select = $('.select2_sanpham').attr('multiple');
 multiple_select == 'undefined' ? false : true;

 $('.select2_sanpham').select2({
    placeholder: 'Nhập tên sản phẩm để tìm kiếm',
    multiple: multiple_select,
    minimumInputLength: 3,
     ajax: {
        url: href_multi,
        dataType: 'json',
        data: function (term, page) {
          return { key_search: term };
       },
       results: function (data, page) {
          return { results: data };
       },
    },
    initSelection : function (element, callback) {

      var list_data = [];
      $(element.val().split(",")).each(function () {

        return $.get(href_multi, 
        { 
          sanpham_id: this
        }, 
        function (data) {
          list_data.push(data[0]);
          callback(list_data);
        });

      });
    }
});

href_one = $('.select2_motsanpham').data('href');
$('.select2_motsanpham').select2({
    placeholder: 'Nhập tên sản phẩm để tìm kiếm',
    multiple: false,
    minimumInputLength: 3,
    allowClear: true,
     ajax: {
        url: href_one,
        dataType: 'json',
        data: function (term, page) {
          return { key_search: term };
       },
       results: function (data, page) {
          return { results: data };
       },
    },
    initSelection : function (element, callback) {
      id = $(element).val();
      if(id !== "")
      {
        return $.get(href_one, 
        { 
          sanpham_id: id
        }, 
        function (data) {
          callback(data[0]);
        }); 
      }
    }
});

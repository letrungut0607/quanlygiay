function xacnhan_redirect(url) {
  $.confirm({
    title: 'Xác nhận',
    content: 'Bạn có chắc chắn không?',
    autoClose: 'cancelAction|3000',
    type: "red",
    typeAnimated: true,
    boxWidth: '500px',
    useBootstrap: false,
    icon: 'icon-warning-sign',
    buttons: 
    {
      'Đồng ý': function(){
        window.location = url;
      },
      cancelAction:  
      {
        text: 'Tự động hủy sau ',
        action: function () {}
      }
    }
  });
}

token_key = $('#token_key').val();
$('.xacnhan').click(function(event){
    action = $(this).data('action');
    value = $(this).data('value');
    name = $(this).attr('name');
    $.confirm({
        title: 'Xác nhận dữ liệu!',
        content: 'Bạn có chắc chắn không ?' +
        '<form action="'+action+'" id="del_dulieu_check" method="post">' + 
        '<input type="hidden" name="'+name+'" value="'+value+'" />' +
        '<input type="hidden" name="_token" value="'+token_key+'" />' 
        + '</form>',
        autoClose: 'cancelAction|3000',
        typeAnimated: true,
        boxWidth: '500px',
        useBootstrap: false,
        icon: 'icon-warning-sign',
        type: "red",
        buttons: {
            formSubmit: {
                btnClass: 'btn-red',
                text: 'Đồng ý',
                action: function () {
                    $("#del_dulieu_check").submit();
                }
            },
            'Hủy bỏ': {
                btnClass: 'btn-blue',
                action: function () {
                }
            },
            cancelAction:  
            {
              text: 'Tự động hủy sau ',
              btnClass: 'btn-blue',
              action: function () {}
            }
        },
    });
});

$('.xacnhan_multi').click(function(event){
    var list_value = [];
    $.each($("input[name='ckb_dulieu[]']:checked"), function(){            
        list_value.push($(this).val());
    });

    if(list_value.length == 0)
    {
        $.alert({
            title: 'Lỗi khi thực hiện!',
            content: 'Bạn chưa chọn dòng nào cần thực hiện',
            boxWidth: '250px',
            useBootstrap: false,
            typeAnimated: true,
            icon: 'icon-warning-sign',
            type: "red",
        });
        return false;
    }

    $.confirm({
        title: 'Xác nhận dữ liệu!',
        content: 'Bạn có chắc chắn chọn '+list_value.length+' dòng không ?',
        autoClose: 'cancelAction|3000',
        typeAnimated: true,
        boxWidth: '500px',
        useBootstrap: false,
        icon: 'icon-warning-sign',
        type: "red",
        buttons: {
            formSubmit: {
                btnClass: 'btn-red',
                text: 'Đồng ý',
                action: function () {
                    $("#dulieu_check_multi").submit();
                }
            },
            'Hủy bỏ': {
                btnClass: 'btn-blue',
                action: function () {
                }
            },
            cancelAction:  
            {
              text: 'Tự động hủy sau ',
              btnClass: 'btn-blue',
              action: function () {}
            }
        },
    });
});

$("span.icon input:checkbox, th input:checkbox").click(function() {
    var checkedStatus = this.checked;
    var checkbox = $(this).parents('.widget-box').find('tr td:first-child input:checkbox');     
    checkbox.each(function() {
        this.checked = checkedStatus;
        if (checkedStatus == this.checked) {
            $(this).closest('.checker > span').removeClass('checked');
            $(this).parents('.gradeX').find("td:first-child").removeClass('bgcolor_check');
        }
        if (this.checked) {
            $(this).closest('.checker > span').addClass('checked');
            $(this).parents('.gradeX').find("td:first-child").addClass('bgcolor_check');
        }
    });
});

$("table tr td:first-child input:checkbox").click(function(){
    $(this).parents('.gradeX').find("td:first-child").toggleClass('bgcolor_check');
    parent_check = $("span.icon input:checkbox, th input:checkbox");
});
    
$(document).ready(function() {
    window.setTimeout(function() {
        $(".my-alert").fadeTo(1500, 0.4).slideUp(1500, function() {
            $(this).remove()
        })
    }, 3000);
});

$.validate({
     lang: 'vi',
     modules : 'security'
  });

$(function() {     
    page_name = location.pathname.split('/');
    page_thongke = page_name[2];
    page_name = '/' + page_name[1] + '/' + page_name[2];
    pgurl = location.protocol + "//" + location.host + page_name;

    if(page_thongke == 'thong-ke')
    {
        pgurl_thongke = location.pathname.split('/');
        page_name_thongke = '/' + pgurl_thongke[1] + '/' + pgurl_thongke[2] + '/' + pgurl_thongke[3];
        pgurl = location.protocol + "//" + location.host + page_name_thongke;
    }

    if(page_thongke == 'quan-ly-luong')
    {
        pgurl_thongke = location.pathname.split('/');
        page_name_thongke = '/' + pgurl_thongke[1] + '/' + pgurl_thongke[2] + '/' + pgurl_thongke[3];
        pgurl = location.protocol + "//" + location.host + page_name_thongke;
    }

    $(".sidebar-nav a").each(function(){
      if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
        $(this).parents('.mymenu').addClass("active");
      if($(this).attr("href") == pgurl)
        $(this).addClass("active-open-menu");
    });
});

$('input[type=checkbox],input[type=radio],input[type=file]').uniform();

function change_hienthi(link)
{
    show_row = $('#_change_hienthi').val();
    window.location = link + show_row;
}

$('form').attr('autocomplete', 'off');

function hopthongbao(msg, url, type = "blue") {
    $.confirm({
    title: 'Thông báo',
    content: msg,
    typeAnimated: true,
    boxWidth: '300px',
    useBootstrap: false,
    type: type,
    buttons: 
    {
      'Đồng ý': function(){
        if(url)
          window.location = url;
      },
    }
  });
}

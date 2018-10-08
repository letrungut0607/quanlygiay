ajax_url = $('.auto-search-sp').data('url');
$('.auto-search-sp').autocomplete({
    minLength: 3,
    source: function (request, response) {
    $.ajax({
      type: "POST",
      url: ajax_url,
      data: {
        'term' : request.term,
        '_token' : token_key,
        'theloai_id' : $('#main-search-key').val()
      },
      dataType: "json",
      success: response
    });
  },
}).autocomplete( "instance" )._renderItem = function( ul, item ) 
{
  return $( "<li>" )
    .append( "<div><img src='"+item.img+"' width='30px' height='auto'/> <b>" + item.label + "</b><br><small style='margin-left:30px'>" + item.desc + "</small></div>" )
    .appendTo( ul );
};
function ajax_char(char,target){
	$(target).load('?action=char&char_id='+char+'&ajax=1',function(){$('#loader').hide('slow');$(target).slideDown('slow')});
} 

function add_bookmark(id,name){
	$('.ajax_fav_load').append("<a href='?action=info&char="+id+"'>"+name+"</a><br>");
	$(this).load('?action=bookmarks&name='+name+'&id='+id);
}                    
function ajax_chars(char){
	$('#ajax').load('?action=accounts&C='+char+'&ajax=1');
}
function ajax_player(char){
	$('#ajax').load('?action=charlist&C='+char+'&ajax=1');
	
}

function add_bookmark(id,name){
	$('.ajax_fav_load').append("<a href='?action=info&char="+id+"'>"+name+"</a><br>");
	$(this).load('?action=bookmarks&name='+name+'&id='+id);
}                
   
function add_item(text)
{
	 $('#iid').val(text); 
}                                 

$('.fademe').click(function(){
    $(this).fadeOut('slow'); 
});

function getCookie(name) {
	var cookie = " " + document.cookie;
	var search = " " + name + "=";
	var setStr = null;
	var offset = 0;
	var end = 0;
	if (cookie.length > 0) {
		offset = cookie.indexOf(search);
		if (offset != -1) {
			offset += search.length;
			end = cookie.indexOf(";", offset)
			if (end == -1) {
				end = cookie.length;
			}
			setStr = unescape(cookie.substring(offset, end));
		}
	}
	return(setStr);
}

if(getCookie('hide')=='true') {
	$('#hidetopmenu').slideUp('slow');
	$('#sm').slideDown();
	$('#hm').slideUp();
} else {
	$('#hidetopmenu').slideToggle('slow');
}

$('#sm').click(function () { 
      $('#hidetopmenu').slideDown('slow');
      document.cookie="hide=false;";
      $('#hm').slideToggle('slow');
      $(this).slideToggle();
      return false;
    });
    
$('#hm').click(function () { 
      $('#hidetopmenu').slideUp('slow');
      $('#sm').slideToggle('slow');
      $(this).slideToggle();
      document.cookie="hide=true;";
      return false;
    });

function destroy_div(target){
	$(target).slideUp('slow',function(){$(target).text('');});
}

// Show AJAX Preloader
$('#loader').ajaxComplete(function() {
  $(this).fadeOut('slow');
});

$('#loader').ajaxSend(function() {
  $(this).fadeIn('slow');
});


// chardata.tpl
$('.levels').change(function(){
	$('.level').val($('.levels').val());

});
//
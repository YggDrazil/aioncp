	$(document).ready(function(){
		//-- Hide tooltip on close
		//
		
		$('.toolTip .close').click(function(){
			$(this.parentNode).fadeOut(function(){
				$(this).remove();
			});
		});
		
		$('.loginajax').click(function(){
	 	$('.wait').show();
		$.post("?action=ajax_login_check", { login: $('#login').val(), password: $('#password').val()},
		   function(data){
		   		$('.wait').hide();
		     	if(data == "y") {
					window.location = "index.php";
		     	 } else{
		     	 	$('.ajax_div').show();
		     	 	$('.ajax_msg>p>span').html(data);
	
		     	 }
		   }); 	
	  	
	  	return false;
	 });
 
	});
	
	 
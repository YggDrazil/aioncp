$('.click_signal').click(function(){
	signal=$(this).attr('signal');
	$.getScript(signal);
});

$('.hover_signal').hover(function(){
	signal=$(this).attr('signal');
	$.getScript(signal);	
})

$('.keyup_signal').keyup(function(){
	signal=$(this).attr('signal');
	$.getScript(signal);
})
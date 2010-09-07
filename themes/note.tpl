<div id="markdown">
    {$note}
</div>
<div id="marks" class="hideme">
    <textarea id="markdown_source" class="sTextarea" style="width:100%" rows="10"></textarea>
    <br>
    <input type="button" value="{$lang.save}"  class="butDef" id="save_note"/>
     <a href="javascript:;" id='cancelnote'>{$lang.cancel}</a>
</div>
<a href="javascript:;" id="editnote"><img src="{$smarty.const.TPL_URL}i/edit.png" /></a>
<a href="javascript:;" id="refrash_note"><img src="{$smarty.const.TPL_URL}i/refresh.png" /></a>

<div id='ajax_msg'></div>
<script>
{literal}
    $('#editnote').click(function(){
        $('#marks').show();
        $('#markdown').hide();
        $('#markdown_source').load('index.php?action=note&show=2');
        $(this).hide();

    });
    
    $('#markdown').dblclick(function(){
        $('#marks').show();
        $('#markdown').hide();
        $('#markdown_source').load('index.php?action=note&show=2');
        $(this).hide();   

    });

    $('#refrash_note').click(function(){
        $('#markdown').load('index.php?action=note&show=1');
    });

	$('#cancelnote').click(function(){
             $('#markdown').load('index.php?action=note&show=1');
             $('#markdown').show();
             $('#marks').hide();
             $('#editnote').show();		
	
	});
	
	
    $('#save_note').click(function(){
        var markdown_source=$('#markdown_source').val();

        $.ajax({
           type: "POST",
           url: "index.php?action=note",
           data: "note="+markdown_source,
           success: function(msg){
           	 $('#ajax_msg').text(msg);
             $('#markdown').load('index.php?action=note&show=1');
             $('#markdown').show();
             $('#marks').hide();
             $('#editnote').show();	
             var t=setTimeout("$('#ajax_msg').text('')",3000);
           }
         });


    });
    
{/literal}
</script>
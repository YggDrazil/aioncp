<?php /* Smarty version 2.6.26, created on 2010-08-18 20:12:49
         compiled from note.tpl */ ?>
<div id="markdown">
    <?php echo $this->_tpl_vars['note']; ?>

</div>
<div id="marks" class="hideme">
    <textarea id="markdown_source" class="sTextarea" style="width:100%" rows="10"></textarea>
    <br>
    <input type="button" value="<?php echo $this->_tpl_vars['lang']['save']; ?>
"  class="butDef" id="save_note"/>
     <a href="javascript:;" id='cancelnote'><?php echo $this->_tpl_vars['lang']['cancel']; ?>
</a>
</div>
<a href="javascript:;" id="editnote"><img src="<?php echo @TPL_URL; ?>
i/edit.png" /></a>
<a href="javascript:;" id="refrash_note"><img src="<?php echo @TPL_URL; ?>
i/refresh.png" /></a>

<div id='ajax_msg'></div>
<script>
<?php echo '
    $(\'#editnote\').click(function(){
        $(\'#marks\').show();
        $(\'#markdown\').hide();
        $(\'#markdown_source\').load(\'index.php?action=note&show=2\');
        $(this).hide();

    });
    
    $(\'#markdown\').dblclick(function(){
        $(\'#marks\').show();
        $(\'#markdown\').hide();
        $(\'#markdown_source\').load(\'index.php?action=note&show=2\');
        $(this).hide();   

    });

    $(\'#refrash_note\').click(function(){
        $(\'#markdown\').load(\'index.php?action=note&show=1\');
    });

	$(\'#cancelnote\').click(function(){
             $(\'#markdown\').load(\'index.php?action=note&show=1\');
             $(\'#markdown\').show();
             $(\'#marks\').hide();
             $(\'#editnote\').show();		
	
	});
	
	
    $(\'#save_note\').click(function(){
        var markdown_source=$(\'#markdown_source\').val();

        $.ajax({
           type: "POST",
           url: "index.php?action=note",
           data: "note="+markdown_source,
           success: function(msg){
           	 $(\'#ajax_msg\').text(msg);
             $(\'#markdown\').load(\'index.php?action=note&show=1\');
             $(\'#markdown\').show();
             $(\'#marks\').hide();
             $(\'#editnote\').show();	
             var t=setTimeout("$(\'#ajax_msg\').text(\'\')",3000);
           }
         });


    });
    
'; ?>

</script>
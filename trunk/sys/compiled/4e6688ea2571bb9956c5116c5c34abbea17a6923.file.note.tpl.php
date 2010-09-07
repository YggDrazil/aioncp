<?php /* Smarty version Smarty3-b8, created on 2010-07-28 05:59:17
         compiled from "themes/note.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7045167814c4f8ef5094c30-75469164%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e6688ea2571bb9956c5116c5c34abbea17a6923' => 
    array (
      0 => 'themes/note.tpl',
      1 => 1280282247,
    ),
  ),
  'nocache_hash' => '7045167814c4f8ef5094c30-75469164',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="markdown">
    <?php echo $_smarty_tpl->getVariable('note')->value;?>

</div>
<div id="marks" class="hideme">
    <textarea id="markdown_source" class="sTextarea" style="width:100%" rows="10"></textarea>
    <br>
    <input type="button" value="<?php echo $_smarty_tpl->getVariable('lang')->value['save'];?>
"  class="butDef" id="save_note"/>
     <a href="javascript:;" id='cancelnote'><?php echo $_smarty_tpl->getVariable('lang')->value['cancel'];?>
</a>
</div>
<a href="javascript:;" id="editnote"><img src="<?php echo @TPL_URL;?>
i/edit.png" /></a>
<a href="javascript:;" id="refrash_note"><img src="<?php echo @TPL_URL;?>
i/refresh.png" /></a>

<div id='ajax_msg'></div>
<script>

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
    

</script>
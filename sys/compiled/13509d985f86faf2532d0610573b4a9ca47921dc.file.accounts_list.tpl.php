<?php /* Smarty version Smarty3-b8, created on 2010-07-28 06:00:36
         compiled from "themes/accounts_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3500299904c4f8f444a4d33-87025548%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13509d985f86faf2532d0610573b4a9ca47921dc' => 
    array (
      0 => 'themes/accounts_list.tpl',
      1 => 1280282433,
    ),
  ),
  'nocache_hash' => '3500299904c4f8f444a4d33-87025548',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<script>

$(document).ready(function(){
	$('#chkey').keyup(function(){
		  var char;
		  char=$('#chkey').val();
		  ajax_chars(char);  
		  return false;
	});
	$('.pg').click(function(){
		var url=$(this).attr("href");
		$('#loader').fadeIn('fast');
		
		$('#ajax').load(url+'&ajax=1',function(){
			$('#loader').hide('slow');
		});	
		$('#loader').fadeOut('slow');
		return false;
	});
});

</script>

<?php if (isset($_GET['ajax'])==FALSE){?>
<form method="get">
<input type="hidden" name="action" value="info" />
<input type="text" name="char" class="sText" pattern="([0-9]+)" required placeholder="Введите номер аккаунта"  />
<input type="submit" value="&rarr;"  class='butDef'/>
</form>
<?php }?>


<?php if ($_smarty_tpl->getVariable('rows')->value==TRUE){?>
<div id='ajax'>
<table border="0" cellpadding="4" cellspacing="5" class="uiTable">
<thead >
	<th><?php echo $_smarty_tpl->getVariable('lang')->value['account'];?>
</th>
	<th><?php echo $_smarty_tpl->getVariable('lang')->value['char'];?>
</th>
</thead>
	<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('rows')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['acclist']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['acclist']['iteration']++;
?>
	<tr style="background:#<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['acclist']['iteration']%2){?>E9E9E9<?php }else{ ?>F8F8F8<?php }?>">
		<td><a href='?action=info&char=<?php echo $_smarty_tpl->getVariable('row')->value['account_id'];?>
'><?php echo $_smarty_tpl->getVariable('row')->value['account_name'];?>
</a></td>
		<td><a href='?action=char&char_name=<?php echo $_smarty_tpl->getVariable('row')->value['name'];?>
'><?php echo $_smarty_tpl->getVariable('row')->value['name'];?>
</a></td>
	</tr>		
	<?php }} ?>
</table>
<?php }else{ ?>
No result
<?php }?>
<div class="pagination">
<?php echo $_smarty_tpl->getVariable('pagination')->value;?>

</div>
</div>
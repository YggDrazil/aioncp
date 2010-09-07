<?php /* Smarty version Smarty3-b8, created on 2010-08-01 22:07:47
         compiled from "themes/charlist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17902554754c55b7f35a1353-73855947%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cd5cfa4fa85720e809df39cebcd42d236e39ffa9' => 
    array (
      0 => 'themes/charlist.tpl',
      1 => 1280686061,
    ),
  ),
  'nocache_hash' => '17902554754c55b7f35a1353-73855947',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_level')) include '/Applications/MAMP/htdocs/project/aioncp/pro/sys/class/plugins/modifier.level.php';
?><script>

$(document).ready(function(){
	$('#chkey').keyup(function(){
		  var char=$('#chkey').val();
		  ajax_player(char);  
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
<input type="hidden" name="action" value="char" />
<input type="text" name="char_id" class="sText" pattern="([0-9]+)" required placeholder="Введите номер персонажа"  />
<input type="submit" value="&rarr;"  class='butDef'/>
</form>
<?php }?>

<div id='ajax'>
<?php if ($_smarty_tpl->getVariable('rows')->value==TRUE){?>

<table border="0" cellpadding="4" cellspacing="5" class="uiTable">
<thead>
	<th><?php echo $_smarty_tpl->getVariable('lang')->value['char'];?>
</th>
	<th><?php echo $_smarty_tpl->getVariable('lang')->value['account'];?>
</th>
	<th><?php echo $_smarty_tpl->getVariable('lang')->value['level'];?>
</th>
</thead>
	<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('rows')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['charlist']['iteration']=0;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['charlist']['iteration']++;
?>
	<tr style="background:#<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['charlist']['iteration']%2){?>E9E9E9<?php }else{ ?>F8F8F8<?php }?>">
		<td><a href='?action=char&char_name=<?php echo $_smarty_tpl->getVariable('row')->value['name'];?>
'><?php echo $_smarty_tpl->getVariable('row')->value['name'];?>
</a></td>
		<td><a href='?action=info&char=<?php echo $_smarty_tpl->getVariable('row')->value['account_id'];?>
'><?php echo $_smarty_tpl->getVariable('row')->value['account_name'];?>
</a></td>
		<td><?php echo smarty_modifier_level($_smarty_tpl->getVariable('row')->value['exp']);?>
</td>
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
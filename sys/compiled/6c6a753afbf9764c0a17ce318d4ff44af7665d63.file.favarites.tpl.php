<?php /* Smarty version Smarty3-b8, created on 2010-08-16 06:14:06
         compiled from "themes/favarites.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6826362454c689eeee22662-88860805%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c6a753afbf9764c0a17ce318d4ff44af7665d63' => 
    array (
      0 => 'themes/favarites.tpl',
      1 => 1281924845,
    ),
  ),
  'nocache_hash' => '6826362454c689eeee22662-88860805',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="fields">
<table border="0"  class="uiTable">
<thead >
	<th>id</th>
	<th><?php echo $_smarty_tpl->getVariable('lang')->value['name'];?>
</th>
	<th>Serial</th>
	<th><?php echo $_smarty_tpl->getVariable('lang')->value['action'];?>
</th>
</thead>
	<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('rows')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
?>
		<tr id="row<?php echo $_smarty_tpl->getVariable('row')->value['id'];?>
">
			<td><?php echo $_smarty_tpl->getVariable('row')->value['id'];?>
</td>
			<td><a href='?action=info&char=<?php echo $_smarty_tpl->getVariable('row')->value['serial'];?>
'><?php echo $_smarty_tpl->getVariable('row')->value['name'];?>
</a></td>
			<td><?php echo $_smarty_tpl->getVariable('row')->value['serial'];?>
</td>
			<td><a href='javascript:;' class="click_signal boxshadow" signal="?action=bookmarks&delid=<?php echo $_smarty_tpl->getVariable('row')->value['id'];?>
"><img src='<?php echo @TPL_URL;?>
i/delete.png'></a>
			</td>
		</tr>
	<?php }} ?>
</table>
</div>


<?php /* Smarty version Smarty3-b8, created on 2010-07-14 04:15:04
         compiled from "themes/title_char.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6921803054c3d0188305f76-94926999%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ed8083d04d6491e205dc0dcc73f130e0c529584c' => 
    array (
      0 => 'themes/title_char.tpl',
      1 => 1279066495,
    ),
  ),
  'nocache_hash' => '6921803054c3d0188305f76-94926999',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_GET['ajax']){?>
<form method='post'>
		<select name='title_id' class="sSelect">
				<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('title_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
			 		<option value='<?php echo $_smarty_tpl->getVariable('key')->value;?>
'<?php if ($_smarty_tpl->getVariable('key')->value==$_smarty_tpl->getVariable('player_title')->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('val')->value;?>
</option>
		<?php }} ?>
			 		</select>
	<input type="submit" name="submit" value="<?php echo $_smarty_tpl->getVariable('lang')->value['edit'];?>
"  class='editbtn1 butDef'> <a href="javascript:;" onclick="title_cn()">[<?php echo $_smarty_tpl->getVariable('lang')->value['cancel'];?>
]</a>
	</form>
	
<?php }else{ ?>
<div class="fields"> 
	<input type="hidden" name="char_id" value="<?php echo $_smarty_tpl->getVariable('char_id')->value;?>
">
	<form method='post'>
	<p> 
		<label for="name02" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['chartitle'];?>
</label> 
		<select name='title_id' class="sSelect">
				<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('title_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
			 		<option value='<?php echo $_smarty_tpl->getVariable('key')->value;?>
'<?php if ($_smarty_tpl->getVariable('key')->value==$_smarty_tpl->getVariable('player_title')->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('val')->value;?>
</option>
		<?php }} ?>
			 		</select>
	</p>
	
	<input type="submit" name="submit" value="<?php echo $_smarty_tpl->getVariable('lang')->value['edit'];?>
"  class='editbtn1 butDef'>
	</form>
	
</div>
<?php }?>
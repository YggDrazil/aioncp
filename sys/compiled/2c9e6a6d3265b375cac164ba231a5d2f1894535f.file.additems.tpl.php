<?php /* Smarty version Smarty3-b8, created on 2010-07-14 04:46:53
         compiled from "themes/additems.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3371012224c3d08fd3d5935-00414494%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c9e6a6d3265b375cac164ba231a5d2f1894535f' => 
    array (
      0 => 'themes/additems.tpl',
      1 => 1276725660,
    ),
  ),
  'nocache_hash' => '3371012224c3d08fd3d5935-00414494',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_itemname')) include '/Applications/MAMP/htdocs/project/aioncp/pro/sys/class/plugins/function.itemname.php';
?><?php if (isset($_smarty_tpl->getVariable('message')->value)){?>
	<?php  $_smarty_tpl->tpl_vars['msg'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('message')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['msg']->key => $_smarty_tpl->tpl_vars['msg']->value){
?>
<div class="toolTip tpBlue clearfix" >
	<p>
		<img src="<?php echo @TPL_URL;?>
img/icons/light-bulb-off.png" alt="Tip!" />
		<?php echo $_smarty_tpl->getVariable('msg')->value;?>

	</p>

	<a class="close" title="Close"></a>
</div>
 <?php }} ?>
<?php }?>


<div class="fields">
<h2><?php echo $_smarty_tpl->getVariable('lang')->value['additemtitle'];?>
</h2>
<form method="post">
<p>
	<label class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['iditem'];?>
</label>
	<input type="text"  name='id' id='iid' class="sText"/><a href='#' onclick="$('.fastlist').toggle('fast');" title='Fast items'>
	<img src='<?php echo @TPL_URL;?>
i/wizard.png' title='Fast items'></a>
</p>
<p class='fastlist hideme'>

<a href='javascript:void(0)' onclick="add_item('182400001')"><?php echo smarty_function_itemname(array('id'=>'182400001'),$_smarty_tpl->smarty,$_smarty_tpl);?>
</a><br>
<a href='javascript:void(0)' onclick="add_item('162000029')"><?php echo smarty_function_itemname(array('id'=>'162000029'),$_smarty_tpl->smarty,$_smarty_tpl);?>
</a><br>
<a href='javascript:void(0)' onclick="add_item('162000066')"><?php echo smarty_function_itemname(array('id'=>'162000066'),$_smarty_tpl->smarty,$_smarty_tpl);?>
</a><br>
</p>
<p>
	<label class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['count'];?>
</label>
	<input type="text" name='count' value="1"  class="sText"/>

</p>
<p>
	<label class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['eqiped'];?>
</label>
	<input type='checkbox' value='1' name='eqip'>
</p>
<p>
	<label class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['slot'];?>
</label>
	<input type="text" name='slot'value="0" class="sText"/>

</p>
<p>
	<label class="small"><a href='#' onclick="$('.switch').toggle('slow');"><?php echo $_smarty_tpl->getVariable('lang')->value['swidname'];?>
</a></label>
</p>
<p class='switch'>
	<label class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['char_name'];?>
</label>
	<input type='text' name='name' class="sText">

</p>

<p class='switch hideme'>
	<label class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['char_id'];?>
</label>
	<input type='text' name='char_id' class="sText">

</p>
	<input type='submit' value='<?php echo $_smarty_tpl->getVariable('lang')->value['additem'];?>
' class='editbtn1 butDef'>

</form>

</div><!-- fields -->

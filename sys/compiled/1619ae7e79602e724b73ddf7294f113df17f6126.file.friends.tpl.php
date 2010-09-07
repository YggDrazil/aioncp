<?php /* Smarty version Smarty3-b8, created on 2010-07-14 04:23:03
         compiled from "themes/friends.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2013430954c3d036753f802-55222416%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1619ae7e79602e724b73ddf7294f113df17f6126' => 
    array (
      0 => 'themes/friends.tpl',
      1 => 1279066977,
    ),
  ),
  'nocache_hash' => '2013430954c3d036753f802-55222416',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php if ($_smarty_tpl->getVariable('rows')->value==TRUE){?>
<div class="fields"> 
<h2><?php echo $_smarty_tpl->getVariable('lang')->value['friendslist'];?>
 <?php echo $_smarty_tpl->getVariable('name')->value;?>
</h2>
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
		<td><a href='?action=char&char_id=<?php echo $_smarty_tpl->getVariable('row')->value['id'];?>
'><?php echo $_smarty_tpl->getVariable('row')->value['name'];?>
</a></td>
	</tr>		
	<?php }} ?>
</table>
</div>
<?php }else{ ?>
<h2><?php echo $_smarty_tpl->getVariable('lang')->value['friendslist'];?>
 <?php echo $_smarty_tpl->getVariable('name')->value;?>
</h2>
<div class="toolTip tpRed clearfix" >
	<p>
		<img src="<?php echo @TPL_URL;?>
img/icons/light-bulb-off.png" alt="Tip!" />
		<?php echo $_smarty_tpl->getVariable('lang')->value['nofriends'];?>

	</p>
	
	<a class="close" title="Close"></a>
</div>

<?php }?>

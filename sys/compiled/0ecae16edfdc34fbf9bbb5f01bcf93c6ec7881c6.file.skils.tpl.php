<?php /* Smarty version Smarty3-b8, created on 2010-07-28 05:53:19
         compiled from "themes/skils.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4759550774c4f8d8f7e5bf4-41643539%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ecae16edfdc34fbf9bbb5f01bcf93c6ec7881c6' => 
    array (
      0 => 'themes/skils.tpl',
      1 => 1280281994,
    ),
  ),
  'nocache_hash' => '4759550774c4f8d8f7e5bf4-41643539',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (isset($_smarty_tpl->getVariable('message')->value)&&$_smarty_tpl->getVariable('message')->value){?>
<div class="toolTip tpBlue clearfix" >
	<p>
		<img src="themes/img/icons/light-bulb-off.png" alt="Tip!" />
		<?php echo $_smarty_tpl->getVariable('message')->value;?>

	</p>

	<a class="close" title="Close"></a>
</div>
<?php }?>

<script>
 $(document).ready(function() {
    $(".fields").accordion({
			autoHeight: false,
			navigation: true
		});
  });
</script>


<div class="fields">
<?php if (isset($_GET['char_id'])&&count($_smarty_tpl->getVariable('skils_list')->value)>0){?>
<h3><a href="#">Список скилов</a></h3>
<div>
	<table border="0" class="uiTable">
		<thead>
		  <tr>
			<th>#</th>
			<th>id</th>
			<th>Скилл</th>
			<th>Уровень</th>
			<th>Действие</th>
		  </tr>
		</thead>
		<?php  $_smarty_tpl->tpl_vars["s"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('skils_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["s"]->key => $_smarty_tpl->tpl_vars["s"]->value){
?>
		<tr style="background:<?php if ($_smarty_tpl->getVariable('s')->value['count']%2){?>#E9E9E9<?php }else{ ?>#F8F8F8<?php }?>" id="row<?php echo $_smarty_tpl->getVariable('s')->value['id'];?>
">
			<td><?php echo $_smarty_tpl->getVariable('s')->value['count'];?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('s')->value['id'];?>
</td>
			<td><a class='aion-item-icon-medium' href='<?php echo $_smarty_tpl->getVariable('lang')->value['aiondatabase'];?>
skill/<?php echo $_smarty_tpl->getVariable('s')->value['id'];?>
'></a><?php echo $_smarty_tpl->getVariable('s')->value['skillname'];?>
</td>
			<td><span id="lvl<?php echo $_smarty_tpl->getVariable('s')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('s')->value['level'];?>
</span></td>
			<td>
				<a href="javascript:;" onclick="sadd(<?php echo $_smarty_tpl->getVariable('s')->value['id'];?>
)"><img src="themes/i/plus.png" alt="" /></a>
				<a href="javascript:;" onclick="smin(<?php echo $_smarty_tpl->getVariable('s')->value['id'];?>
)"><img src="themes/i/minus.png" alt="" /></a>
				<a href="javascript:;" onclick="sdel(<?php echo $_smarty_tpl->getVariable('s')->value['id'];?>
)"><img src="themes/i/delete.png" alt="" /></a>
			</td>
		</tr>
		<?php }} ?>

	</table>
</div>
<?php }?>
<h3><a href="#">Добавить скил</a></h3>
<div>
<form method="post">
<table>
<tr>
	<td>ID Персонажа</td>
	<td><input type="text" pattern="([0-9]+)" name='player_id' class="sText" value='<?php echo $_GET['char_id'];?>
'/></td>
</tr>
<tr>
	<td>ID Скила</td>
	<td><input type="text" name='skillId' pattern="([0-9]+)" class="sText"/></td>
</tr>
<tr>
	<td>Уровень скила</td>
	<td><input type="text" name='skillLevel' pattern="([0-9]+)" class="sText" value='1'/></td>
</tr>
</table>
<input type='submit' name='add' value='Добавить' class='editbtn1 butDef'>
</form>
</div>
</div><!-- fields -->
<script type="text/javascript">

function sadd(element){
	var level=$('#lvl'+element).text();
	level++;
	$('#lvl'+element).text(level);
	$.get('?action=skills&char_id='+<?php echo $_GET['char_id'];?>
+'&skillid='+element+'&level='+level);
}

function smin(element){
	var level=$('#lvl'+element).text();
	if(level==1) return;
	level--;
	if(level < 1) level = 1;
	$('#lvl'+element).text(level);
	$.get('?action=skills&char_id='+<?php echo $_GET['char_id'];?>
+'&skillid='+element+'&level='+level);
}

function sdel(element){
	if (!confirm('Вы действительно хотите удалить данный скилл?')) return false;
	$('#row'+element).hide();
	$.get('?action=skills&char_id='+<?php echo $_GET['char_id'];?>
+'&delskillid='+element);

}

</script>
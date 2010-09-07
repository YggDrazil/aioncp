<?php /* Smarty version Smarty3-b8, created on 2010-07-21 02:16:47
         compiled from "themes/anonce.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18496268434c46204f4d2e04-71631377%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cbb4e3a23b4c6aaf629fadd00aa0d54f638d4a61' => 
    array (
      0 => 'themes/anonce.tpl',
      1 => 1279664202,
    ),
  ),
  'nocache_hash' => '18496268434c46204f4d2e04-71631377',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (isset($_smarty_tpl->getVariable('message')->value)&&$_smarty_tpl->getVariable('message')->value){?>
<div class="toolTip tpBlue clearfix" >
	<p>
		<img src="<?php echo @TPL_URL;?>
img/icons/light-bulb-off.png" alt="Tip!" />
		<?php echo $_smarty_tpl->getVariable('message')->value;?>

	</p>

	<a class="close" title="Close"></a>
</div>
<?php }?>

<script>
 $(document).ready(function() {
    $(".accord").accordion({autoHeight: false});
  });

	function delete_confim(anonce_id){
			$("#dialog-confirm").dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					'Удалить': function() {
						$.getScript("?action=anonce&del="+anonce_id);
						$(this).dialog('close');
					},
					'Отмена': function() {
						$(this).dialog('close');
					}
				}
			});
	}
</script>

<div id="dialog-confirm" title="Вы уверены" class="hideme">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Вы уверены что хотите удалить данный анонс?</p>
</div>


<div class="fields accord">
<?php if (isset($_smarty_tpl->getVariable('edit')->value)&&$_smarty_tpl->getVariable('edit')->value==TRUE){?>
<h3><a href="#">Изменить анонс <?php echo $_smarty_tpl->getVariable('edit_row')->value['announce'];?>
</a></h3>
<div>
	<form method="post">
<table>

	<tr>
		<td>Сообщение</td>
		<td><input type="text" name='edit_announce' class="sText" value="<?php echo $_smarty_tpl->getVariable('edit_row')->value['announce'];?>
"/></td>
	</tr>
	<tr>
		<td>Кому отображать</td>
		<td><select name="edit_faction" class="sSelect">
			<option value="ALL" <?php if ($_smarty_tpl->getVariable('edit_row')->value['faction']=="ALL"){?>selected="selected"<?php }?>>ALL</option>
			<option value="ASMODIANS" <?php if ($_smarty_tpl->getVariable('edit_row')->value['faction']=="ASMODIANS"){?>selected="selected"<?php }?>>ASMODIANS</option>
			<option value="ELYOS" <?php if ($_smarty_tpl->getVariable('edit_row')->value['faction']=="ELYOS"){?>selected="selected"<?php }?>>ELYOS</option>
		</select></td>
	</tr>
	<tr>
		<td>Тип</td>
		<td><select name="edit_type" class="sSelect">
			<option value="ANNOUNCE" <?php if ($_smarty_tpl->getVariable('edit_row')->value['type']=="ANNOUNCE"){?>selected="selected"<?php }?>>ANNOUNCE</option>
			<option value="SHOUT" <?php if ($_smarty_tpl->getVariable('edit_row')->value['type']=="SHOUT"){?>selected="selected"<?php }?>>SHOUT</option>
			<option value="ORANGE" <?php if ($_smarty_tpl->getVariable('edit_row')->value['type']=="ORANGE"){?>selected="selected"<?php }?>>ORANGE</option>
			<option value="YELLOW" <?php if ($_smarty_tpl->getVariable('edit_row')->value['type']=="YELLOW"){?>selected="selected"<?php }?>>YELLOW</option>
			<option value="NORMAL" <?php if ($_smarty_tpl->getVariable('edit_row')->value['type']=="NORMAL"){?>selected="selected"<?php }?>>NORMAL</option>
		</select></td>
	</tr>
	<tr>
		<td>Время повтора</td>
		<td><input type="text" name='edit_delay' class="sText" value="<?php echo $_smarty_tpl->getVariable('edit_row')->value['delay'];?>
"/></td>
	</tr>

</table>
<input type='submit' class='editbtn1 butDef' value='Изменить'>
</form>
</div>
<?php }?>

<h3><a href="#">Анонсы</a></h3>
<div>
<table border="0"  class="uiTable">
<thead >
	<th>id</th>
	<th>Сообщение</th>
	<th>Отображается для</th>
	<th>Цвет</th>
	<th>Время</th>
	<th>Действие</th>
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
			<td><?php echo $_smarty_tpl->getVariable('row')->value['announce'];?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('row')->value['faction'];?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('row')->value['type'];?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('row')->value['delay'];?>
</td>
			<td><a href="?action=anonce&editid=<?php echo $_smarty_tpl->getVariable('row')->value['id'];?>
"><img src="<?php echo @TPL_URL;?>
i/edit.png"></a> 
			<a href="javascript:;" onclick="delete_confim(<?php echo $_smarty_tpl->getVariable('row')->value['id'];?>
)"><img src="<?php echo @TPL_URL;?>
i/delete.png"></a></td>
		</tr>
	<?php }} ?>
</table>
</div>
<h3><a href="#">Добавить анонс</a></h3>
<div>
	<form method="post">
<table>

	<tr>
		<td>Сообщение</td>
		<td><input type="text" name='announce' class="sText"/></td>
	</tr>
	<tr>
		<td>Кому отображать</td>
		<td><select name="faction" class="sSelect">
			<option value="ALL">ALL</option>
			<option value="ASMODIANS">ASMODIANS</option>
			<option value="ELYOS">ELYOS</option>
		</select></td>
	</tr>
	<tr>
		<td>Тип</td>
		<td><select name="type" class="sSelect">
			<option value="ANNOUNCE">ANNOUNCE</option>
			<option value="SHOUT">SHOUT</option>
			<option value="ORANGE">ORANGE</option>
			<option value="YELLOW">YELLOW</option>
			<option value="NORMAL">NORMAL</option>
		</select></td>
	</tr>
	<tr>
		<td>Время повтора</td>
		<td><input type="text" name='delay' class="sText" placeholder="3600"/></td>
	</tr>

</table>
<input type='submit' class='editbtn1 butDef' value='Добавить'>
</form>
</div>

</div><!-- fields -->
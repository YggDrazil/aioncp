<?php /* Smarty version Smarty3-b8, created on 2010-08-06 15:26:15
         compiled from "themes/droplist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12443789274c5bf15710c480-10837327%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bffe4b472352f48cf29272a60e0e82e50b64de3a' => 
    array (
      0 => 'themes/droplist.tpl',
      1 => 1281093842,
    ),
  ),
  'nocache_hash' => '12443789274c5bf15710c480-10837327',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_itemname')) include '/Applications/MAMP/htdocs/project/aioncp/pro/sys/class/plugins/modifier.itemname.php';
?><?php if (isset($_smarty_tpl->getVariable('message')->value)&&$_smarty_tpl->getVariable('message')->value){?>
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
    $(".fields").accordion({
			autoHeight: false,
			navigation: true
		});
  });
	

function delete_confim(item_id){
		$('#'+item_id).animate({ backgroundColor: "red" }, 1000);
		$("#dialog-confirm").dialog({
			resizable: false,
			height:140,
			modal: true,
			buttons: {
				'Удалить': function() {
					$('#'+item_id).load("?action=droplist&del="+item_id);
					$('#'+item_id).empty();
					$(this).dialog('close');
				},
				'Отмена': function() {
					$('#'+item_id).animate({ backgroundColor: "transparent" }, 1000);
					$(this).dialog('close');
				}
			}
		});
}

function edit_form(item_id){
			$('#edit_form').load("?action=droplist&edit="+item_id);
			$('#'+item_id).animate({ backgroundColor: "lime" }, 1000);
			$('#edit_form').attr('title',"Предмет с id "+item_id);
			
			$("#edit_form").dialog({
				resizable: false,
				width: 350 ,
				modal: true,
				buttons: {
					'Сохранить': function() {
						var param_id=$('#id').val();
						var param_itemId=$('#itemId').val();
						var param_min=$('#min').val();
						var param_max=$('#max').val();
						var param_mobId=$('#mobId').val();
						var param_chance=$('#chance').val();
						
						$.post("?action=droplist&edit="+item_id, {
							itemId: param_itemId, id: param_id, min: param_min, max: param_max, mobId: param_mobId,chance: param_chance
						},
						   function(data){
						     alert(data);
						   });
						$('#'+item_id).animate({ backgroundColor: "lime" }, 1000);
						$(this).dialog('close');
					},
					'Отмена': function() {
						$('#'+item_id).animate({ backgroundColor: "transparent" }, 1000);
						$(this).dialog('close');
					}
				}
			});
}

</script>

<div id="dialog-confirm" title="Вы уверены" class="hideme">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Вы уверены что хотите удалить данный предмет?</p>
</div>
<div id="edit_form" class="hideme" title="Форма">Загружаю...</div>
<?php if ($_smarty_tpl->getVariable('message')->value){?>
<div class="toolTip tpBlue clearfix" > 
	<p> 
		<img src="<?php echo @TPL_URL;?>
img/icons/light-bulb-off.png" alt="Tip!" /> 
		<?php echo $_smarty_tpl->getVariable('message')->value;?>

	</p> 
	
	<a class="close" title="Close"></a> 
</div> 
<?php }?>
<div class="fields">

<?php if ($_smarty_tpl->getVariable('rows')->value&&count($_smarty_tpl->getVariable('rows')->value)>0){?>
<h3><a href="#">Список предметов по id монстра</a></h3>
<div>
<table border="0"  class="uiTable">
<thead >
	<th>id</th>
	<th>Предмет</th>
	<th>Мин.</th>
	<th>Макс.</th>
	<th>Моб</th>
	<th>Шанс</th>
	<th>Действие</th>
</thead>
	<?php  $_smarty_tpl->tpl_vars["row"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('rows')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["row"]->key => $_smarty_tpl->tpl_vars["row"]->value){
?>
		<tr id="<?php echo $_smarty_tpl->getVariable('row')->value['Id'];?>
">
			<td><?php echo $_smarty_tpl->getVariable('row')->value['Id'];?>
</td>
			<td><a class='aion-item-icon-medium' href='<?php echo $_smarty_tpl->getVariable('lang')->value['aiondatabase'];?>
item/<?php echo $_smarty_tpl->getVariable('row')->value['itemId'];?>
'></a><?php echo smarty_modifier_itemname($_smarty_tpl->getVariable('row')->value['itemId']);?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('row')->value['min'];?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('row')->value['max'];?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('row')->value['mobId'];?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('row')->value['chance'];?>
</td>
			<td><a href="javascript:;" onclick="edit_form(<?php echo $_smarty_tpl->getVariable('row')->value['Id'];?>
)"><img src="<?php echo @TPL_URL;?>
i/edit.png"></a> 
			<a href="javascript:;" onclick="delete_confim(<?php echo $_smarty_tpl->getVariable('row')->value['Id'];?>
)"><img src="<?php echo @TPL_URL;?>
i/delete.png"></a></td>
		</tr>
	<?php }} ?>
</table>
</div>
<?php }?>
<h3><a href="#">Работа с дроплистом</a></h3>
<div>
<table>
<form method="post">
	<tr>
		<td>id монстра</td>
		<td><input type="text" name='mobid' class="sText" value="<?php if (isset($_POST['mobid'])){?><?php echo $_POST['mobid'];?>
<?php }?>"/></td>
		<td><input type='submit' class='editbtn1 butDef' value='<?php echo $_smarty_tpl->getVariable('lang')->value['search'];?>
'></td>
	</tr>
</form>
<form method="post">
	<tr>
		<td>id предмета</td>
		<td><input type="text" name='itemid' class="sText" value="<?php if (isset($_POST['itemid'])){?><?php echo $_POST['itemid'];?>
<?php }?>"/></td>
		<td><input type='submit' class='editbtn1 butDef' value='<?php echo $_smarty_tpl->getVariable('lang')->value['search'];?>
'></td>
	</tr>
</form>
</table>

</div>
<h3><a href="#">Добавить новое поле</a></h3>
<div>
<form method="post">
<input type="hidden" name="action" value="add">
<table>
<tr>
	<td>Id монстра</td>
	<td><input type="text" name='mobid' class="sText"/></td>

</tr>
<tr>
	<td>Id предмета</td>
	<td><input type="text" name='itemid' class="sText"/></td>

</tr>

<tr>
	<td>Минимальное выпадание предмета</td>
	<td><input type="text" name='min' class="sText" value="0"/></td>
</tr>
<tr>
	<td>Максимальное выпадание предмета</td>
	<td><input type="text" name='max' class="sText"/></td>

</tr>
<tr>
	<td>Шанс выпадание предмета</td>
	<td><input type="text" name='chance' class="sText" value="0.05"/></td>

</tr>
</table>
	<input type='submit' value='Добавить' class='editbtn1 butDef'>

</form>
</div>
</div><!-- fields -->
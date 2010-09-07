<?php /* Smarty version 2.6.26, created on 2010-08-18 20:35:05
         compiled from droplist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'itemname', 'droplist.tpl', 110, false),)), $this); ?>
<?php if (isset ( $this->_tpl_vars['message'] ) && $this->_tpl_vars['message']): ?>
<div class="toolTip tpBlue clearfix" >
	<p>
		<img src="<?php echo @TPL_URL; ?>
img/icons/light-bulb-off.png" alt="Tip!" />
		<?php echo $this->_tpl_vars['message']; ?>

	</p>

	<a class="close" title="Close"></a>
</div>
<?php endif; ?>
<?php echo '
<script>
 $(document).ready(function() {
    $(".fields").accordion({
			autoHeight: false,
			navigation: true
		});
  });
	

function delete_confim(item_id){
		$(\'#\'+item_id).animate({ backgroundColor: "red" }, 1000);
		$("#dialog-confirm").dialog({
			resizable: false,
			height:140,
			modal: true,
			buttons: {
				\'Удалить\': function() {
					$(\'#\'+item_id).load("?action=droplist&del="+item_id);
					$(\'#\'+item_id).empty();
					$(this).dialog(\'close\');
				},
				\'Отмена\': function() {
					$(\'#\'+item_id).animate({ backgroundColor: "transparent" }, 1000);
					$(this).dialog(\'close\');
				}
			}
		});
}

function edit_form(item_id){
			$(\'#edit_form\').load("?action=droplist&edit="+item_id);
			$(\'#\'+item_id).animate({ backgroundColor: "lime" }, 1000);
			$(\'#edit_form\').attr(\'title\',"Предмет с id "+item_id);
			
			$("#edit_form").dialog({
				resizable: false,
				width: 350 ,
				modal: true,
				buttons: {
					\'Сохранить\': function() {
						var param_id=$(\'#id\').val();
						var param_itemId=$(\'#itemId\').val();
						var param_min=$(\'#min\').val();
						var param_max=$(\'#max\').val();
						var param_mobId=$(\'#mobId\').val();
						var param_chance=$(\'#chance\').val();
						
						$.post("?action=droplist&edit="+item_id, {
							itemId: param_itemId, id: param_id, min: param_min, max: param_max, mobId: param_mobId,chance: param_chance
						},
						   function(data){
						     alert(data);
						   });
						$(\'#\'+item_id).animate({ backgroundColor: "lime" }, 1000);
						$(this).dialog(\'close\');
					},
					\'Отмена\': function() {
						$(\'#\'+item_id).animate({ backgroundColor: "transparent" }, 1000);
						$(this).dialog(\'close\');
					}
				}
			});
}

</script>
'; ?>

<div id="dialog-confirm" title="Вы уверены" class="hideme">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Вы уверены что хотите удалить данный предмет?</p>
</div>
<div id="edit_form" class="hideme" title="Форма">Загружаю...</div>
<?php if ($this->_tpl_vars['message']): ?>
<div class="toolTip tpBlue clearfix" > 
	<p> 
		<img src="<?php echo @TPL_URL; ?>
img/icons/light-bulb-off.png" alt="Tip!" /> 
		<?php echo $this->_tpl_vars['message']; ?>

	</p> 
	
	<a class="close" title="Close"></a> 
</div> 
<?php endif; ?>
<div class="fields">

<?php if ($this->_tpl_vars['rows'] && count ( $this->_tpl_vars['rows'] ) > 0): ?>
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
	<?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
		<tr id="<?php echo $this->_tpl_vars['row']['Id']; ?>
">
			<td><?php echo $this->_tpl_vars['row']['Id']; ?>
</td>
			<td><a class='aion-item-icon-medium' href='<?php echo $this->_tpl_vars['lang']['aiondatabase']; ?>
item/<?php echo $this->_tpl_vars['row']['itemId']; ?>
'></a><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['itemId'])) ? $this->_run_mod_handler('itemname', true, $_tmp) : smarty_modifier_itemname($_tmp)); ?>
</td>
			<td><?php echo $this->_tpl_vars['row']['min']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row']['max']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row']['mobId']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row']['chance']; ?>
</td>
			<td><a href="javascript:;" onclick="edit_form(<?php echo $this->_tpl_vars['row']['Id']; ?>
)"><img src="<?php echo @TPL_URL; ?>
i/edit.png"></a> 
			<a href="javascript:;" onclick="delete_confim(<?php echo $this->_tpl_vars['row']['Id']; ?>
)"><img src="<?php echo @TPL_URL; ?>
i/delete.png"></a></td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
</div>
<?php endif; ?>
<h3><a href="#">Работа с дроплистом</a></h3>
<div>
<table>
<form method="post">
	<tr>
		<td>id монстра</td>
		<td><input type="text" name='mobid' class="sText" value="<?php if (isset ( $_POST['mobid'] )): ?><?php echo $_POST['mobid']; ?>
<?php endif; ?>"/></td>
		<td><input type='submit' class='editbtn1 butDef' value='<?php echo $this->_tpl_vars['lang']['search']; ?>
'></td>
	</tr>
</form>
<form method="post">
	<tr>
		<td>id предмета</td>
		<td><input type="text" name='itemid' class="sText" value="<?php if (isset ( $_POST['itemid'] )): ?><?php echo $_POST['itemid']; ?>
<?php endif; ?>"/></td>
		<td><input type='submit' class='editbtn1 butDef' value='<?php echo $this->_tpl_vars['lang']['search']; ?>
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
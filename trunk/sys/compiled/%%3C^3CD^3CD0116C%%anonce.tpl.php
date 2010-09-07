<?php /* Smarty version 2.6.26, created on 2010-08-18 20:35:57
         compiled from anonce.tpl */ ?>
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
    $(".accord").accordion({autoHeight: false});
  });

	function delete_confim(anonce_id){
			$("#dialog-confirm").dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
					\'Удалить\': function() {
						$.getScript("?action=anonce&del="+anonce_id);
						$(this).dialog(\'close\');
					},
					\'Отмена\': function() {
						$(this).dialog(\'close\');
					}
				}
			});
	}
</script>
'; ?>

<div id="dialog-confirm" title="Вы уверены" class="hideme">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Вы уверены что хотите удалить данный анонс?</p>
</div>


<div class="fields accord">
<?php if (isset ( $this->_tpl_vars['edit'] ) && $this->_tpl_vars['edit'] == TRUE): ?>
<h3><a href="#">Изменить анонс <?php echo $this->_tpl_vars['edit_row']['announce']; ?>
</a></h3>
<div>
	<form method="post">
<table>

	<tr>
		<td>Сообщение</td>
		<td><input type="text" name='edit_announce' class="sText" value="<?php echo $this->_tpl_vars['edit_row']['announce']; ?>
"/></td>
	</tr>
	<tr>
		<td>Кому отображать</td>
		<td><select name="edit_faction" class="sSelect">
			<option value="ALL" <?php if ($this->_tpl_vars['edit_row']['faction'] == 'ALL'): ?>selected="selected"<?php endif; ?>>ALL</option>
			<option value="ASMODIANS" <?php if ($this->_tpl_vars['edit_row']['faction'] == 'ASMODIANS'): ?>selected="selected"<?php endif; ?>>ASMODIANS</option>
			<option value="ELYOS" <?php if ($this->_tpl_vars['edit_row']['faction'] == 'ELYOS'): ?>selected="selected"<?php endif; ?>>ELYOS</option>
		</select></td>
	</tr>
	<tr>
		<td>Тип</td>
		<td><select name="edit_type" class="sSelect">
			<option value="ANNOUNCE" <?php if ($this->_tpl_vars['edit_row']['type'] == 'ANNOUNCE'): ?>selected="selected"<?php endif; ?>>ANNOUNCE</option>
			<option value="SHOUT" <?php if ($this->_tpl_vars['edit_row']['type'] == 'SHOUT'): ?>selected="selected"<?php endif; ?>>SHOUT</option>
			<option value="ORANGE" <?php if ($this->_tpl_vars['edit_row']['type'] == 'ORANGE'): ?>selected="selected"<?php endif; ?>>ORANGE</option>
			<option value="YELLOW" <?php if ($this->_tpl_vars['edit_row']['type'] == 'YELLOW'): ?>selected="selected"<?php endif; ?>>YELLOW</option>
			<option value="NORMAL" <?php if ($this->_tpl_vars['edit_row']['type'] == 'NORMAL'): ?>selected="selected"<?php endif; ?>>NORMAL</option>
		</select></td>
	</tr>
	<tr>
		<td>Время повтора</td>
		<td><input type="text" name='edit_delay' class="sText" value="<?php echo $this->_tpl_vars['edit_row']['delay']; ?>
"/></td>
	</tr>

</table>
<input type='submit' class='editbtn1 butDef' value='Изменить'>
</form>
</div>
<?php endif; ?>

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
	<?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
		<tr id="row<?php echo $this->_tpl_vars['row']['id']; ?>
">
			<td><?php echo $this->_tpl_vars['row']['id']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row']['announce']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row']['faction']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row']['type']; ?>
</td>
			<td><?php echo $this->_tpl_vars['row']['delay']; ?>
</td>
			<td><a href="?action=anonce&editid=<?php echo $this->_tpl_vars['row']['id']; ?>
"><img src="<?php echo @TPL_URL; ?>
i/edit.png"></a> 
			<a href="javascript:;" onclick="delete_confim(<?php echo $this->_tpl_vars['row']['id']; ?>
)"><img src="<?php echo @TPL_URL; ?>
i/delete.png"></a></td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>
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
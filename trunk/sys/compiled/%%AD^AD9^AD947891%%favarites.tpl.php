<?php /* Smarty version 2.6.26, created on 2010-08-18 20:17:26
         compiled from favarites.tpl */ ?>
<div class="fields">
<table border="0"  class="uiTable">
<thead >
	<th>id</th>
	<th><?php echo $this->_tpl_vars['lang']['name']; ?>
</th>
	<th>Serial</th>
	<th><?php echo $this->_tpl_vars['lang']['action']; ?>
</th>
</thead>
	<?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
		<tr id="row<?php echo $this->_tpl_vars['row']['id']; ?>
">
			<td><?php echo $this->_tpl_vars['row']['id']; ?>
</td>
			<td><a href='?action=info&char=<?php echo $this->_tpl_vars['row']['serial']; ?>
'><?php echo $this->_tpl_vars['row']['name']; ?>
</a></td>
			<td><?php echo $this->_tpl_vars['row']['serial']; ?>
</td>
			<td><a href='javascript:;' class="click_signal boxshadow" signal="?action=bookmarks&delid=<?php echo $this->_tpl_vars['row']['id']; ?>
"><img src='<?php echo @TPL_URL; ?>
i/delete.png'></a>
			</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>
</table>
</div>

<?php /* Smarty version 2.6.26, created on 2010-09-04 04:01:54
         compiled from charlist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'level', 'charlist.tpl', 45, false),)), $this); ?>
<script>
<?php echo '
$(document).ready(function(){
	$(\'#chkey\').keyup(function(){
		  var char=$(\'#chkey\').val();
		  ajax_player(char);  
		  return false;
	});
	
	$(\'.pg\').click(function(){
		var url=$(this).attr("href");
		$(\'#loader\').fadeIn(\'fast\');
		
		$(\'#ajax\').load(url+\'&ajax=1\',function(){
			$(\'#loader\').hide(\'slow\');
		});	
		$(\'#loader\').fadeOut(\'slow\');
		return false;
	});
});
'; ?>

</script>

<?php if (isset ( $_GET['ajax'] ) == FALSE): ?>
<form method="get">
<input type="hidden" name="action" value="char" />
<input type="text" name="char_id" class="sText" pattern="([0-9]+)" required placeholder="Введите номер персонажа"  />
<input type="submit" value="&rarr;"  class='butDef'/>
</form>
<?php endif; ?>

<div id='ajax'>
<?php if ($this->_tpl_vars['rows'] == TRUE): ?>

<table border="0" cellpadding="4" cellspacing="5" class="uiTable">
<thead>
	<th><?php echo $this->_tpl_vars['lang']['char']; ?>
</th>
	<th><?php echo $this->_tpl_vars['lang']['account']; ?>
</th>
	<th><?php echo $this->_tpl_vars['lang']['level']; ?>
</th>
</thead>
	<?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['charlist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['charlist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['row']):
        $this->_foreach['charlist']['iteration']++;
?>
	<tr style="background:#<?php if ($this->_foreach['charlist']['iteration'] % 2): ?>E9E9E9<?php else: ?>F8F8F8<?php endif; ?>">
		<td><a href='?action=char&char_name=<?php echo $this->_tpl_vars['row']['name']; ?>
'><?php echo $this->_tpl_vars['row']['name']; ?>
</a></td>
		<td><a href='?action=info&char=<?php echo $this->_tpl_vars['row']['account_id']; ?>
'><?php echo $this->_tpl_vars['row']['account_name']; ?>
</a></td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['exp'])) ? $this->_run_mod_handler('level', true, $_tmp) : smarty_modifier_level($_tmp)); ?>
</td>
	</tr>		
	<?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
No result
<?php endif; ?>
<div class="pagination">
<?php echo $this->_tpl_vars['pagination']; ?>

</div>
</div>
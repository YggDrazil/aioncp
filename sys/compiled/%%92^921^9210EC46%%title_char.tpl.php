<?php /* Smarty version 2.6.26, created on 2010-09-04 04:05:53
         compiled from title_char.tpl */ ?>
<?php if ($_GET['ajax']): ?>
<form method='post'>
		<select name='title_id' class="sSelect">
				<?php $_from = $this->_tpl_vars['title_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
?>
			 		<option value='<?php echo $this->_tpl_vars['key']; ?>
'<?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['player_title']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['val']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
			 		</select>
	<input type="submit" name="submit" value="<?php echo $this->_tpl_vars['lang']['edit']; ?>
"  class='editbtn1 butDef'> <a href="javascript:;" onclick="title_cn()">[<?php echo $this->_tpl_vars['lang']['cancel']; ?>
]</a>
	</form>
	
<?php else: ?>
<div class="fields"> 
	<input type="hidden" name="char_id" value="<?php echo $this->_tpl_vars['char_id']; ?>
">
	<form method='post'>
	<p> 
		<label for="name02" class="small"><?php echo $this->_tpl_vars['lang']['chartitle']; ?>
</label> 
		<select name='title_id' class="sSelect">
				<?php $_from = $this->_tpl_vars['title_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['val']):
?>
			 		<option value='<?php echo $this->_tpl_vars['key']; ?>
'<?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['player_title']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['val']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
			 		</select>
	</p>
	
	<input type="submit" name="submit" value="<?php echo $this->_tpl_vars['lang']['edit']; ?>
"  class='editbtn1 butDef'>
	</form>
	
</div>
<?php endif; ?>
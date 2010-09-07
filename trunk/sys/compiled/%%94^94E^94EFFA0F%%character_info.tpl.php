<?php /* Smarty version 2.6.26, created on 2010-08-18 20:17:31
         compiled from character_info.tpl */ ?>
<div class="fields"> 
<form method="post" action="?action=char&char_id=<?php echo $this->_tpl_vars['row']['id']; ?>
">
	<?php if ($this->_tpl_vars['ajax'] == FALSE): ?><h2><?php echo $this->_tpl_vars['lang']['charinfo']; ?>
 <?php echo $this->_tpl_vars['row']['name']; ?>
</h2><?php endif; ?> 
	<?php if (isset ( $_POST['name'] )): ?>
		<div class="toolTip tpGreen clearfix" >
	<p>
		<img src="<?php echo @TPL_URL; ?>
img/icons/light-bulb-off.png" alt="Tip!" />
		<?php echo $this->_tpl_vars['lang']['succupdate']; ?>

	</p>
	
	<a class="close" title="Close"></a>
</div>
<?php endif; ?>	
<p> 
	<label for="name01" class="small"><?php echo $this->_tpl_vars['lang']['chartitle']; ?>
</label> 
	<a href="?action=title&char_id=<?php echo $this->_tpl_vars['row']['id']; ?>
" class="title_edit" onclick="return false;" title="<?php echo $this->_tpl_vars['lang']['edit']; ?>
"><?php if ($this->_tpl_vars['player_title'] != ''): ?><?php echo $this->_tpl_vars['player_title']; ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['n']; ?>
<?php endif; ?></a><label class="title_edit_ajax"></label>
</p>	
<p>

<p> 
	<label for="name01" class="small">ID</label> 
	<a href="?action=char&char_id=<?php echo $this->_tpl_vars['row']['id']; ?>
"><?php echo $this->_tpl_vars['row']['id']; ?>
</a>
</p>	
<p> 
	<label for="name01" class="small"><?php echo $this->_tpl_vars['lang']['status']; ?>
</label> 
	<?php if ($this->_tpl_vars['online']): ?><font color="lime"><?php echo $this->_tpl_vars['lang']['online']; ?>
</font> <img src="<?php echo @TPL_URL; ?>
i/error.png">
		<?php else: ?><font color="red"><?php echo $this->_tpl_vars['lang']['offline']; ?>
</font> <img src="<?php echo @TPL_URL; ?>
i/success.gif"><?php endif; ?>
</p>	
<p> 
	<label for="name02" class="small"><?php echo $this->_tpl_vars['lang']['name']; ?>
</label> 
	<input type="text" name='name' id='chname' value="<?php echo $this->_tpl_vars['row']['name']; ?>
"  class="sText"/>
</p>


<p> 
	<label for="name01" class="small"><?php echo $this->_tpl_vars['lang']['login']; ?>
</label> 
	<a href='?action=info&char=<?php echo $this->_tpl_vars['row']['account_id']; ?>
' title='Open Account'><?php echo $this->_tpl_vars['row']['account_name']; ?>
</a> [Сменить логин]
</p>
<p> 
	<label for="name01" class="small"><?php echo $this->_tpl_vars['lang']['sex']; ?>
</label> 
	<select class="sSelect" id="select01" name='gender'> 
		<option value="MALE" <?php if ($this->_tpl_vars['row']['gender'] == 'MALE'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['lang']['male']; ?>
</option> 
		<option value="FEMALE" <?php if ($this->_tpl_vars['row']['gender'] == 'FEMALE'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['lang']['female']; ?>
</option>  
	</select> 
</p>
<p> 
	<label for="name02" class="small"><?php echo $this->_tpl_vars['lang']['race']; ?>
</label> 
	<select class="sSelect" id="select01" name='race'> 
		<option value="ASMODIANS" <?php if ($this->_tpl_vars['row']['race'] == 'ASMODIANS'): ?>selected<?php endif; ?>>ASMODIANS</option> 
		<option value="ELYOS" <?php if ($this->_tpl_vars['row']['race'] == 'ELYOS'): ?>selected<?php endif; ?>>ELYOS</option>  
	</select> 
</p>

<p> 
	<label for="name02" class="small"><?php echo $this->_tpl_vars['lang']['class']; ?>
</label> 
	<select class="sSelect" id="select01" name='player_class'> 
		<option value="WARRIOR" <?php if ($this->_tpl_vars['row']['player_class'] == 'WARRIOR'): ?>selected<?php endif; ?>>WARRIOR</option> 
		<option value="GLADIATOR" <?php if ($this->_tpl_vars['row']['player_class'] == 'GLADIATOR'): ?>selected<?php endif; ?>>GLADIATOR</option>  
		<option value="TEMPLAR" <?php if ($this->_tpl_vars['row']['player_class'] == 'TEMPLAR'): ?>selected<?php endif; ?>>TEMPLAR</option> 
		<option value="SCOUT" <?php if ($this->_tpl_vars['row']['player_class'] == 'SCOUT'): ?>selected<?php endif; ?>>SCOUT</option> 
		<option value="ASSASSIN" <?php if ($this->_tpl_vars['row']['player_class'] == 'ASSASSIN'): ?>selected<?php endif; ?>>ASSASSIN</option> 
		<option value="RANGER" <?php if ($this->_tpl_vars['row']['player_class'] == 'RANGER'): ?>selected<?php endif; ?>>RANGER</option> 
		<option value="MAGE" <?php if ($this->_tpl_vars['row']['player_class'] == 'MAGE'): ?>selected<?php endif; ?>>MAGE</option> 
		<option value="SORCERER" <?php if ($this->_tpl_vars['row']['player_class'] == 'SORCERER'): ?>selected<?php endif; ?>>SORCERER</option> 
		<option value="SPIRIT_MASTER" <?php if ($this->_tpl_vars['row']['player_class'] == 'SPIRIT_MASTER'): ?>selected<?php endif; ?>>SPIRIT MASTER</option> 
		<option value="PRIEST" <?php if ($this->_tpl_vars['row']['player_class'] == 'PRIEST'): ?>selected<?php endif; ?>>PRIEST</option> 
		<option value="CLERIC" <?php if ($this->_tpl_vars['row']['player_class'] == 'CLERIC'): ?>selected<?php endif; ?>>CLERIC</option> 
		<option value="CHANTER" <?php if ($this->_tpl_vars['row']['player_class'] == 'CHANTER'): ?>selected<?php endif; ?>>CHANTER</option> 
	</select> 
</p>

<p> 
	<label for="name01" class="small"><?php echo $this->_tpl_vars['lang']['create']; ?>
</label> 
	<?php echo $this->_tpl_vars['row']['creation_date']; ?>

</p>

<p> 
	<label for="name01" class="small"><?php echo $this->_tpl_vars['lang']['lastexit']; ?>
</label> 
	<?php echo $this->_tpl_vars['row']['last_online']; ?>

</p>

<p> 
	<label for="name01" class="small"><?php echo $this->_tpl_vars['lang']['level']; ?>
</label> 
	<?php echo $this->_tpl_vars['level']; ?>

</p>
<input type='submit' value='<?php echo $this->_tpl_vars['lang']['edit']; ?>
' class='editbtn1 butDef'>
</form>
</div>
<?php echo '
<script>
$(\'.title_edit\').click(function(){
	var url=$(\'.title_edit\').attr(\'href\');
	$(\'.title_edit_ajax\').load(url+"&ajax=1");
	$(\'.title_edit\').hide();
	return FALSE;
});

function title_cn(){
	$(\'.title_edit\').show();
	$(\'.title_edit_ajax\').empty();
}
</script>
'; ?>
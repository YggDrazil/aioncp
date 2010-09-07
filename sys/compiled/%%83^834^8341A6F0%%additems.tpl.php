<?php /* Smarty version 2.6.26, created on 2010-08-18 20:25:45
         compiled from additems.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'itemname', 'additems.tpl', 28, false),)), $this); ?>
<?php if (isset ( $this->_tpl_vars['message'] )): ?>
	<?php $_from = $this->_tpl_vars['message']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msg']):
?>
<div class="toolTip tpBlue clearfix" >
	<p>
		<img src="<?php echo @TPL_URL; ?>
img/icons/light-bulb-off.png" alt="Tip!" />
		<?php echo $this->_tpl_vars['msg']; ?>

	</p>

	<a class="close" title="Close"></a>
</div>
 <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>


<div class="fields">
<h2><?php echo $this->_tpl_vars['lang']['additemtitle']; ?>
</h2>
<form method="post">

<p>
	<label class="small"><?php echo $this->_tpl_vars['lang']['iditem']; ?>
</label>
	<input type="text" name='id' id='iid' pattern="([0-9]+)" required class="sText"/><a href='#' onclick="$('.fastlist').toggle('fast');" title='Fast items'>
	
	<img src='<?php echo @TPL_URL; ?>
i/wizard.png' title='Fast items'></a>
</p>

<p class='fastlist hideme'>

<a href='javascript:void(0)' onclick="add_item('182400001')"><?php echo smarty_function_itemname(array('id' => '182400001'), $this);?>
</a><br>
<a href='javascript:void(0)' onclick="add_item('162000029')"><?php echo smarty_function_itemname(array('id' => '162000029'), $this);?>
</a><br>
<a href='javascript:void(0)' onclick="add_item('162000066')"><?php echo smarty_function_itemname(array('id' => '162000066'), $this);?>
</a><br>
</p>
<p>
	<label class="small"><?php echo $this->_tpl_vars['lang']['count']; ?>
</label>
	<input type="text" name='count' value="1" pattern="([0-9]+)" required class="sText"/>

</p>
<p>
	<label class="small"><?php echo $this->_tpl_vars['lang']['eqiped']; ?>
</label>
	<input type='checkbox' value='1' name='eqip'>
</p>
<p>
	<label class="small"><?php echo $this->_tpl_vars['lang']['slot']; ?>
</label>
	<input type="text" name='slot'value="0" pattern="([0-9]+)" required class="sText"/>

</p>
<p>
	<label class="small"><a href='#' onclick="$('.switch').toggle('slow');"><?php echo $this->_tpl_vars['lang']['swidname']; ?>
</a></label>
</p>
<p class='switch'>
	<label class="small"><?php echo $this->_tpl_vars['lang']['char_name']; ?>
</label>
	<input type='text' name='name' class="sText">

</p>

<p class='switch hideme'>
	<label class="small"><?php echo $this->_tpl_vars['lang']['char_id']; ?>
</label>
	<input type='text' name='char_id' pattern="([0-9]+)" class="sText">

</p>
	<input type='submit' value='<?php echo $this->_tpl_vars['lang']['additem']; ?>
' class='editbtn1 butDef'>

</form>

</div><!-- fields -->
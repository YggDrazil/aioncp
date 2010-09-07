<?php /* Smarty version 2.6.26, created on 2010-08-18 20:17:28
         compiled from account.tpl */ ?>
<?php if ($this->_tpl_vars['message']): ?>
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
<h2><a href="javascript:void(0)" onclick="$('#accinfo').slideToggle(500)" style="color:black; text-decoration:none"><?php echo $this->_tpl_vars['lang']['acc_info']; ?>
</a></h2>
<form method="post" id='accinfo'>
<p> 
	<label for="name02" class="small"><?php echo $this->_tpl_vars['lang']['login']; ?>
</label> 
	<input type="text" name='name' id='chname' value="<?php echo $this->_tpl_vars['row']['name']; ?>
"  class="sText"/> 
	<a href='javascript:;' signal="?action=bookmarks&name=<?php echo $this->_tpl_vars['row']['name']; ?>
&id=<?php echo $this->_tpl_vars['row']['id']; ?>
" class="click_signal addfav" title='<?php echo $this->_tpl_vars['lang']['addbookm']; ?>
'><img src='<?php echo @TPL_URL; ?>
i/bookmark_add.png' title='<?php echo $this->_tpl_vars['lang']['addbookm']; ?>
'></a>
				
</p>
<p> 
	<label for="name02" class="small"><?php echo $this->_tpl_vars['lang']['password']; ?>
</label> 
	<input type="text" name='password' class="sText"/>
				
</p>
<p> 
	<label for="name02" class="small"><?php echo $this->_tpl_vars['lang']['active']; ?>
</label> 
	<input type="checkbox" <?php echo $this->_tpl_vars['active']; ?>
 name="activated" value="1">
				
</p>
<p> 
	<label for="name02" class="small"><?php echo $this->_tpl_vars['lang']['acl']; ?>
</label> 
	<input type="text" name='access_level' value="<?php echo $this->_tpl_vars['row']['access_level']; ?>
"  class="sText"/>
</p>
<p> 
	<label for="name02" class="small"><?php echo $this->_tpl_vars['lang']['email']; ?>
</label> 
	<input type="text" name='email' value="<?php echo $this->_tpl_vars['row']['email']; ?>
"  class="sText"/>
				
</p>
<p> 
	<label for="name02" class="small"><?php echo $this->_tpl_vars['lang']['last_ip']; ?>
</label> 
	<?php if ($this->_tpl_vars['row']['last_ip'] == ''): ?><?php echo $this->_tpl_vars['lang']['nodata']; ?>
<?php else: ?><?php echo $this->_tpl_vars['row']['last_ip']; ?>
 <a title="WhoIs" href="http://whois.domaintools.com/<?php echo $this->_tpl_vars['row']['last_ip']; ?>
" target="_blank"><img src="<?php echo @TPL_URL; ?>
img/icons/marker.png" title="WhoIs"></a><?php endif; ?>		
</p>
	<input type='submit' value='<?php echo $this->_tpl_vars['lang']['edit']; ?>
' class='editbtn1 butDef'>

</form>

<h2><a href="javascript:void(0)" onclick="$('.chars').slideToggle(500)" title="<?php echo $this->_tpl_vars['lang']['clickme']; ?>
" style="color:black; text-decoration:none"><?php echo $this->_tpl_vars['lang']['acc_char']; ?>
</a></h2>

<div class='chars hideme'>		
<?php if ($this->_tpl_vars['char_list'] == FALSE): ?> 
	<?php echo $this->_tpl_vars['lang']['no_char']; ?>

<?php else: ?>
	<?php $_from = $this->_tpl_vars['char_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['char']):
?>
	 	<h3><a href='javascript:void(0)' onclick="ajax_char('<?php echo $this->_tpl_vars['key']; ?>
','#ajax<?php echo $this->_tpl_vars['key']; ?>
');ajaxbox(<?php echo $this->_tpl_vars['key']; ?>
)" title='<?php echo $this->_tpl_vars['lang']['preload']; ?>
'><?php echo $this->_tpl_vars['char']; ?>
</a></h3>
	 	<div id="ajax<?php echo $this->_tpl_vars['key']; ?>
" title="<?php echo $this->_tpl_vars['char']; ?>
"></div>
	 <?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
</div>
</div><!-- fields -->

<?php echo '

<script type="text/javascript">
	$(function() {
		$("a", ".chars").button();
	});

	function ajaxbox(key){
		$(\'#ajax\'+key).dialog({width:350});
	}
	
	</script>
'; ?>

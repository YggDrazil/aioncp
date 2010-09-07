<?php /* Smarty version Smarty3-b8, created on 2010-07-14 04:10:45
         compiled from "themes/account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20832767764c3d00857b0108-49793053%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '508e3c2b5417a4fa52b7424e8ac370c44875503a' => 
    array (
      0 => 'themes/account.tpl',
      1 => 1278812946,
    ),
  ),
  'nocache_hash' => '20832767764c3d00857b0108-49793053',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('message')->value){?>
	<?php  $_smarty_tpl->tpl_vars['msg'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('message')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['msg']->key => $_smarty_tpl->tpl_vars['msg']->value){
?>
<div class="toolTip tpBlue clearfix" > 
	<p> 
		<img src="<?php echo @TPL_URL;?>
img/icons/light-bulb-off.png" alt="Tip!" /> 
		<?php echo $_smarty_tpl->getVariable('msg')->value;?>

	</p> 
	
	<a class="close" title="Close"></a> 
</div> 
 <?php }} ?>
<?php }?>


<div class="fields"> 
<h2><a href="javascript:void(0)" onclick="$('#accinfo').slideToggle(500)" style="color:black; text-decoration:none"><?php echo $_smarty_tpl->getVariable('lang')->value['acc_info'];?>
</a></h2>
<form method="post" id='accinfo'>
<p> 
	<label for="name02" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['login'];?>
</label> 
	<input type="text" name='name' id='chname' value="<?php echo $_smarty_tpl->getVariable('row')->value['name'];?>
"  class="sText"/> 
	<a href='javascript:;' signal="?action=bookmarks&name=<?php echo $_smarty_tpl->getVariable('row')->value['name'];?>
&id=<?php echo $_smarty_tpl->getVariable('row')->value['id'];?>
" class="click_signal addfav" title='<?php echo $_smarty_tpl->getVariable('lang')->value['addbookm'];?>
'><img src='<?php echo @TPL_URL;?>
i/bookmark_add.png' title='<?php echo $_smarty_tpl->getVariable('lang')->value['addbookm'];?>
'></a>
				
</p>
<p> 
	<label for="name02" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['password'];?>
</label> 
	<input type="text" name='password' class="sText"/>
				
</p>
<p> 
	<label for="name02" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['active'];?>
</label> 
	<input type="checkbox" <?php echo $_smarty_tpl->getVariable('active')->value;?>
 name="activated" value="1">
				
</p>
<p> 
	<label for="name02" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['acl'];?>
</label> 
	<input type="text" name='access_level' value="<?php echo $_smarty_tpl->getVariable('row')->value['access_level'];?>
"  class="sText"/>
</p>
<p> 
	<label for="name02" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['email'];?>
</label> 
	<input type="text" name='email' value="<?php echo $_smarty_tpl->getVariable('row')->value['email'];?>
"  class="sText"/>
				
</p>
<p> 
	<label for="name02" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['last_ip'];?>
</label> 
	<?php if ($_smarty_tpl->getVariable('row')->value['last_ip']==''){?><?php echo $_smarty_tpl->getVariable('lang')->value['nodata'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('row')->value['last_ip'];?>
 <a title="WhoIs" href="http://whois.domaintools.com/<?php echo $_smarty_tpl->getVariable('row')->value['last_ip'];?>
" target="_blank"><img src="<?php echo @TPL_URL;?>
img/icons/marker.png" title="WhoIs"></a><?php }?>		
</p>
	<input type='submit' value='<?php echo $_smarty_tpl->getVariable('lang')->value['edit'];?>
' class='editbtn1 butDef'>

</form>

<h2><a href="javascript:void(0)" onclick="$('.chars').slideToggle(500)" title="<?php echo $_smarty_tpl->getVariable('lang')->value['clickme'];?>
" style="color:black; text-decoration:none"><?php echo $_smarty_tpl->getVariable('lang')->value['acc_char'];?>
</a></h2>

<div class='chars hideme'>		
<?php if ($_smarty_tpl->getVariable('char_list')->value==FALSE){?> 
	<?php echo $_smarty_tpl->getVariable('lang')->value['no_char'];?>

<?php }else{ ?>
	<?php  $_smarty_tpl->tpl_vars['char'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('char_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['char']->key => $_smarty_tpl->tpl_vars['char']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['char']->key;
?>
	 	<h3><a href='javascript:void(0)' onclick="ajax_char('<?php echo $_smarty_tpl->getVariable('key')->value;?>
','#ajax<?php echo $_smarty_tpl->getVariable('key')->value;?>
');ajaxbox(<?php echo $_smarty_tpl->getVariable('key')->value;?>
)" title='<?php echo $_smarty_tpl->getVariable('lang')->value['preload'];?>
'><?php echo $_smarty_tpl->getVariable('char')->value;?>
</a></h3>
	 	<div id="ajax<?php echo $_smarty_tpl->getVariable('key')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('char')->value;?>
"></div>
	 <?php }} ?>
<?php }?>
</div>
</div><!-- fields -->



<script type="text/javascript">
	$(function() {
		$("a", ".chars").button();
	});

	function ajaxbox(key){
		$('#ajax'+key).dialog({width:350});
	}
	
	</script>


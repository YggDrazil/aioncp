<?php /* Smarty version Smarty3-b8, created on 2010-07-14 04:27:56
         compiled from "themes/search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18470052384c3d048c094be7-70816213%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae24c8a47c135268c13677fdc2b92330475b3834' => 
    array (
      0 => 'themes/search.tpl',
      1 => 1278814175,
    ),
  ),
  'nocache_hash' => '18470052384c3d048c094be7-70816213',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="fields"> 
<div class='toolTip tpBlue clearfix'>
  			<p><img src='<?php echo @TPL_URL;?>
img/icons/light-bulb-off.png' /><?php echo $_smarty_tpl->getVariable('lang')->value['searchnotice'];?>
</p>
  			<a class='close' title='Close'></a>
  		</div>

<table>
	<tr>
		<td><?php echo $_smarty_tpl->getVariable('lang')->value['search_account_name'];?>
</td>
		<td><input type='search' results="10" class='sText' placeholder="Введите часть логина" name='account_search' id='account_search'></td>
	</tr>
	<tr>
		<td><?php echo $_smarty_tpl->getVariable('lang')->value['char_name'];?>
</td>
		<td><input type='search' results="10" class='sText' placeholder="Введите начало ника" name='char_name' id='char_name'></td>
	</tr>
	<tr>
		<td><?php echo $_smarty_tpl->getVariable('lang')->value['searchemail'];?>
</td>
		<td><input type='search' results="10" class='sText' placeholder="Введите часть email"  name='email_search' id='email_search'></td>
	</tr>
	<tr>
		<td>IP</td>
		<td><input type='search' results="10" class='sText' placeholder="Введите начало IP" name='ip_search' id='ip_search'></td>
	</tr>
</table>
<div id='ajax_result'></div>  		
</div>

<script type="text/javascript">$('#account_search').keyup(function(){
	$('#loader').fadeIn('fast');
	$('#ajax_result').load('?action=search&type=account_search&account_search='+$('#account_search').val(),
	function(){$('#loader').fadeOut('slow');});
});
$('#char_name').keyup(function(){
	$('#loader').fadeIn('fast');
	$('#ajax_result').load('?action=search&type=char_name&char_name='+$('#char_name').val(),
	function(){$('#loader').fadeOut('slow');});
});
$('#email_search').keyup(function(){
	$('#loader').fadeIn('fast');
	$('#ajax_result').load('?action=search&type=email_search&email_search='+$('#email_search').val(),
	function(){$('#loader').fadeOut('slow');});
});
$('#ip_search').keyup(function(){
	$('#loader').fadeIn('fast');
	$('#ajax_result').load('?action=search&type=ip_search&ip_search='+$('#ip_search').val(),
	function(){$('#loader').fadeOut('slow');});
});
</script>


<div class="fields"> 
<div class='toolTip tpBlue clearfix'>
  			<p><img src='{$smarty.const.TPL_URL}img/icons/light-bulb-off.png' />{$lang.searchnotice}</p>
  			<a class='close' title='Close'></a>
  		</div>

<table>
	<tr>
		<td>{$lang.search_account_name}</td>
		<td><input type='search' results="10" class='sText' placeholder="Введите часть логина" name='account_search' id='account_search'></td>
	</tr>
	<tr>
		<td>{$lang.char_name}</td>
		<td><input type='search' results="10" class='sText' placeholder="Введите начало ника" name='char_name' id='char_name'></td>
	</tr>
	<tr>
		<td>{$lang.searchemail}</td>
		<td><input type='search' results="10" class='sText' placeholder="Введите часть email"  name='email_search' id='email_search'></td>
	</tr>
	<tr>
		<td>IP</td>
		<td><input type='search' results="10" class='sText' placeholder="Введите начало IP" name='ip_search' id='ip_search'></td>
	</tr>
</table>
<div id='ajax_result'></div>  		
</div>
{literal}
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
{/literal}

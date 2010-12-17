{if $message}
	{foreach item=msg from=$message}
<div class="toolTip tpBlue clearfix" > 
	<p> 
		<img src="{$smarty.const.TPL_URL}img/icons/light-bulb-off.png" alt="Tip!" /> 
		{$msg}
	</p> 
	
	<a class="close" title="Close"></a> 
</div> 
 {/foreach}
{/if}


<div class="fields"> 
<h2><a href="javascript:void(0)" onclick="$('#accinfo').slideToggle(500)" style="color:black; text-decoration:none">{$lang.acc_info}</a></h2>
<form method="post" id='accinfo'>
<p> 
	<label for="name02" class="small">Account ID</label> 
	<b>{$row.id}</b>			
</p>

<p> 
	<label for="name02" class="small">{$lang.login}</label> 
	<input type="text" name='name' id='chname' value="{$row.name}"  class="sText"/> 
	<a href='javascript:;' signal="?action=bookmarks&name={$row.name}&id={$row.id}" class="click_signal addfav" title='{$lang.addbookm}'><img src='{$smarty.const.TPL_URL}i/bookmark_add.png' title='{$lang.addbookm}'></a>
				
</p>
<p> 
	<label for="name02" class="small">{$lang.password}</label> 
	<input type="text" name='password' class="sText"/>
				
</p>
<p> 
	<label for="name02" class="small">{$lang.active}</label> 
	<input type="checkbox" {$active} name="activated" value="1">
</p>

<p> 
	<label for="membership" class="small">Membership</label>
	<select name='membership' class="sSelect">
		 		<option {if $row.membership == 0}selected="selected"{/if} value='0'>normal</option>
		 		<option {if $row.membership == 1}selected="selected"{/if} value='1'>premium</option>
		 		<option {if $row.membership == 2}selected="selected"{/if} value='2'>vip</option>
	</select>	 		 		
</p>

<p> 
	<label for="name02" class="small">{$lang.acl}</label> 
	<input type="text" name='access_level' value="{$row.access_level}"  class="sText"/>
</p>
<p> 
	<label for="name02" class="small">{$lang.email}</label> 
	<input type="text" name='email' value="{$row.email}"  class="sText"/>
				
</p>
<p> 
	<label for="name02" class="small">{$lang.last_ip}</label> 
	{if $row.last_ip==''}{$lang.nodata}{else}{$row.last_ip} <a title="WhoIs" href="http://whois.domaintools.com/{$row.last_ip}" target="_blank"><img src="{$smarty.const.TPL_URL}img/icons/marker.png" title="WhoIs"></a>{/if}		
</p>
	<input type='submit' value='{$lang.edit}' class='editbtn1 butDef'>

</form>
<br />
<p> 
	<label class="big red"><b><a href="javascript:;" onclick="$('#deleteme').slideToggle('slow');">{$lang.delete_account}</a></b></label> 	
</p>

<p class="hideme" id="deleteme"><a href="?action=deleteaccount&account_id={$row.id}">{$lang.delete}</a></p>

<h2><a href="javascript:void(0)" onclick="$('.chars').slideToggle(500)" title="{$lang.clickme}" style="color:black; text-decoration:none">{$lang.acc_char}</a></h2>

<div class='chars hideme'>		
{if $char_list==FALSE} 
	{$lang.no_char}
{else}
	{foreach key=key item=char from=$char_list}
	 	<h2><a href='?action=char&char_id={$key}'>{$char}</a> <a href='javascript:void(0)' onclick="ajax_char('{$key}','#ajax{$key}');ajaxbox({$key})" title='{$lang.preload}'>?</a></h2>
		{*<h3><a href='javascript:void(0)' onclick="ajax_char('{$key}','#ajax{$key}');ajaxbox({$key})" title='{$lang.preload}'>{$char}</a></h3>*}
	 	<div id="ajax{$key}" title="{$char}"></div>
	 {/foreach}
{/if}
</div>
</div><!-- fields -->

{literal}

<script type="text/javascript">
	$(function() {
		//$("a", ".chars").button();
	});

	function ajaxbox(key){
		$('#ajax'+key).dialog({width:350});
	}
	
</script>
<style type="text/css">
.red a{color:red;}
#deleteme a{ 
background-color:red; 
padding:5px; 
color:#FFF;
border-radius: 10px;
text-decoration:none;
font-weight:bold;
}

#deleteme a:hover{ 
  background-color:#B80B36; 
}
</style>
{/literal}

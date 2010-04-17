{if $message}
	{foreach item=msg from=$message}
<div class="toolTip tpBlue clearfix" > 
	<p> 
		<img src="themes/img/icons/light-bulb-off.png" alt="Tip!" /> 
		{$msg}
	</p> 
	
	<a class="close" title="Close"></a> 
</div> 
 {/foreach}
{/if}


<div class="fields"> 
<h2><a href="javascript:void(0)" onclick="$('#accinfo').slideToggle(500)"  style="color:black; text-decoration:none">{$lang.acc_info}</a></h2>
<form method="post" id='accinfo'>
<p> 
	<label for="name02" class="small">{$lang.login}</label> 
	<input type="text" name='name' id='chname' value="{$row.name}"  class="sText"/> 
	<a href='javascript:void(0)' onclick="add_bookmark('{$row.id}','{$row.name}');$(this).fadeOut('slow')" title='{$lang.addbookm}'><img src='themes/i/bookmark_add.png' title='{$lang.addbookm}'></a>
				
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
	<label for="name02" class="small">{$lang.acl}</label> 
	<input type="text" name='access_level' value="{$row.access_level}"  class="sText"/>
</p>
<p> 
	<label for="name02" class="small">{$lang.email}</label> 
	<input type="text" name='email' value="{$row.email}"  class="sText"/>
				
</p>
<p> 
	<label for="name02" class="small">{$lang.last_ip}</label> 
	{if $row.last_ip==''}{$lang.nodata}{else}{$row.last_ip} <a title="WhoIs" href="http://whois.domaintools.com/{$row.last_ip}" target="_blank"><img src="themes/img/icons/marker.png" title="WhoIs"></a>{/if}		
</p>
	<input type='submit' value='{$lang.edit}' class='editbtn1 butDef'>

</form>

<h2><a href="javascript:void(0)" onclick="$('.chars').slideToggle(500)" title="{$lang.clickme}" style="color:black; text-decoration:none">{$lang.acc_char}</a></h2>

<div class='chars hideme'>		
{if $char_list==FALSE} 
	{$lang.no_char}
{else}		
	{foreach key=key item=char from=$char_list}
	 	<h3><a href="?action=char&char_id={$key}">{$char}</a> 
	 	<a href='javascript:void(0)' onclick="ajax_char('{$key}','#AjaxPlace');" title='{$lang.preload}'><img src='themes/i/info.png'></a></h3>
	 {/foreach}
{/if}
</div>
</div><!-- fields -->

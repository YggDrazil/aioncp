
{if $rows==TRUE}
<div class="fields"> 
<h2>{$lang.friendslist} {$name}</h2>
<table border="0" cellpadding="4" cellspacing="5" class="uiTable">
<thead >
	<th>{$lang.account}</th>
	<th>{$lang.char}</th>
</thead>
	{foreach item=row name=acclist from=$rows}
	<tr style="background:#{if $smarty.foreach.acclist.iteration % 2}E9E9E9{else}F8F8F8{/if}">
		<td><a href='?action=info&char={$row.account_id}'>{$row.account_name}</a></td>
		<td><a href='?action=char&char_id={$row.id}'>{$row.name}</a></td>
	</tr>		
	{/foreach}
</table>
</div>
{else}
<h2>{$lang.friendslist} {$name}</h2>
<div class="toolTip tpRed clearfix" >
	<p>
		<img src="{$smarty.const.TPL_URL}img/icons/light-bulb-off.png" alt="Tip!" />
		{$lang.nofriends}
	</p>
	
	<a class="close" title="Close"></a>
</div>

{/if}

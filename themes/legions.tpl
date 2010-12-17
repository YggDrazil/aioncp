{if $legions}

<table border="0" cellpadding="4" cellspacing="5" class="uiTable">
<thead>
	<th><a href="?action=legions&sortby=name&orderby={if $smarty.get.orderby == "desc"}asc{else}desc{/if}">{$lang.legion}</a></th>
	<th><a href="?action=legions&sortby=level&orderby={if $smarty.get.orderby == "desc"}asc{else}desc{/if}">{$lang.level}</a></th>
	<th><a href="?action=legions&sortby=point&orderby={if $smarty.get.orderby == "desc"}asc{else}desc{/if}">{$lang.legion_point}</a></th>
	<th>Игроков</th>
</thead>
<tbody>
	{foreach item=row name=legion from=$legions}
	<tr style="background:#{if $smarty.foreach.legion.iteration % 2}E9E9E9{else}F8F8F8{/if}">
		<td><a href='?action=legion&id={$row.id}'>{$row.name}</a></td>
		<td>{$row.level}</td>
		<td>{$row.contribution_points}</td>
		<td>{$row.chars}</td>
	</tr>		
	{/foreach}
</tbody>
</table>
{else}
{$lang.legion_404}
{/if}
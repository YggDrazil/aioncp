<div class="fields">
<table border="0"  class="uiTable">
<thead >
	<th>id</th>
	<th>{$lang.name}</th>
	<th>Serial</th>
	<th>{$lang.action}</th>
</thead>
	{foreach item="row" from=$rows}
		<tr id="row{$row.id}">
			<td>{$row.id}</td>
			<td><a href='?action=info&char={$row.serial}'>{$row.name}</a></td>
			<td>{$row.serial}</td>
			<td><a href='javascript:;' class="click_signal boxshadow" signal="?action=bookmarks&delid={$row.id}"><img src='{$smarty.const.TPL_URL}i/delete.png'></a>
			</td>
		</tr>
	{/foreach}
</table>
</div>


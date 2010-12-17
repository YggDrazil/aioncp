{if isset($message) && $message}
<div class="toolTip tpBlue clearfix" >
	<p>
		<img src="themes/img/icons/light-bulb-off.png" alt="Tip!" />
		{$message}
	</p>

	<a class="close" title="Close"></a>
</div>
{/if}
{literal}
<script>
 $(document).ready(function() {
    $(".fields").accordion({
			autoHeight: false,
			navigation: true
		});
  });
</script>
{/literal}

<div class="fields">
<h3><a href="#">Квесты</a></h3>
<div>
{if !isset($smarty.get.char_id)}
<form method="post">
<table>
<tr>
	<td>Ник персонажа</td>
	<td><input type="text" name='char_name' class="sText" value=''/></td>
</tr>
<tr>
	<td>Id персонажа</td>
	<td><input type="text" name='char_id' class="sText" value=''/></td>
</tr>
</table>
<input type='submit' name='add' value='Отправить' class='editbtn1 butDef'>
</form>
{else}

{counter start=0 print=false}
<form method="post">
	<table border="0" class="uiTable">
		<thead>
		  <tr>
			<th>id</th>
			<th>{$lang.status}</th>
			<th>Переменные</th>
			<th>Пройдено раз</th>
			<th>{$lang.action}</th>
		  </tr>
		</thead>
		{foreach from=$questlist item="q"}
			{assign var="switch" value="{counter}"}
		<tr style="background:{if $switch % 2}#E9E9E9{else}#F8F8F8{/if}" id="row{$switch}">
			<td>{$q.quest_id}</td>
			<td><select name="status[{$q.quest_id}]" class="sSelect">
				<option value="NONE" {if $q.status=="NONE"}selected="selected"{/if}>Нету</option>
				<option value="COMPLETE" {if $q.status=="COMPLETE"}selected="selected"{/if}>Завершён</option>
				<option value="START" {if $q.status=="START"}selected="selected"{/if}>Начат</option>
				<option value="LOCKED" {if $q.status=="LOCKED"}selected="selected"{/if}>Заблокирован</option>
				</select>
			</td>
			<td><input type="text" name='quest_vars[{$q.quest_id}]' requered pattern="([0-9]+)" value="{$q.quest_vars}" class="sText"/></td>
			<td><input type="text" name='complete_count[{$q.quest_id}]' requered pattern="([0-9]+)" value="{$q.complete_count}" class="sText"/></td>
			<td>
				<a href="javascript:;" class="click_signal" signal="?action=quest&char_id={$smarty.get.char_id}&delete={$q.quest_id}"><img src="themes/i/delete.png" alt="" /></a>
			</td>
		</tr>
		{/foreach}

	</table>
	
	<input type='submit' name='add' value='{$lang.save}' class='editbtn1 butDef'>
	</form>
{/if}
</div>
<h3><a href="#">{$lang.add}</a></h3>
<div>
<form method="post">
<input type="hidden" name="add_quest" value="y">
<table>
<tr>
	<td>{$lang.char_id}</td>
	<td><input type="text" pattern="([0-9]+)" name='player_id' class="sText" value='{$smarty.get.char_id}'/></td>
</tr>
<tr>
	<td>ID квеста</td>
	<td><input type="text" name='quest_id' pattern="([0-9]+)" class="sText"/></td>
</tr>
<tr>
	<td>Статус</td>
	<td><select name="status" class="sSelect">
		<option value="NONE">Нету</option>
		<option value="COMPLETE">Завершён</option>
		<option value="START">Начат</option>
		<option value="LOCKED">Заблокирован</option>
	</select></td>
</tr>
<tr>
	<td>Переменная</td>
	<td><input type="text" name='quest_vars' class="sText" value="0" /></td>
</tr>
<tr>
	<td>Пройдено раз</td>
	<td><input type="text" name='complete_count' class="sText" value="0" /></td>
</tr>
</table>
<input type='submit' name='add' value='{$lang.add}' class='editbtn1 butDef'>
</form>
</div>

</div><!-- fields -->
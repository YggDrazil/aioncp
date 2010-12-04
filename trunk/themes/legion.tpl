{literal}
<script>
	$(function() {
		$(".accord").accordion({autoHeight: false});
	});

</script>
{/literal}
{if $success}
<div class="toolTip tpBlue clearfix" > 
	<p> 
		<img src="{$smarty.const.TPL_URL}img/icons/light-bulb-off.png" alt="Tip!" /> 
		{$success}
	</p> 
	
	<a class="close" title="Close"></a> 
</div> 
{/if}
{if isset($error) && $error}
<div class="toolTip tpRed clearfix" >
	<p>
		<img src="{$smarty.const.TPL_URL}img/icons/light-bulb-off.png" alt="Tip!" />
		{$error}
	</p>

	<a class="close" title="Close"></a>
</div>
{/if}	

<div class="fields accord"> 

{if $legion_info}
<h3><a href="#">Гильдия {$legion_info.name}</a></h3>
<div>

<form method="post" id='accinfo'>
<p> 
	<label for="name" class="small">Имя гильдии</label> 
	<input type="text" name='name' value="{$legion_info.name}" class="sText"/> 
				
</p>
<p> 
	<label for="level" class="small">Уровень</label> 
	<input type="text" name='level' class="sText" value="{$legion_info.level}" pattern="([0-9]+)" />
				
</p>
<p> 
	<label for="contribution_points" class="small">Очки</label> 
	<input type="text" class="sText" name="contribution_points"  pattern="([0-9]+)" value="{$legion_info.contribution_points}">
</p>

<p> 
	<label for="legionar_permission2" class="small">legionar_permission2</label> 
	<input type="text" name='legionar_permission2' value="{$legion_info.legionar_permission2}" disabled="disabled" pattern="([0-9]+)" class="sText"/>		
</p>

<p> 
	<label for="centurion_permission1" class="small">centurion_permission1</label> 
	<input type="text" name='centurion_permission1' value="{$legion_info.centurion_permission1}" disabled="disabled" pattern="([0-9]+)" class="sText"/>
</p>
<p> 
	<label for="centurion_permission2" class="small">centurion_permission2</label> 
	<input type="text" name='centurion_permission2' value="{$legion_info.centurion_permission2}" disabled="disabled" pattern="([0-9]+)" class="sText"/>
				
</p>

	<input type='submit' value='{$lang.edit}' class='editbtn1 butDef'>

</form>
</div>
{/if}


<h3><a href="#">Добавить в гильдию</a></h3>
<div>
<form method="post">
<p> 
	<label for="addname" class="medium">Имя персонажа</label> 
	<input type="text" name='addname' class="sText"/> 
</p>
	<input type='submit' value='{$lang.add}' class='editbtn1 butDef'>
</form>
</div>

{if $member_list}
<h3><a href="#">Игроки гильдии</a></h3>
<div>
<table border="0" cellpadding="4" cellspacing="5" class="uiTable">
<thead>
	<th>Ник</th>
	<th>Аккаунт</th>
	<th>Уровень</th>
	<th>Ранг</th>
	<th></th>
</thead>
	{foreach item=row name=members from=$member_list}
	<tr style="background:#{if $smarty.foreach.members.iteration % 2}E9E9E9{else}F8F8F8{/if}">
		<td><a href='?action=char&char_id={$row.player_id}' target="_blank">{$row.name}</a></td>
		<td><a href="?action=info&char={$row.account_id}"  target="_blank">{$row.account_name}</a></td>
		<td>{$row.exp|level}</td>
		<td>{$row.rank}</td>
		<td><a href="javascript:;" class="click_signal del_{$row.player_id}" signal="?action=legion&id={$legion_info.id}&char_id={$row.player_id}"><img src="{$smarty.const.TPL_URL}i/delete.png" title="Удалить из гильдии" /></a></td>
	</tr>		
	{/foreach}
</table>
</div>
{else}
Нет гильдии на сервере
{/if}
</div>
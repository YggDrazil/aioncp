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
{if isset($smarty.get.char_id) && count($skils_list) > 0}
<h3><a href="#">Список скилов</a></h3>
<div>
	<table border="0" class="uiTable">
		<thead>
		  <tr>
			<th>#</th>
			<th>id</th>
			<th>Скилл</th>
			<th>Уровень</th>
			<th>Действие</th>
		  </tr>
		</thead>
		{foreach from=$skils_list item="s"}
		<tr style="background:{if $s.count % 2}#E9E9E9{else}#F8F8F8{/if}" id="row{$s.id}">
			<td>{$s.count}</td>
			<td>{$s.id}</td>
			<td><a class='aion-item-icon-medium' href='{$lang.aiondatabase}skill/{$s.id}'></a>{$s.skillname}</td>
			<td><span id="lvl{$s.id}">{$s.level}</span></td>
			<td>
				<a href="javascript:;" onclick="sadd({$s.id})"><img src="themes/i/plus.png" alt="" /></a>
				<a href="javascript:;" onclick="smin({$s.id})"><img src="themes/i/minus.png" alt="" /></a>
				<a href="javascript:;" onclick="sdel({$s.id})"><img src="themes/i/delete.png" alt="" /></a>
			</td>
		</tr>
		{/foreach}

	</table>
</div>
{/if}
<h3><a href="#">Добавить скил</a></h3>
<div>
<form method="post">
<table>
<tr>
	<td>ID Персонажа</td>
	<td><input type="text" pattern="([0-9]+)" name='player_id' class="sText" value='{$smarty.get.char_id}'/></td>
</tr>
<tr>
	<td>ID Скила</td>
	<td><input type="text" name='skillId' pattern="([0-9]+)" class="sText"/></td>
</tr>
<tr>
	<td>Уровень скила</td>
	<td><input type="text" name='skillLevel' pattern="([0-9]+)" class="sText" value='1'/></td>
</tr>
</table>
<input type='submit' name='add' value='Добавить' class='editbtn1 butDef'>
</form>
</div>
</div><!-- fields -->
<script type="text/javascript">

function sadd(element){
	var level=$('#lvl'+element).text();
	level++;
	$('#lvl'+element).text(level);
	$.get('?action=skills&char_id='+{$smarty.get.char_id}+'&skillid='+element+'&level='+level);
}

function smin(element){
	var level=$('#lvl'+element).text();
	if(level==1) return;
	level--;
	if(level < 1) level = 1;
	$('#lvl'+element).text(level);
	$.get('?action=skills&char_id='+{$smarty.get.char_id}+'&skillid='+element+'&level='+level);
}

function sdel(element){
	if (!confirm('Вы действительно хотите удалить данный скилл?')) return false;
	$('#row'+element).hide();
	$.get('?action=skills&char_id='+{$smarty.get.char_id}+'&delskillid='+element);

}

</script>
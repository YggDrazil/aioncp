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
<h3><a href="#">{$lang.skilllist}</a></h3>
<div>
	<table border="0" class="uiTable">
		<thead>
		  <tr>
			<th>#</th>
			<th>id</th>
			<th>{$lang.skill}</th>
			<th>{$lang.level}</th>
			<th>{$lang.action}</th>
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
<h3><a href="#">{$lang.add}</a></h3>
<div>
<form method="post">
<table>
<tr>
	<td>{$lang.char_id}</td>
	<td><input type="text" pattern="([0-9]+)" name='player_id' class="sText" value='{$smarty.get.char_id}'/></td>
</tr>
<tr>
	<td>{$lang.skillid}</td>
	<td><input type="text" name='skillId' pattern="([0-9]+)" class="sText"/></td>
</tr>
<tr>
	<td>{$lang.levelskill}</td>
	<td><input type="text" name='skillLevel' pattern="([0-9]+)" class="sText" value='1'/></td>
</tr>
</table>
<input type='submit' name='add' value='{$lang.add}' class='editbtn1 butDef'>
</form>
</div>
</div><!-- fields -->
<script type="text/javascript">
GET_char_id='{$smarty.get.char_id}';

{literal}
function sadd(element){
	var level=$('#lvl'+element).text();
	level++;
	$('#lvl'+element).text(level);
	$.get('?action=skills&char_id='+GET_char_id+'&skillid='+element+'&level='+level);
}

function smin(element){
	var level=$('#lvl'+element).text();
	if(level==1) return;
	level--;
	if(level < 1) level = 1;
	$('#lvl'+element).text(level);
	$.get('?action=skills&char_id='+GET_char_id+'&skillid='+element+'&level='+level);
}

function sdel(element){
	{/literal}
	if (!confirm('{$lang.acceptdelskill}')) return false;
	{literal}
	$('#row'+element).hide();
	$.get('?action=skills&char_id='+GET_char_id+'&delskillid='+element);

}
{/literal}
</script>
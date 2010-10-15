{literal}
<script>
	$(function() {
		$( "#datepicker" ).datepicker({
				dateFormat: "yy-mm-dd", 
				showAnim:"drop"
			});
		$(".accord").accordion({autoHeight: false});
	});

</script>
{/literal}

{if isset($message) && $message}
<div class="toolTip tpBlue clearfix" >
	<p>
		<img src="{$smarty.const.TPL_URL}img/icons/light-bulb-off.png" alt="Tip!" />
		{$message}
	</p>

	<a class="close" title="Close"></a>
</div>
{/if}	

<div class="fields accord">
<h3><a href="#">{$lang.banip}</a></h3>
<div>
<form method="post">
<p>
	<label for="name02" class="small">{$lang.ipadress}</label>
	<input type="text" name='ip' autofocus required pattern="([0-9.]+)" class="sText"/>

</p>
<p>
	<label for="name02" class="small">{$lang.expiredban}</label>
	<input type="text" name="date" id="datepicker" required  pattern="([0-9-:]+)" class="sText">

</p>
<input type='submit' value='{$lang.banthis}' class='editbtn1 butDef'>

</form>
</div>
{if $banlist}
<h3><a href="#">{$lang.banlist}</a></h3>
<div>
<table border="0"  class="uiTable">
<thead >
	<th>{$lang.ipadress}</th>
	<th>{$lang.expiredban}</th>
	<th>{$lang.action}</th>
</thead>
	{foreach item="row" from=$banlist}
		<tr id="row{$row.id}">
			<td>{$row.mask}</td>
			<td>{$row.time_end}</td>
			<td><a href="?action=banip&del={$row.mask}"><img src="{$smarty.const.TPL_URL}i/delete.png"></a></td>
		</tr>
	{/foreach}
</table>
</div>
{/if}
	

</div><!-- fields -->
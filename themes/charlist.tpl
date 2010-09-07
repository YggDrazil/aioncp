<script>
{literal}
$(document).ready(function(){
	$('#chkey').keyup(function(){
		  var char=$('#chkey').val();
		  ajax_player(char);  
		  return false;
	});
	
	$('.pg').click(function(){
		var url=$(this).attr("href");
		$('#loader').fadeIn('fast');
		
		$('#ajax').load(url+'&ajax=1',function(){
			$('#loader').hide('slow');
		});	
		$('#loader').fadeOut('slow');
		return false;
	});
});
{/literal}
</script>

{if isset($smarty.get.ajax)==FALSE}
<form method="get">
<input type="hidden" name="action" value="char" />
<input type="text" name="char_id" class="sText" pattern="([0-9]+)" required placeholder="Введите номер персонажа"  />
<input type="submit" value="&rarr;"  class='butDef'/>
</form>
{/if}

<div id='ajax'>
{if $rows==TRUE}

<table border="0" cellpadding="4" cellspacing="5" class="uiTable">
<thead>
	<th>{$lang.char}</th>
	<th>{$lang.account}</th>
	<th>{$lang.level}</th>
</thead>
	{foreach item=row name=charlist from=$rows}
	<tr style="background:#{if $smarty.foreach.charlist.iteration % 2}E9E9E9{else}F8F8F8{/if}">
		<td><a href='?action=char&char_name={$row.name}'>{$row.name}</a></td>
		<td><a href='?action=info&char={$row.account_id}'>{$row.account_name}</a></td>
		<td>{$row.exp|level}</td>
	</tr>		
	{/foreach}
</table>
{else}
No result
{/if}
<div class="pagination">
{$pagination}
</div>
</div>
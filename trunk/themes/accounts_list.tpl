<script>
{literal}
$(document).ready(function(){
	$('#chkey').keyup(function(){
		  var char;
		  char=$('#chkey').val();
		  ajax_chars(char);  
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
<input type="hidden" name="action" value="info" />
<input type="text" name="char" class="sText" pattern="([0-9]+)" required placeholder="Введите номер аккаунта"  />
<input type="submit" value="&rarr;"  class='butDef'/>
</form>
{/if}


{if $rows==TRUE}
<div id='ajax'>
<table border="0" cellpadding="4" cellspacing="5" class="uiTable">
<thead >
	<th>{$lang.account}</th>
	<th>{$lang.char}</th>
</thead>
	{foreach item=row name=acclist from=$rows}
	<tr style="background:#{if $smarty.foreach.acclist.iteration % 2}E9E9E9{else}F8F8F8{/if}">
		<td><a href='?action=info&char={$row.account_id}'>{$row.account_name}</a></td>
		<td><a href='?action=char&char_name={$row.name}'>{$row.name}</a></td>
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
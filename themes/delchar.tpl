{if isset($message) && $message}
<div class="toolTip tpBlue clearfix" > 
	<p> 
		<img src="{$smarty.const.TPL_URL}img/icons/light-bulb-off.png" alt="Tip!" /> 
		{$message}
	</p> 
	
	<a class="close" title="Close"></a> 
</div> 
{/if}


<div class="fields"> 
<form method="post">
<h2>Удаление персонажа #{$smarty.get.char_id}</h2>
{if $deleted}
<p style="color:green">Персонаж полностью удалён из базы.</p>
<table class="uiTable">
{foreach from=$log item="l"}
    <tr>
        <td>{$l.query}</td>
        <td>{$l.affected}</td>
    </tr>
{/foreach}
</table>
{else}
<p style="color:red">Вы действительно уверены что хотите навсегда удалить персонажа с id {$smarty.get.char_id}?</p>
<input type="hidden" name="char_id" value="{$smarty.get.char_id}" />
<input type='submit' class='editbtn1 butDef' value='Удалить'>
{/if}
</form>

</div><!-- fields -->
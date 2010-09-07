{if $smarty.get.ajax}
<form method='post'>
		<select name='title_id' class="sSelect">
				{foreach item=val key=key from=$title_list}
			 		<option value='{$key}'{if $key==$player_title} selected="selected"{/if}>{$val}</option>
		{/foreach}
			 		</select>
	<input type="submit" name="submit" value="{$lang.edit}"  class='editbtn1 butDef'> <a href="javascript:;" onclick="title_cn()">[{$lang.cancel}]</a>
	</form>
	
{else}
<div class="fields"> 
	<input type="hidden" name="char_id" value="{$char_id}">
	<form method='post'>
	<p> 
		<label for="name02" class="small">{$lang.chartitle}</label> 
		<select name='title_id' class="sSelect">
				{foreach item=val key=key from=$title_list}
			 		<option value='{$key}'{if $key==$player_title} selected="selected"{/if}>{$val}</option>
		{/foreach}
			 		</select>
	</p>
	
	<input type="submit" name="submit" value="{$lang.edit}"  class='editbtn1 butDef'>
	</form>
	
</div>
{/if}
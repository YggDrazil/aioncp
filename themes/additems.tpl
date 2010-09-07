{if isset($message)}
	{foreach item=msg from=$message}
<div class="toolTip tpBlue clearfix" >
	<p>
		<img src="{$smarty.const.TPL_URL}img/icons/light-bulb-off.png" alt="Tip!" />
		{$msg}
	</p>

	<a class="close" title="Close"></a>
</div>
 {/foreach}
{/if}


<div class="fields">
<h2>{$lang.additemtitle}</h2>
<form method="post">

<p>
	<label class="small">{$lang.iditem}</label>
	<input type="text" name='id' id='iid' pattern="([0-9]+)" required class="sText"/><a href='#' onclick="$('.fastlist').toggle('fast');" title='Fast items'>
	
	<img src='{$smarty.const.TPL_URL}i/wizard.png' title='Fast items'></a>
</p>

<p class='fastlist hideme'>

<a href='javascript:void(0)' onclick="add_item('182400001')">{itemname id='182400001'}</a><br>
<a href='javascript:void(0)' onclick="add_item('162000029')">{itemname id='162000029'}</a><br>
<a href='javascript:void(0)' onclick="add_item('162000066')">{itemname id='162000066'}</a><br>
</p>
<p>
	<label class="small">{$lang.count}</label>
	<input type="text" name='count' value="1" pattern="([0-9]+)" required class="sText"/>

</p>
<p>
	<label class="small">{$lang.eqiped}</label>
	<input type='checkbox' value='1' name='eqip'>
</p>
<p>
	<label class="small">{$lang.slot}</label>
	<input type="text" name='slot'value="0" pattern="([0-9]+)" required class="sText"/>

</p>
<p>
	<label class="small"><a href='#' onclick="$('.switch').toggle('slow');">{$lang.swidname}</a></label>
</p>
<p class='switch'>
	<label class="small">{$lang.char_name}</label>
	<input type='text' name='name' class="sText">

</p>

<p class='switch hideme'>
	<label class="small">{$lang.char_id}</label>
	<input type='text' name='char_id' pattern="([0-9]+)" class="sText">

</p>
	<input type='submit' value='{$lang.additem}' class='editbtn1 butDef'>

</form>

</div><!-- fields -->

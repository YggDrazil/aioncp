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
<h2>Отправка письма</h2>
<form method="post">
<p>
	<label class="small">Заголовок письма</label>
	<input type="text" name='mailTitle' required class="sText"/>

</p>

<p>
	<label class="small">Сообщение</label>
	<input type="text" name='mailMessage' class="sText"/>
</p>

<p>
	<label class="small">Отправитель</label>
	<input type="text" name='Sender' required class="sText"/>

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

<p>
	<label class="small">Отправить кинах</label>
	<input type="text" name='attachedKinahCount' pattern="([0-9]+)" required class="sText"/>

</p>

<h2><a href="#" onclick="$('.items').toggle('slow'); return false;">Предмет</a></h2>
<div class="items hideme">
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
	<label class="small">{$lang.slot}</label>
	<input type="text" name='slot' value="0" pattern="([0-9]+)" required class="sText"/>
</p>
</div>
	<input type='submit' value='Отправить' class='editbtn1 butDef'>

</form>

</div><!-- fields -->

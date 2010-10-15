<div class="fields">

<input type="hidden" name="id" value="{$row.Id}" id="id">
<p>
	<label class="small">{$lang.item}</label>
	<input type="text" name='itemId' id="itemId" value="{$row.itemId}" class="sText"/>
</p>
<p>
	<label class="small">{$lang.min}</label>
	<input type="text" name='min' id="min" value="{$row.min}" class="sText"/>
</p>
<p>
	<label class="small">{$lang.max}</label>
	<input type="text" name='max'  id="max" value="{$row.max}" class="sText"/>

</p>
<p>
	<label class="small">{$lang.monsterid}</label>
	<input type="text" name='mobId' id="mobId" value="{$row.mobId}" class="sText"/>

</p>
<p class='switch'>
	<label class="small">{$lang.chance}</label>
	<input type="text" name='chance' id="chance" value="{$row.chance}" class="sText"/>

</p>
</div><!-- fields -->
<div class="fields">

<input type="hidden" name="id" value="{$row.Id}" id="id">
<p>
	<label class="small">Предмет</label>
	<input type="text" name='itemId' id="itemId" value="{$row.itemId}" class="sText"/>
</p>
<p>
	<label class="small">Мин</label>
	<input type="text" name='min' id="min" value="{$row.min}" class="sText"/>
</p>
<p>
	<label class="small">Макс</label>
	<input type="text" name='max'  id="max" value="{$row.max}" class="sText"/>

</p>
<p>
	<label class="small">Id моба</label>
	<input type="text" name='mobId' id="mobId" value="{$row.mobId}" class="sText"/>

</p>
<p class='switch'>
	<label class="small">Шанс</label>
	<input type="text" name='chance' id="chance" value="{$row.chance}" class="sText"/>

</p>
</div><!-- fields -->
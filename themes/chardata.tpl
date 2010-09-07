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
<h2>{$lang.char_data}</h2>
<p> 
	<label for="name02" class="small">{$lang.abyss}</label> 
	<input type="text" name='abyss' value="{$abyss}"  class="sText"/> 
	<input type='submit' value='{$lang.edit}' name='editabyss' class='editbtn1 butDef'>
				
</p>
<p> 
	<label for="name02" class="small">{$lang.coordinate}</label> 
	X: <b>{$row.x}</b> Y: <b>{$row.y}</b> Z: <b>{$row.z}</b>
</p>
<p> 
	<label for="name02" class="small">{$lang.move}</label> 
	<select name='cordinate' class="sSelect">
		 		<option value='1'>Sanctum</option>
		 		<option value='2'>Poeta</option>
		 		<option value='3'>Verteron</option>
		 		<option value='4'>Eltnen</option>
		 		<option value='5'>Theobomos</option>
		 		<option value='6'>Interdiktah</option>
		 		<option value='7'>Pandaemonium</option>
		 		<option value='8'>Ishalgen (Asmodian Starting Zone)</option>
		 		<option value='9'>Altgard</option>
		 		<option value='10'>Morheim</option>
		 		<option value='11'>Brusthonin</option>
		 		<option value='12'>Beluslan</option>
		 		<option value='13'>Ereshuranta (Abyss)</option>
		 		<option value='14'>No Zone Name</option>
		 		<option value='15'>Karamatis</option>
		 		<option value='16'>Karamatis 2</option>
		 		<option value='17'>Aerdina (Abyss Gate)</option>
		 		<option value='18'>Geranaia (Abyss Gate)</option>
		 		<option value='19'>Lepharist (Bio Experiment Lab)</option>
		 		<option value='20'>Fragment of Darkness</option>
		 		<option value='21'>Fragment of Darkness 2</option>
		 		<option value='22'>Sanctum Underground Arena</option>
		 		<option value='23'>Indratu (Castle Indratu) </option>
				<option value='20'>Altgard</option>
		 		</select>
		 			<input type='submit' name='teleport' class='editbtn1 butDef' value='{$lang.move}'>
		 		
				
</p>
<p> 
	<label for="name02" class="small">{$lang.status}</label> 
	{if $online}<font color="lime">{$lang.online}</font> <img src="{$smarty.const.TPL_URL}i/error.png">{else}<font color="red">{$lang.offline}</font> <img src="{$smarty.const.TPL_URL}i/success.gif">{/if}
				
</p>
<p> 
	<label for="name02" class="small">{$lang.level}</label> 
	{$level}
	<a href='javascript:void(0)' onclick="$('.chlevel').toggle('slow')" title='{$lang.edit}'>
		 			<img src='{$smarty.const.TPL_URL}i/edit.png' title='{$lang.edit}'></a>			
</p>

<p class='chlevel hideme'> 
	<label for="name02" class="small">EXP:</label> 
	<input type='text' class='level sText' name='level' value='{$row.exp}'>
	<input type='submit' name='editlevel' class='editbtn1 butDef' value='{$lang.edit}'>
	<a href='javascript:;' onclick="$('.ll').slideToggle('slow')"><img src='{$smarty.const.TPL_URL}i/wizard.png'></a>
	<br>
	<span class='ll hideme'>{$LevelList}</span>
				
</p>
</form>

</div><!-- fields -->
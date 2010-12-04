<div class="fields"> 
<form method="post" action="?action=char&char_id={$row.id}">
	{if $ajax==FALSE}<h2>{$lang.charinfo} {$row.name}</h2>{/if} 
	{if isset($smarty.post.name)}
		<div class="toolTip tpGreen clearfix" >
	<p>
		<img src="{$smarty.const.TPL_URL}img/icons/light-bulb-off.png" alt="Tip!" />
		{$lang.succupdate}
	</p>
	
	<a class="close" title="Close"></a>
</div>
{/if}	
<p> 
	<label for="name01" class="small">{$lang.chartitle}</label> 
	<a href="?action=title&char_id={$row.id}" class="title_edit" onclick="return false;" title="{$lang.edit}">{if $player_title !=''}{$player_title}{else}{$lang.n}{/if}</a><label class="title_edit_ajax"></label>
</p>	
<p>

<p> 
	<label for="name01" class="small">ID</label> 
	<a href="?action=char&char_id={$row.id}">{$row.id}</a>
</p>	
<p> 
	<label for="name01" class="small">{$lang.status}</label> 
	{if $online}<font color="lime">{$lang.online}</font> <img src="{$smarty.const.TPL_URL}i/error.png">
		{else}<font color="red">{$lang.offline}</font> <img src="{$smarty.const.TPL_URL}i/success.gif">{/if}
</p>	
<p> 
	<label for="name02" class="small">{$lang.name}</label> 
	<input type="text" name='name' id='chname' value="{$row.name}"  class="sText"/>
</p>
{if $legion.name !=='' and $legion.name}
<p>
	<label for="name02" class="small">{$lang.legion}</label> 
	<a href="?action=legion&id={$legion.id}">{$legion.name}</a> ({$lang.level} {$legion.level})
	
</p>
{/if}
<p> 
	<label for="name01" class="small">{$lang.login}</label> 
	<a href='?action=info&char={$row.account_id}' title='Open Account'>{$row.account_name}</a></p>
<p> 
	<label for="name01" class="small">{$lang.sex}</label> 
	<select class="sSelect" id="select01" name='gender'> 
		<option value="MALE" {if $row.gender=='MALE'}selected{/if}>{$lang.male}</option> 
		<option value="FEMALE" {if $row.gender=='FEMALE'}selected{/if}>{$lang.female}</option>  
	</select> 
</p>
<p> 
	<label for="name02" class="small">{$lang.race}</label> 
	<select class="sSelect" id="select01" name='race'> 
		<option value="ASMODIANS" {if $row.race=='ASMODIANS'}selected{/if}>ASMODIANS</option> 
		<option value="ELYOS" {if $row.race=='ELYOS'}selected{/if}>ELYOS</option>  
	</select> 
</p>

<p> 
	<label for="name02" class="small">{$lang.class}</label> 
	<select class="sSelect" id="select01" name='player_class'> 
		<option value="WARRIOR" {if $row.player_class=='WARRIOR'}selected{/if}>WARRIOR</option> 
		<option value="GLADIATOR" {if $row.player_class=='GLADIATOR'}selected{/if}>GLADIATOR</option>  
		<option value="TEMPLAR" {if $row.player_class=='TEMPLAR'}selected{/if}>TEMPLAR</option> 
		<option value="SCOUT" {if $row.player_class=='SCOUT'}selected{/if}>SCOUT</option> 
		<option value="ASSASSIN" {if $row.player_class=='ASSASSIN'}selected{/if}>ASSASSIN</option> 
		<option value="RANGER" {if $row.player_class=='RANGER'}selected{/if}>RANGER</option> 
		<option value="MAGE" {if $row.player_class=='MAGE'}selected{/if}>MAGE</option> 
		<option value="SORCERER" {if $row.player_class=='SORCERER'}selected{/if}>SORCERER</option> 
		<option value="SPIRIT_MASTER" {if $row.player_class=='SPIRIT_MASTER'}selected{/if}>SPIRIT MASTER</option> 
		<option value="PRIEST" {if $row.player_class=='PRIEST'}selected{/if}>PRIEST</option> 
		<option value="CLERIC" {if $row.player_class=='CLERIC'}selected{/if}>CLERIC</option> 
		<option value="CHANTER" {if $row.player_class=='CHANTER'}selected{/if}>CHANTER</option> 
	</select> 
</p>

<p> 
	<label for="name01" class="small">{$lang.create}</label> 
	{$row.creation_date}
</p>

<p> 
	<label for="name01" class="small">{$lang.lastexit}</label> 
	{$row.last_online}
</p>

<p> 
	<label for="name01" class="small">{$lang.level}</label> 
	{$level}
</p>
<input type='submit' value='{$lang.edit}' class='editbtn1 butDef'>
</form>
</div>
{literal}
<script>
$('.title_edit').click(function(){
	var url=$('.title_edit').attr('href');
	$('.title_edit_ajax').load(url+"&ajax=1");
	$('.title_edit').hide();
	return FALSE;
});

function title_cn(){
	$('.title_edit').show();
	$('.title_edit_ajax').empty();
}
</script>
{/literal}
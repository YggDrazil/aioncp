{if isset($message) && $message}
<div class="toolTip tpBlue clearfix" >
	<p>
		<img src="{$smarty.const.TPL_URL}/img/icons/light-bulb-off.png" alt="Tip!" />
		{$message}
	</p>

	<a class="close" title="Close"></a>
</div>
{/if}


<div class="fields">
<h2>{$lang.find_item}</h2>
<form method="post" action="?action=items">
<p>
	<label class="normal">{$lang.itemsearch}</label>
	<input type="text" name='item' class="sText" value="{if isset($smarty.post.item)}{$smarty.post.item}{else}{if isset($smarty.get.item)}{$smarty.get.item}{/if}{/if}"/>
</p>

<input type='submit' class='editbtn1 butDef' value='{$lang.search}'>
</form>
</div><!-- fields -->

{if isset($total) && $total!==''}
<div class="toolTip tpWhite clearfix" >
	<p>
		<img src="{$smarty.const.TPL_URL}/img/icons/light-bulb-off.png" alt="Tip!" />
		{$lang.item_founded} {$total} <span style="color:black">{$itemlink}</span>.
	</p>

	<a class="close" title="Close"></a>
</div>
{if isset($result) && $result!==''}
<h2><img src='{$smarty.const.TPL_URL}/i/delitem.png'>
    <a href='?action=items&do=delall&item={$smarty.get.item}' onclick="if (!confirm('{$lang.del_confim1} {$total} {$lang.del_confim2}')) return false;"><font color='red'>{$lang.delitem}</font></a></h2>
{$result}{else}
<h2><img src='{$smarty.const.TPL_URL}/i/showcharitems.png'> <a href='?action=items&do=showall&item={$smarty.post.item}'>{$lang.showitemowner}</a></h2>
<h2><img src='{$smarty.const.TPL_URL}/i/delitem.png'> 
    <a href='?action=items&do=delall&item={$smarty.post.item}' onclick="if (!confirm('{$lang.del_confim1} {$total} {$lang.del_confim2}')) return false;"><font color='red'>{$lang.delitem}</font></a></h2>
{/if}
{/if}
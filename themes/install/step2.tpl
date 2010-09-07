<div id='license' title="FDCore Freeware License (FFL)">
<textarea cols="200" rows="20" class="area">
{include file="install/license.tpl"}
</textarea>
</div>

{literal}
<script>
	$('.btns').button();
</script>
{/literal}

<div align="center">
<p>{$lang.acceptlic1} <a href="#" {literal} onclick="$('#license').dialog({modal: true,hide:'explode',width:600})">{/literal}{$lang.acceptlic2}</a></p>

<table border="0" cellpadding="4" cellspacing="5" class="uiTable">
<tr>
    <td><a href="?l={$smarty.get.l}&lic=yes" class="btns"><img src="{$smarty.const.TPL_URL}i/ok.png"></a></td>
    <td><a href="http://google.com" class="btns"><img src="{$smarty.const.TPL_URL}i/no.png"></a></td>
</tr>
</table>
</div>
			 
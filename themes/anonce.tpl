{if isset($message) && $message}
<div class="toolTip tpBlue clearfix" >
	<p>
		<img src="{$smarty.const.TPL_URL}img/icons/light-bulb-off.png" alt="Tip!" />
		{$message}
	</p>

	<a class="close" title="Close"></a>
</div>
{/if}

<script>

{literal}
 $(document).ready(function() {
    $(".accord").accordion({autoHeight: false});
  });

	function delete_confim(anonce_id){
			$("#dialog-confirm").dialog({
				resizable: false,
				height:140,
				modal: true,
				buttons: {
				
					'{/literal}{$lang.delete}{literal}': function() {
						$.getScript("?action=anonce&del="+anonce_id);
						$(this).dialog('close');
					},
					'{/literal}{$lang.cancel}{literal}': function() {
						$(this).dialog('close');
					}
				}
			});
	}
{/literal}
</script>

<div id="dialog-confirm" title="Вы уверены" class="hideme">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Вы уверены что хотите удалить данный анонс?</p>
</div>


<div class="fields accord">
{if isset($edit) && $edit==TRUE}
<h3><a href="#">{$lang.editannonce} {$edit_row.announce}</a></h3>
<div>
	<form method="post">
<table>

	<tr>
		<td>{$lang.message}</td>
		<td><input type="text" name='edit_announce' class="sText" value="{$edit_row.announce}"/></td>
	</tr>
	<tr>
		<td>{$lang.wshow}</td>
		<td><select name="edit_faction" class="sSelect">
			<option value="ALL" {if $edit_row.faction=="ALL"}selected="selected"{/if}>ALL</option>
			<option value="ASMODIANS" {if $edit_row.faction=="ASMODIANS"}selected="selected"{/if}>ASMODIANS</option>
			<option value="ELYOS" {if $edit_row.faction=="ELYOS"}selected="selected"{/if}>ELYOS</option>
		</select></td>
	</tr>
	<tr>
		<td>{$lang.type}</td>
		<td><select name="edit_type" class="sSelect">
			<option value="ANNOUNCE" {if $edit_row.type=="ANNOUNCE"}selected="selected"{/if}>ANNOUNCE</option>
			<option value="SHOUT" {if $edit_row.type=="SHOUT"}selected="selected"{/if}>SHOUT</option>
			<option value="ORANGE" {if $edit_row.type=="ORANGE"}selected="selected"{/if}>ORANGE</option>
			<option value="YELLOW" {if $edit_row.type=="YELLOW"}selected="selected"{/if}>YELLOW</option>
			<option value="NORMAL" {if $edit_row.type=="NORMAL"}selected="selected"{/if}>NORMAL</option>
		</select></td>
	</tr>
	<tr>
		<td>{$lang.timereply}</td>
		<td><input type="text" name='edit_delay' class="sText" value="{$edit_row.delay}"/></td>
	</tr>

</table>
<input type='submit' class='editbtn1 butDef' value='{$lang.edit}'>
</form>
</div>
{/if}

<h3><a href="#">Анонсы</a></h3>
<div>
<table border="0"  class="uiTable">
<tr>
	<th>id</th>
	<th>{$lang.message}</th>
	<th>{$lang.wshow}</th>
	<th>{$lang.type}</th>
	<th>{$lang.timereply}</th>
	<th>{$lang.action}</th>
</tr>
	{foreach item="row" from=$rows}
		<tr id="row{$row.id}">
			<td>{$row.id}</td>
			<td>{$row.announce}</td>
			<td>{$row.faction}</td>
			<td>{$row.type}</td>
			<td>{$row.delay}</td>
			<td><a href="?action=anonce&editid={$row.id}"><img src="{$smarty.const.TPL_URL}i/edit.png"></a> 
			<a href="javascript:;" onclick="delete_confim({$row.id})"><img src="{$smarty.const.TPL_URL}i/delete.png"></a></td>
		</tr>
	{/foreach}
</table>
</div>
<h3><a href="#">{$lang.addanonce}</a></h3>
<div>
	<form method="post">
<table>

	<tr>
		<td>{$lang.message}</td>
		<td><input type="text" name='announce' class="sText"/></td>
	</tr>
	<tr>
		<td>{$lang.wshow}</td>
		<td><select name="faction" class="sSelect">
			<option value="ALL">ALL</option>
			<option value="ASMODIANS">ASMODIANS</option>
			<option value="ELYOS">ELYOS</option>
		</select></td>
	</tr>
	<tr>
		<td>{$lang.type}</td>
		<td><select name="type" class="sSelect">
			<option value="ANNOUNCE">ANNOUNCE</option>
			<option value="SHOUT">SHOUT</option>
			<option value="ORANGE">ORANGE</option>
			<option value="YELLOW">YELLOW</option>
			<option value="NORMAL">NORMAL</option>
		</select></td>
	</tr>
	<tr>
		<td>{$lang.timereply}</td>
		<td><input type="text" name='delay' class="sText" placeholder="3600"/></td>
	</tr>

</table>
<input type='submit' class='editbtn1 butDef' value='{$lang.add}'>
</form>
</div>

</div><!-- fields -->
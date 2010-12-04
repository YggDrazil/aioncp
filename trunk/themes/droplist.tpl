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
    $(".droplistf").accordion({
			autoHeight: false,
			navigation: true
		});
  });
	

function delete_confim(item_id){
		$('#'+item_id).animate({ backgroundColor: "red" }, 1000);
		$("#dialog-confirm").dialog({
			resizable: false,
			height:140,
			modal: true,
			buttons: {
				'Удалить': function() {
					$('#'+item_id).load("?action=droplist&del="+item_id);
					$('#'+item_id).empty();
					$(this).dialog('close');
				},
				'Отмена': function() {
					$('#'+item_id).animate({ backgroundColor: "transparent" }, 1000);
					$(this).dialog('close');
				}
			}
		});
}

function edit_form(item_id){
			$('#edit_form').load("?action=droplist&edit="+item_id);
			$('#'+item_id).animate({ backgroundColor: "lime" }, 1000);
			$('#edit_form').attr('title',"ID "+item_id);
			
			$("#edit_form").dialog({
				resizable: false,
				width: 350 ,
				modal: true,
				buttons: {
					'Сохранить': function() {
						var param_id=$('#id').val();
						var param_itemId=$('#itemId').val();
						var param_min=$('#min').val();
						var param_max=$('#max').val();
						var param_mobId=$('#mobId').val();
						var param_chance=$('#chance').val();
						
						$.post("?action=droplist&edit="+item_id, {
							itemId: param_itemId, id: param_id, min: param_min, max: param_max, mobId: param_mobId,chance: param_chance
						},
						   function(data){
						     alert(data);
						   });
						$('#'+item_id).animate({ backgroundColor: "lime" }, 1000);
						$(this).dialog('close');
					},
					'Отмена': function() {
						$('#'+item_id).animate({ backgroundColor: "transparent" }, 1000);
						$(this).dialog('close');
					}
				}
			});
}

</script>
{/literal}
<div id="dialog-confirm" title="{$lang.arsure}" class="hideme">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$lang.accdelrop}</p>
</div>
<div id="edit_form" class="hideme" title="Form">Load...</div>
{if $message}
<div class="toolTip tpBlue clearfix" > 
	<p> 
		<img src="{$smarty.const.TPL_URL}img/icons/light-bulb-off.png" alt="Tip!" /> 
		{$message}
	</p> 
	
	<a class="close" title="Close"></a> 
</div> 
{/if}
<div class="fields droplistf">

{if $rows && count($rows) > 0}
<h3><a href="#">{$lang.itemlistbyidm}</a></h3>
<div>
<table border="0"  class="uiTable">
<thead >
	<th>id</th>
	<th>{$lang.item}</th>
	<th>{$lang.min}</th>
	<th>{$lang.max}</th>
	<th>{$lang.monsterid}</th>
	<th>{$lang.chance}</th>
	<th>{$lang.action}</th>
</thead>
	{foreach item="row" from=$rows}
		<tr id="{$row.Id}">
			<td>{$row.Id}</td>
			<td><a class='aion-item-icon-medium' href='{$lang.aiondatabase}item/{$row.itemId}'></a>{$row.itemId|itemname}</td>
			<td>{$row.min}</td>
			<td>{$row.max}</td>
			<td>{$row.mobId}</td>
			<td>{$row.chance}</td>
			<td><a href="javascript:;" onclick="edit_form({$row.Id})"><img src="{$smarty.const.TPL_URL}i/edit.png"></a> 
			<a href="javascript:;" onclick="delete_confim({$row.Id})"><img src="{$smarty.const.TPL_URL}i/delete.png"></a></td>
		</tr>
	{/foreach}
</table>
</div>
{/if}
<h3><a href="#">{$lang.workwwithdp}</a></h3>
<div>
<table>
<form method="post">
	<tr>
		<td>{$lang.monsterid}</td>
		<td><input type="text" name='mobid' class="sText" value="{if isset($smarty.post.mobid)}{$smarty.post.mobid}{/if}"/></td>
		<td><input type='submit' class='editbtn1 butDef' value='{$lang.search}'></td>
	</tr>
</form>
<form method="post">
	<tr>
		<td>{$lang.iditem}</td>
		<td><input type="text" name='itemid' class="sText" value="{if isset($smarty.post.itemid)}{$smarty.post.itemid}{/if}"/></td>
		<td><input type='submit' class='editbtn1 butDef' value='{$lang.search}'></td>
	</tr>
</form>
</table>

</div>
<h3><a href="#">{$lang.addnewrow}</a></h3>
<div>
<form method="post">
<input type="hidden" name="action" value="add">
<table>
<tr>
	<td>{$lang.monsterid}</td>
	<td><input type="text" name='mobid' class="sText"/></td>

</tr>
<tr>
	<td>{$lang.iditem}</td>
	<td><input type="text" name='itemid' class="sText"/></td>

</tr>

<tr>
	<td>{$lang.dlminchance}</td>
	<td><input type="text" name='min' class="sText" value="0"/></td>
</tr>
<tr>
	<td>{$lang.dlmaxchance}</td>
	<td><input type="text" name='max' class="sText"/></td>

</tr>
<tr>
	<td>{$lang.dlchance}</td>
	<td><input type="text" name='chance' class="sText" value="0.05"/></td>

</tr>
</table>
	<input type='submit' value='{$lang.add}' class='editbtn1 butDef'>

</form>
</div>
</div><!-- fields -->
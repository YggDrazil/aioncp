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
<h2>{$lang.items_title}</h2>
<p>{$lang.enteritemname}<input type="search" id="itemname" /></p>

	<div id="ajax">
		{$table}
		{$pagination}
	</div>

</div><!-- fields -->
<script>
{literal}
$('#itemname').keyup(function(){
	var item=$('#itemname').val();
	
	$.post("?action=itemlist", {searchname: item},
	   function(data){
	     $('#ajax').html(data);
	   });	
});{/literal}
</script>
{if isset($message) && $message}
<div class="toolTip tpBlue clearfix" > 
	<p> 
		<img src="{$smarty.const.TPL_URL}img/icons/light-bulb-off.png" alt="Tip!" /> 
		{$message}
	</p> 
	
	<a class="close" title="Close"></a> 
</div> 
{/if}

{* аккордион *}
<div class="fields accord">
	
{if isset($edit)}
<h3><a href="#">{$lang.editquery}</a></h3>
<div>
<form method="post">
<p>
	<label class="normal">{$lang.queryname}</label>
	<input type="text" name='edname' class="sText" value='{$edit.name}'/>
</p>
<p>
	<label class="normal">{$lang.querytype}</label>
	<select name='type' class='types sSelect'>
		<option value='select' {if $edit.type=='select'}selected{/if}>{$lang.return_data}</option>
		<option value='insert' {if $edit.type=='insert'}selected{/if}>{$lang.input_data}</option>
		<option value='update' {if $edit.type=='update'}selected{/if}>{$lang.update_data}</option>
	</select>
</p>

<p>
	<label class="normal">{$lang.database}</label>
	<select name='db' class="sSelect">
		<option value='login' {if $edit.db=='login'}selected{/if}>{$lang.login_server}</option>
		<option value='game' {if $edit.db=='game'}selected{/if}>{$lang.game_server}</option>
	</select>
</p>
<div id='valcontainer'>
<p>
	<table id='vals'>
		<thead>
			<td>{$lang.const}</td>
			<td>{$lang.text}</td>
		</thead>
        {foreach key=const item=text from=$edit.vars}
                <tr>
                    <td><input type="text" class="sText" name="key[]" value="{$const}"/></td>
                    <td><input type="text" class="sText" name="value[]" value="{$text}"/></td>
                </tr>
        {/foreach}
	</table>
    <a href='javascript:void(0)' id="add_row" title="{$lang.add_row}"><img src="{$smarty.const.TPL_URL}i/plus.png"/></a>
    <a href='javascript:void(0)' id="del_row" title="{$lang.del_row}"><img src="{$smarty.const.TPL_URL}i/minus.png"/></a>
</p>
</div>
<p>
	<label class="normal">{$lang.query}</label> <br>
	<textarea cols="78" rows="10" name='query' class="sTextarea">{$edit.query}</textarea>
</p>

<input type='submit' class='editbtn1 butDef' value='{$lang.edit}'>

</form>
</div>
{/if}

{if isset($result)}
<h3><a href="#">{$name}</a></h3>
<div>
{if isset($query) && $query!=""}
<div class="toolTip tpBlue clearfix" > 
	<p> 
		<img src="{$smarty.const.TPL_URL}img/icons/light-bulb-off.png" alt="Tip!" /> 
		{$query}
	</p> 
	
	<a class="close" title="Close"></a> 
</div> 
{/if}
<form method="post" action="?action=construct">
    {$result}
</form>
</div>
{/if}

{if !isset($smarty.get.show) || $smarty.get.show=='create'}
<h3><a href="#">{$lang.constr_query}</a></h3>
<div>
<form method="post">
<p> 
	<label class="normal">{$lang.queryname}</label>
	<input type="text" name='name' class="sText"/> 				
</p>
<p> 
	<label class="normal">{$lang.querytype}</label>
	<select name='type' class='types sSelect'>
		<option value='select'>{$lang.return_data}</option>
		<option value='insert'>{$lang.input_data}</option>
		<option value='update'>{$lang.update_data}</option>
	</select>
				
</p>
<p> 
	<label class="normal">{$lang.database}</label>
	<select name='db' class="sSelect">
		<option value='login'>{$lang.login_server}</option>
		<option value='game'>{$lang.game_server}</option>
	</select>
				
</p>
<div id='valcontainer'>
<p>
	<table id='vals'>
		<tr>
			<td>{$lang.const}</td>
			<td>{$lang.text}</td>
		</tr>
		<tr>
			<td><input type="text" class="sText" name="key[]"/></td>
			<td><input type="text" class="sText" name="value[]"/></td>
			
		</tr>	
	</table>
    <a href='javascript:void(0)' id="add_row" title="{$lang.add_row}"><img src="{$smarty.const.TPL_URL}i/plus.png"/></a>
    <a href='javascript:void(0)' id="del_row" title="{$lang.del_row}"><img src="{$smarty.const.TPL_URL}i/minus.png"/></a>
</p>
</div>
<p> 
	<label class="normal">{$lang.query}</label> <br>
	<textarea cols="78" rows="10" name='query' class="sTextarea"></textarea>
				
</p>
<input type='submit' class='editbtn1 butDef' value='{$lang.create}'>
</form>
</div>
{/if}

{if !isset($smarty.get.show) || $smarty.get.show=='list'}
<h3><a href="#">{$lang.query_list}</a></h3>
<div {if !isset($smarty.get.show)}class='hideme'{/if}>
    {$query_list}
</div>
{/if}
</div><!-- fields -->

<script type="text/javascript" charset="utf-8">
{literal}
$(document).ready(function() {
   $(".accord").accordion({
			autoHeight: false
		});
 });

	$('#add_row').click(function(){
		$('#vals').append('<tr><td><input type="text" class="sText" name="key[]"/></td><td><input type="text" class="sText" name="value[]"/></td></tr>');
		return false;
	});
	$('#del_row').click(function(){
		$('#vals tr:last').remove();
		return false;
	});

    $('.types').change(function(){
        var s=$('.types').val();
        $('#valcontainer').show('slow');
		
    });
{/literal}
</script>   
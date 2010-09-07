<?php /* Smarty version Smarty3-b8, created on 2010-08-01 22:17:22
         compiled from "themes/const.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18671713264c55ba322d1cc3-88308490%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '141676d4a99de5c2e9a2be70fa0798de77289021' => 
    array (
      0 => 'themes/const.tpl',
      1 => 1280686625,
    ),
  ),
  'nocache_hash' => '18671713264c55ba322d1cc3-88308490',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (isset($_smarty_tpl->getVariable('message')->value)&&$_smarty_tpl->getVariable('message')->value){?>
<div class="toolTip tpBlue clearfix" > 
	<p> 
		<img src="<?php echo @TPL_URL;?>
img/icons/light-bulb-off.png" alt="Tip!" /> 
		<?php echo $_smarty_tpl->getVariable('message')->value;?>

	</p> 
	
	<a class="close" title="Close"></a> 
</div> 
<?php }?>


<div class="fields accord">
	
<?php if (isset($_smarty_tpl->getVariable('edit')->value)){?>
<h3><a href="#"><?php echo $_smarty_tpl->getVariable('lang')->value['editquery'];?>
</a></h3>
<div>
<form method="post">
<p>
	<label class="normal"><?php echo $_smarty_tpl->getVariable('lang')->value['queryname'];?>
</label>
	<input type="text" name='edname' class="sText" value='<?php echo $_smarty_tpl->getVariable('edit')->value['name'];?>
'/>
</p>
<p>
	<label class="normal"><?php echo $_smarty_tpl->getVariable('lang')->value['querytype'];?>
</label>
	<select name='type' class='types sSelect'>
		<option value='select' <?php if ($_smarty_tpl->getVariable('edit')->value['type']=='select'){?>selected<?php }?>><?php echo $_smarty_tpl->getVariable('lang')->value['return_data'];?>
</option>
		<option value='insert' <?php if ($_smarty_tpl->getVariable('edit')->value['type']=='insert'){?>selected<?php }?>><?php echo $_smarty_tpl->getVariable('lang')->value['input_data'];?>
</option>
		<option value='update' <?php if ($_smarty_tpl->getVariable('edit')->value['type']=='update'){?>selected<?php }?>><?php echo $_smarty_tpl->getVariable('lang')->value['update_data'];?>
</option>
	</select>
</p>

<p>
	<label class="normal"><?php echo $_smarty_tpl->getVariable('lang')->value['database'];?>
</label>
	<select name='db' class="sSelect">
		<option value='login' <?php if ($_smarty_tpl->getVariable('edit')->value['db']=='login'){?>selected<?php }?>><?php echo $_smarty_tpl->getVariable('lang')->value['login_server'];?>
</option>
		<option value='game' <?php if ($_smarty_tpl->getVariable('edit')->value['db']=='game'){?>selected<?php }?>><?php echo $_smarty_tpl->getVariable('lang')->value['game_server'];?>
</option>
	</select>
</p>
<div id='valcontainer'>
<p>
	<table id='vals'>
		<thead>
			<td><?php echo $_smarty_tpl->getVariable('lang')->value['const'];?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('lang')->value['text'];?>
</td>
		</thead>
        <?php  $_smarty_tpl->tpl_vars['text'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['const'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('edit')->value['vars']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['text']->key => $_smarty_tpl->tpl_vars['text']->value){
 $_smarty_tpl->tpl_vars['const']->value = $_smarty_tpl->tpl_vars['text']->key;
?>
                <tr>
                    <td><input type="text" class="sText" name="key[]" value="<?php echo $_smarty_tpl->getVariable('const')->value;?>
"/></td>
                    <td><input type="text" class="sText" name="value[]" value="<?php echo $_smarty_tpl->getVariable('text')->value;?>
"/></td>
                </tr>
        <?php }} ?>
	</table>
    <a href='javascript:void(0)' id="add_row" title="<?php echo $_smarty_tpl->getVariable('lang')->value['add_row'];?>
"><img src="<?php echo @TPL_URL;?>
i/plus.png"/></a>
    <a href='javascript:void(0)' id="del_row" title="<?php echo $_smarty_tpl->getVariable('lang')->value['del_row'];?>
"><img src="<?php echo @TPL_URL;?>
i/minus.png"/></a>
</p>
</div>
<p>
	<label class="normal"><?php echo $_smarty_tpl->getVariable('lang')->value['query'];?>
</label> <br>
	<textarea cols="78" rows="10" name='query' class="sTextarea"><?php echo $_smarty_tpl->getVariable('edit')->value['query'];?>
</textarea>
</p>

<input type='submit' class='editbtn1 butDef' value='<?php echo $_smarty_tpl->getVariable('lang')->value['edit'];?>
'>

</form>
</div>
<?php }?>

<?php if (isset($_smarty_tpl->getVariable('result')->value)){?>
<h3><a href="#"><?php echo $_smarty_tpl->getVariable('name')->value;?>
</a></h3>
<div>
<?php if (isset($_smarty_tpl->getVariable('query')->value)&&$_smarty_tpl->getVariable('query')->value!=''){?>
<div class="toolTip tpBlue clearfix" > 
	<p> 
		<img src="<?php echo @TPL_URL;?>
img/icons/light-bulb-off.png" alt="Tip!" /> 
		<?php echo $_smarty_tpl->getVariable('query')->value;?>

	</p> 
	
	<a class="close" title="Close"></a> 
</div> 
<?php }?>
<form method="post" action="?action=construct">
    <?php echo $_smarty_tpl->getVariable('result')->value;?>

</form>
</div>
<?php }?>

<?php if (!isset($_GET['show'])||$_GET['show']=='create'){?>
<h3><a href="#"><?php echo $_smarty_tpl->getVariable('lang')->value['constr_query'];?>
</a></h3>
<div>
<form method="post">
<p> 
	<label class="normal"><?php echo $_smarty_tpl->getVariable('lang')->value['queryname'];?>
</label>
	<input type="text" name='name' class="sText"/> 				
</p>
<p> 
	<label class="normal"><?php echo $_smarty_tpl->getVariable('lang')->value['querytype'];?>
</label>
	<select name='type' class='types sSelect'>
		<option value='select'><?php echo $_smarty_tpl->getVariable('lang')->value['return_data'];?>
</option>
		<option value='insert'><?php echo $_smarty_tpl->getVariable('lang')->value['input_data'];?>
</option>
		<option value='update'><?php echo $_smarty_tpl->getVariable('lang')->value['update_data'];?>
</option>
	</select>
				
</p>
<p> 
	<label class="normal"><?php echo $_smarty_tpl->getVariable('lang')->value['database'];?>
</label>
	<select name='db' class="sSelect">
		<option value='login'><?php echo $_smarty_tpl->getVariable('lang')->value['login_server'];?>
</option>
		<option value='game'><?php echo $_smarty_tpl->getVariable('lang')->value['game_server'];?>
</option>
	</select>
				
</p>
<div id='valcontainer'>
<p>
	<table id='vals'>
		<tr>
			<td><?php echo $_smarty_tpl->getVariable('lang')->value['const'];?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('lang')->value['text'];?>
</td>
		</tr>
		<tr>
			<td><input type="text" class="sText" name="key[]"/></td>
			<td><input type="text" class="sText" name="value[]"/></td>
			
		</tr>	
	</table>
    <a href='javascript:void(0)' id="add_row" title="<?php echo $_smarty_tpl->getVariable('lang')->value['add_row'];?>
"><img src="<?php echo @TPL_URL;?>
i/plus.png"/></a>
    <a href='javascript:void(0)' id="del_row" title="<?php echo $_smarty_tpl->getVariable('lang')->value['del_row'];?>
"><img src="<?php echo @TPL_URL;?>
i/minus.png"/></a>
</p>
</div>
<p> 
	<label class="normal"><?php echo $_smarty_tpl->getVariable('lang')->value['query'];?>
</label> <br>
	<textarea cols="78" rows="10" name='query' class="sTextarea"></textarea>
				
</p>
<input type='submit' class='editbtn1 butDef' value='<?php echo $_smarty_tpl->getVariable('lang')->value['create'];?>
'>
</form>
</div>
<?php }?>

<?php if (!isset($_GET['show'])||$_GET['show']=='list'){?>
<h3><a href="#"><?php echo $_smarty_tpl->getVariable('lang')->value['query_list'];?>
</a></h3>
<div <?php if (!isset($_GET['show'])){?>class='hideme'<?php }?>>
    <?php echo $_smarty_tpl->getVariable('query_list')->value;?>

</div>
<?php }?>
</div><!-- fields -->

<script type="text/javascript" charset="utf-8">

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

</script>   
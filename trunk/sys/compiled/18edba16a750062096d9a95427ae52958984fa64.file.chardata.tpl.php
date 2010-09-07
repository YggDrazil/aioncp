<?php /* Smarty version Smarty3-b8, created on 2010-07-14 04:38:12
         compiled from "themes/chardata.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8268299704c3d06f426bd08-21839588%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18edba16a750062096d9a95427ae52958984fa64' => 
    array (
      0 => 'themes/chardata.tpl',
      1 => 1279067683,
    ),
  ),
  'nocache_hash' => '8268299704c3d06f426bd08-21839588',
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


<div class="fields"> 
<form method="post">
<h2><?php echo $_smarty_tpl->getVariable('lang')->value['char_data'];?>
</h2>
<p> 
	<label for="name02" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['abyss'];?>
</label> 
	<input type="text" name='abyss' value="<?php echo $_smarty_tpl->getVariable('abyss')->value;?>
"  class="sText"/> 
	<input type='submit' value='<?php echo $_smarty_tpl->getVariable('lang')->value['edit'];?>
' name='editabyss' class='editbtn1 butDef'>
				
</p>
<p> 
	<label for="name02" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['coordinate'];?>
</label> 
	X: <b><?php echo $_smarty_tpl->getVariable('row')->value['x'];?>
</b> Y: <b><?php echo $_smarty_tpl->getVariable('row')->value['y'];?>
</b> Z: <b><?php echo $_smarty_tpl->getVariable('row')->value['z'];?>
</b>
</p>
<p> 
	<label for="name02" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['move'];?>
</label> 
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
		 			<input type='submit' name='teleport' class='editbtn1 butDef' value='<?php echo $_smarty_tpl->getVariable('lang')->value['move'];?>
'>
		 		
				
</p>
<p> 
	<label for="name02" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['status'];?>
</label> 
	<?php if ($_smarty_tpl->getVariable('online')->value){?><font color="lime"><?php echo $_smarty_tpl->getVariable('lang')->value['online'];?>
</font> <img src="<?php echo @TPL_URL;?>
i/error.png"><?php }else{ ?><font color="red"><?php echo $_smarty_tpl->getVariable('lang')->value['offline'];?>
</font> <img src="<?php echo @TPL_URL;?>
i/success.gif"><?php }?>
				
</p>
<p> 
	<label for="name02" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['level'];?>
</label> 
	<?php echo $_smarty_tpl->getVariable('level')->value;?>

	<a href='javascript:void(0)' onclick="$('.chlevel').toggle('slow')" title='<?php echo $_smarty_tpl->getVariable('lang')->value['edit'];?>
'>
		 			<img src='<?php echo @TPL_URL;?>
i/edit.png' title='<?php echo $_smarty_tpl->getVariable('lang')->value['edit'];?>
'></a>			
</p>

<p class='chlevel hideme'> 
	<label for="name02" class="small">EXP:</label> 
	<input type='text' class='level sText' name='level' value='<?php echo $_smarty_tpl->getVariable('row')->value['exp'];?>
'>
	<input type='submit' name='editlevel' class='editbtn1 butDef' value='<?php echo $_smarty_tpl->getVariable('lang')->value['edit'];?>
'>
	<a href='javascript:;' onclick="$('.ll').slideToggle('slow')"><img src='<?php echo @TPL_URL;?>
i/wizard.png'></a>
	<br>
	<span class='ll hideme'><?php echo $_smarty_tpl->getVariable('LevelList')->value;?>
</span>
				
</p>
</form>

</div><!-- fields -->
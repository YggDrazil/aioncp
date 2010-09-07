<?php /* Smarty version Smarty3-b8, created on 2010-07-14 04:13:43
         compiled from "themes/character_info.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9858692104c3d0137776069-89781909%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7366d0476d8fb1891976b595f4ab867ff5e35d7f' => 
    array (
      0 => 'themes/character_info.tpl',
      1 => 1279066416,
    ),
  ),
  'nocache_hash' => '9858692104c3d0137776069-89781909',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="fields"> 
<form method="post" action="?action=char&char_id=<?php echo $_smarty_tpl->getVariable('row')->value['id'];?>
">
	<?php if ($_smarty_tpl->getVariable('ajax')->value==FALSE){?><h2><?php echo $_smarty_tpl->getVariable('lang')->value['charinfo'];?>
 <?php echo $_smarty_tpl->getVariable('row')->value['name'];?>
</h2><?php }?> 
	<?php if (isset($_POST['name'])){?>
		<div class="toolTip tpGreen clearfix" >
	<p>
		<img src="<?php echo @TPL_URL;?>
img/icons/light-bulb-off.png" alt="Tip!" />
		<?php echo $_smarty_tpl->getVariable('lang')->value['succupdate'];?>

	</p>
	
	<a class="close" title="Close"></a>
</div>
<?php }?>	
<p> 
	<label for="name01" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['chartitle'];?>
</label> 
	<a href="?action=title&char_id=<?php echo $_smarty_tpl->getVariable('row')->value['id'];?>
" class="title_edit" onclick="return false;" title="<?php echo $_smarty_tpl->getVariable('lang')->value['edit'];?>
"><?php if ($_smarty_tpl->getVariable('player_title')->value!=''){?><?php echo $_smarty_tpl->getVariable('player_title')->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('lang')->value['n'];?>
<?php }?></a><label class="title_edit_ajax"></label>
</p>	
<p>

<p> 
	<label for="name01" class="small">ID</label> 
	<a href="?action=char&char_id=<?php echo $_smarty_tpl->getVariable('row')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('row')->value['id'];?>
</a>
</p>	
<p> 
	<label for="name01" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['status'];?>
</label> 
	<?php if ($_smarty_tpl->getVariable('online')->value){?><font color="lime"><?php echo $_smarty_tpl->getVariable('lang')->value['online'];?>
</font> <img src="<?php echo @TPL_URL;?>
i/error.png">
		<?php }else{ ?><font color="red"><?php echo $_smarty_tpl->getVariable('lang')->value['offline'];?>
</font> <img src="<?php echo @TPL_URL;?>
i/success.gif"><?php }?>
</p>	
<p> 
	<label for="name02" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['name'];?>
</label> 
	<input type="text" name='name' id='chname' value="<?php echo $_smarty_tpl->getVariable('row')->value['name'];?>
"  class="sText"/>
</p>


<p> 
	<label for="name01" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['login'];?>
</label> 
	<a href='?action=info&char=<?php echo $_smarty_tpl->getVariable('row')->value['account_id'];?>
' title='Open Account'><?php echo $_smarty_tpl->getVariable('row')->value['account_name'];?>
</a> [Сменить логин]
</p>
<p> 
	<label for="name01" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['sex'];?>
</label> 
	<select class="sSelect" id="select01" name='gender'> 
		<option value="MALE" <?php if ($_smarty_tpl->getVariable('row')->value['gender']=='MALE'){?>selected<?php }?>><?php echo $_smarty_tpl->getVariable('lang')->value['male'];?>
</option> 
		<option value="FEMALE" <?php if ($_smarty_tpl->getVariable('row')->value['gender']=='FEMALE'){?>selected<?php }?>><?php echo $_smarty_tpl->getVariable('lang')->value['female'];?>
</option>  
	</select> 
</p>
<p> 
	<label for="name02" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['race'];?>
</label> 
	<select class="sSelect" id="select01" name='race'> 
		<option value="ASMODIANS" <?php if ($_smarty_tpl->getVariable('row')->value['race']=='ASMODIANS'){?>selected<?php }?>>ASMODIANS</option> 
		<option value="ELYOS" <?php if ($_smarty_tpl->getVariable('row')->value['race']=='ELYOS'){?>selected<?php }?>>ELYOS</option>  
	</select> 
</p>

<p> 
	<label for="name02" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['class'];?>
</label> 
	<select class="sSelect" id="select01" name='player_class'> 
		<option value="WARRIOR" <?php if ($_smarty_tpl->getVariable('row')->value['player_class']=='WARRIOR'){?>selected<?php }?>>WARRIOR</option> 
		<option value="GLADIATOR" <?php if ($_smarty_tpl->getVariable('row')->value['player_class']=='GLADIATOR'){?>selected<?php }?>>GLADIATOR</option>  
		<option value="TEMPLAR" <?php if ($_smarty_tpl->getVariable('row')->value['player_class']=='TEMPLAR'){?>selected<?php }?>>TEMPLAR</option> 
		<option value="SCOUT" <?php if ($_smarty_tpl->getVariable('row')->value['player_class']=='SCOUT'){?>selected<?php }?>>SCOUT</option> 
		<option value="ASSASSIN" <?php if ($_smarty_tpl->getVariable('row')->value['player_class']=='ASSASSIN'){?>selected<?php }?>>ASSASSIN</option> 
		<option value="RANGER" <?php if ($_smarty_tpl->getVariable('row')->value['player_class']=='RANGER'){?>selected<?php }?>>RANGER</option> 
		<option value="MAGE" <?php if ($_smarty_tpl->getVariable('row')->value['player_class']=='MAGE'){?>selected<?php }?>>MAGE</option> 
		<option value="SORCERER" <?php if ($_smarty_tpl->getVariable('row')->value['player_class']=='SORCERER'){?>selected<?php }?>>SORCERER</option> 
		<option value="SPIRIT_MASTER" <?php if ($_smarty_tpl->getVariable('row')->value['player_class']=='SPIRIT_MASTER'){?>selected<?php }?>>SPIRIT MASTER</option> 
		<option value="PRIEST" <?php if ($_smarty_tpl->getVariable('row')->value['player_class']=='PRIEST'){?>selected<?php }?>>PRIEST</option> 
		<option value="CLERIC" <?php if ($_smarty_tpl->getVariable('row')->value['player_class']=='CLERIC'){?>selected<?php }?>>CLERIC</option> 
		<option value="CHANTER" <?php if ($_smarty_tpl->getVariable('row')->value['player_class']=='CHANTER'){?>selected<?php }?>>CHANTER</option> 
	</select> 
</p>

<p> 
	<label for="name01" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['create'];?>
</label> 
	<?php echo $_smarty_tpl->getVariable('row')->value['creation_date'];?>

</p>

<p> 
	<label for="name01" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['lastexit'];?>
</label> 
	<?php echo $_smarty_tpl->getVariable('row')->value['last_online'];?>

</p>

<p> 
	<label for="name01" class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['level'];?>
</label> 
	<?php echo $_smarty_tpl->getVariable('level')->value;?>

</p>
<input type='submit' value='<?php echo $_smarty_tpl->getVariable('lang')->value['edit'];?>
' class='editbtn1 butDef'>
</form>
</div>

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

<?php /* Smarty version Smarty3-b8, created on 2010-07-16 05:03:27
         compiled from "themes/itemlist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16666055254c3fafdf7a9372-21581032%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea6689e554314ec68703187b9aa664df218fa900' => 
    array (
      0 => 'themes/itemlist.tpl',
      1 => 1279242172,
    ),
  ),
  'nocache_hash' => '16666055254c3fafdf7a9372-21581032',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (isset($_smarty_tpl->getVariable('message')->value)&&$_smarty_tpl->getVariable('message')->value){?>
<div class="toolTip tpBlue clearfix" >
	<p>
		<img src="<?php echo @TPL_URL;?>
/img/icons/light-bulb-off.png" alt="Tip!" />
		<?php echo $_smarty_tpl->getVariable('message')->value;?>

	</p>

	<a class="close" title="Close"></a>
</div>
<?php }?>


<div class="fields">
<h2>Предметы</h2>
<p>Введите имя предмета <input type="search" id="itemname" /></p>

	<div id="ajax">
		<?php echo $_smarty_tpl->getVariable('table')->value;?>

		<?php echo $_smarty_tpl->getVariable('pagination')->value;?>

	</div>

</div><!-- fields -->
<script>

$('#itemname').keyup(function(){
	var item=$('#itemname').val();
	
	$.post("?action=itemlist", {searchname: item},
	   function(data){
	     $('#ajax').html(data);
	   });	
});
</script>
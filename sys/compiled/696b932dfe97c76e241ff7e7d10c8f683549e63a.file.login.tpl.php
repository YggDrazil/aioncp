<?php /* Smarty version Smarty3-b8, created on 2010-07-11 05:09:49
         compiled from "themes/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15680131184c3919dd042157-84161794%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '696b932dfe97c76e241ff7e7d10c8f683549e63a' => 
    array (
      0 => 'themes/login.tpl',
      1 => 1278006759,
    ),
  ),
  'nocache_hash' => '15680131184c3919dd042157-84161794',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" > 
	<head>
		<title><?php echo @TITLE;?>
 &rarr; <?php echo $_smarty_tpl->getVariable('lang')->value['authorize'];?>
</title>
		<meta name="description"		content="Premium Aion Control Panel" />
		<meta name="keywords"  			content="" />
		<meta name="copyright" 			content="FDCore Studio (http://fdcore.ru)" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		 <!-- Jquery directly from google servers--> 
		<script type="text/javascript" src="<?php echo @TPL_URL;?>
js/jquery.js" ></script>
		<!-- Login javscript--> 
		<script type="text/javascript" src="<?php echo @TPL_URL;?>
js/loginui.js"></script> 
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo @TPL_URL;?>
css/reset.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo @TPL_URL;?>
css/login.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo @TPL_URL;?>
css/blue.css" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo @TPL_URL;?>
favicon.ico">
		<!-- comment extra.css for css validation -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo @TPL_URL;?>
css/extra.css" />
	</head>
		
	<body>
		<div class="boxLogin clearfix">
			 <!-- Tooltip styles  --> 
			 <?php if ((isset($_smarty_tpl->getVariable('error')->value)&&$_smarty_tpl->getVariable('error')->value!=='')){?>
			<div class="toolTip tpRed clearfix" >
				<p>
					<img src="<?php echo @TPL_URL;?>
img/icons/exclamation-red.png" alt="Tip!" />
					<?php echo $_smarty_tpl->getVariable('error')->value;?>

				</p>
				
				<a class="close" title="Close"></a>
			</div>
			<?php }?>
			<div class="ajax_div">
			<div class="toolTip tpRed clearfix ajax_msg">
				<p>
					<img src="<?php echo @TPL_URL;?>
img/icons/exclamation-red.png" alt="Tip!" />
					<span></span>
				</p>
				
				<a class="close" title="Close"></a>
			</div>
			</div>
			<form method="post">
			<div class="fields">
				<p class="sep<?php if ((isset($_smarty_tpl->getVariable('error')->value)&&$_smarty_tpl->getVariable('error')->value!=='')){?> error<?php }?>">
					<label class="small" for="user01"><?php echo $_smarty_tpl->getVariable('lang')->value['login'];?>
</label>
					<input type="text" value="<?php if (isset($_POST['login'])){?><?php echo $_POST['login'];?>
<?php }?>" name='login' class="sText" id="login"/>
				</p>
				
				<p class="sep<?php if ((isset($_smarty_tpl->getVariable('error')->value)&&$_smarty_tpl->getVariable('error')->value!=='')){?> error<?php }?>">
					<label class="small" for="pass01"><?php echo $_smarty_tpl->getVariable('lang')->value['password'];?>
</label>
					<input type="password" value="<?php if (isset($_POST['password'])){?><?php echo $_POST['password'];?>
<?php }?>" name='password' class="sText" id="password"/>
				</p>
				
				<div class="action">
					<img src='<?php echo @TPL_URL;?>
i/pie.gif' alt='wait' class="wait">  <input type="submit" class="butDef loginajax" value="<?php echo $_smarty_tpl->getVariable('lang')->value['enter'];?>
" />
				</div>
			</div>
			</form>
		</div><div style="font-size:10px; position:fixed; bottom:0px; left:0px;"><a href="http://fdcore.ru" target="_blank" title='Touch me ;)'><img src='<?php echo @TPL_URL;?>
i/F.png' alt='FDCore Studio'></a>

<?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['l']->key;
?>
  <a href='?lang=<?php echo $_smarty_tpl->getVariable('key')->value;?>
'><img src="<?php echo @TPL_URL;?>
<?php echo $_smarty_tpl->getVariable('l')->value['icon'];?>
" title="<?php echo $_smarty_tpl->getVariable('l')->value['lang'];?>
" class="lang_icon"></a> &nbsp;
<?php }} ?></div>
<script>

</script>
<!-- Copyright FDcore Studio | Powered by FDcore Studio -->
	</body>

</html>
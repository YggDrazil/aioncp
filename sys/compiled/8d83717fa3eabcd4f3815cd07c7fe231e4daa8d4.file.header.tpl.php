<?php /* Smarty version Smarty3-b8, created on 2010-08-16 06:11:53
         compiled from "themes/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6895636094c689e69edebc0-93938940%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8d83717fa3eabcd4f3815cd07c7fe231e4daa8d4' => 
    array (
      0 => 'themes/header.tpl',
      1 => 1281924712,
    ),
  ),
  'nocache_hash' => '6895636094c689e69edebc0-93938940',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" > 
	<head>
		<title><?php if (isset($_smarty_tpl->getVariable('title')->value)&&$_smarty_tpl->getVariable('title')->value!==''){?><?php echo @TITLE;?>
 &rarr; <?php echo $_smarty_tpl->getVariable('title')->value;?>
<?php }else{ ?><?php echo @TITLE;?>
<?php }?></title>
		<meta name="description"		content="Free AionCP for Aion Unique" />
		<meta name="keywords"  			content="Aion CP" />
		<meta name="copyright" 			content="FDCore Studio (www.fdcore.ru)" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		 <!-- Jquery directly from google servers--> 
		<script type="text/javascript" src="<?php echo @TPL_URL;?>
js/jquery.js" ></script>
		<script type="text/javascript" src="<?php echo @TPL_URL;?>
js/ui.js" ></script>
		 <!-- Javascript for client side table sort--> 
		<script type="text/javascript" src="<?php echo @TPL_URL;?>
js/tinytable.js"></script>
		
		 <!-- WYSIWYG Editor --> 
		<script type="text/javascript" src="<?php echo @TPL_URL;?>
js/jquery.wysiwyg.js"></script> 
		
		 <!-- Style switcher --> 
		<script type="text/javascript" src="<?php echo @TPL_URL;?>
js/stylesheetToggle.js"></script>
		
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo @TPL_URL;?>
css/reset.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo @TPL_URL;?>
css/blue.css" />
		
		
		<!-- comment extra.css for css validation -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo @TPL_URL;?>
css/extra.css" />
		
		<link rel="alternate stylesheet" title="red" type="text/css" media="all" href="<?php echo @TPL_URL;?>
css/red.css" />
		<link rel="alternate stylesheet" title="green" type="text/css" media="all" href="<?php echo @TPL_URL;?>
css/green.css" />
		<link rel="alternate stylesheet" title="brown" type="text/css" media="all" href="<?php echo @TPL_URL;?>
css/brown.css" />
		<!-- JQ UI -->
		<link type="text/css" href="<?php echo @TPL_URL;?>
css/ui-lightness/jquery-ui-1.8.1.custom.css" rel="stylesheet" />	
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo @TPL_URL;?>
favicon.ico">
		<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('lang')->value['aiondatabase'];?>
/js/exsyndication.js"></script>
		<!-- See Interface Configuration --> 
		<script type="text/javascript" src="<?php echo @TPL_URL;?>
js/seeui.js"></script>
		
		<!--[if IE 6]>
			<script type="text/javascript" src="<?php echo @TPL_URL;?>
js/ddbelatedpng.js"></script>
			<script type="text/javascript">	
				DD_belatedPNG.fix('img, .info a');
			</script>
		<![endif]-->
	</head>
		
	<body onload="$('#loader').fadeOut()">
	<div id='loader'><img src='<?php echo @TPL_URL;?>
i/wait.gif' alt='wait'></div>
		<div id="bk">
		
		 <!-- Header  --> 
		<div id="pannelDash" class="clearfix">
			
			 <!-- Tabs--> 
			<div class="menu">
				<ul>
					<li class="selected">
						<a href="#" onclick="showOnly('tabDashboard','dashWidget')"><img src="<?php echo @TPL_URL;?>
img/icons/home.png" alt="Dashboard" /><?php echo $_smarty_tpl->getVariable('lang')->value['dashboard'];?>
</a>
					</li>
					<li>
						<a href="#" onclick="showOnly('tabSettings','dashWidget')"><?php echo $_smarty_tpl->getVariable('lang')->value['settings'];?>
</a>
					</li>
					<li>
						<a href="#" onclick="showOnly('tabAccount','dashWidget')"><?php echo $_smarty_tpl->getVariable('lang')->value['profile'];?>
</a>
					</li>
				</ul>
				<div class="info">
					<div><a href="?action=logout" class="icOff"><?php echo $_smarty_tpl->getVariable('lang')->value['menu_exit'];?>
</a></div>
					<div class="user">
						<img width="27" height="27" src="<?php echo @TPL_URL;?>
img/user_icon.png" alt="<?php echo $_SESSION['login'];?>
" />
						<span><?php echo $_SESSION['login'];?>
</span>
						<br />
						<span class="detail"><?php echo $_SERVER['REMOTE_ADDR'];?>
</span>
					</div>
				</div>
				
				<div class="theme">
					<a href="#" class="styleswitch red" rel="red">&nbsp;</a>
					<a href="#" class="styleswitch green" rel="green">&nbsp;</a>
					<a href="#" class="styleswitch brown" rel="brown">&nbsp;</a>
					<a href="#" class="styleswitch blue" rel="blue">&nbsp;</a>
					<span> <?php echo $_smarty_tpl->getVariable('lang')->value['themes'];?>
 </span>
				</div>
			</div>
			
			 <!-- Dashboard fast menu (6 items)  --> 
			<?php $_template = new Smarty_Internal_Template("menu/dashboard.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

			
			 <!-- Large left widget --> 
			<div class="widget dashWidget">
				<div class="content tabContent">
					<div class="tabDashboard"><?php $_template = new Smarty_Internal_Template("menu/mainboard.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
					<div class="tabSettings" style="overflow:auto">
					<form method="post" action="?action=config">
						<div class="fields">
							<p class="sep">
								<label class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['atitle'];?>
</label>
								<input type="text" value="<?php echo @TITLE;?>
" class="sText" name='title'/>
							</p>	
							<p class="sep">
								<label class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['default_lang'];?>
</label>
								<select class="sSelect" name='lang'>
                                    <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lang_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['l']->key;
?>
									<option value="<?php echo $_smarty_tpl->getVariable('key')->value;?>
" <?php if (@DEFAULT_LANG==$_smarty_tpl->getVariable('key')->value){?>selected<?php }?> title="<?php echo $_smarty_tpl->getVariable('l')->value['lang'];?>
"><?php echo $_smarty_tpl->getVariable('l')->value['lang'];?>
</option>
									<?php }} ?>
								</select>
							</p>
							<p class="sep">
								<label class="small"><?php echo $_smarty_tpl->getVariable('lang')->value['acl'];?>
</label>
								<input type="text" value="<?php echo @ALLOW_ACL;?>
" class="sText" name='acl'/>
							</p>
							<div class="fields">
								<p> <input class="sCheck" type="checkbox" name="effect" value="on" 
								<?php if (@JS_EFFECT==TRUE){?>checked<?php }?>/><label><?php echo $_smarty_tpl->getVariable('lang')->value['effects'];?>
</label> </p>
								<p> <input class="sCheck" type="checkbox" name="debug" value="on"
								<?php if (@DEBUG==TRUE){?>checked<?php }?>/><label>Debug</label> </p>
							</div>	
							<input type="submit" class="butDef" value="<?php echo $_smarty_tpl->getVariable('lang')->value['save'];?>
" />
						</div>
						</form>
					</div>
				<div class="tabAccount">
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
" class="lang_icon boxshadow"></a> &nbsp;
                    <?php }} ?>
				</div>
				</div>
			</div>
		</div>
		
		<?php if ($_smarty_tpl->getVariable('speedbar')->value!==''){?>
		 <!-- Tooltip zone --> 
		<div class="toolTip tpYellow" >
			<p class="clearfix">
				<img src="<?php echo @TPL_URL;?>
img/icons/light-bulb-off.png" alt="Tip!" />
				<?php echo $_smarty_tpl->getVariable('speedbar')->value;?>

			</p>
			
			<a class="close" title="Close"></a>
		</div>
		<?php }?>
		
		<div id="container" class="clearfix">
			 <!-- Left Menu --> 
			<?php $_template = new Smarty_Internal_Template("menu/leftmenu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

			
			<div id="page">
				<div class="menu clearfix">
					 <!-- Page Dropdown  Menu --> 
					<ul id="pgmenu">
                        <?php if ($_smarty_tpl->getVariable('bookmarks')->value!=''){?>
						<li><a href="#" class="sub"><?php echo $_smarty_tpl->getVariable('lang')->value['bookmarks'];?>
<span>&nbsp;</span></a>
							<ul>
								<?php echo $_smarty_tpl->getVariable('bookmarks')->value;?>

							</ul>
						</li>
						<?php }?>
						
						<?php if (isset($_GET['char_id'])||isset($_GET['action'])&&$_GET['action']=='construct'){?>
						<li><a href="#" class="sub"><?php echo $_smarty_tpl->getVariable('lang')->value['action'];?>
<span>&nbsp;</span></a>
							<ul>
							<?php if (isset($_GET['char_id'])){?>
								<li><a href="?action=char&char_id=<?php echo $_GET['char_id'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['info'];?>
</a></li>
								<li><a href="?action=items&char_id=<?php echo $_GET['char_id'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['inven'];?>
</a></li>
								<li><a href="?action=chardata&char_id=<?php echo $_GET['char_id'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['char_data'];?>
</a></li>
                                <li><a href="?action=friends&char_id=<?php echo $_GET['char_id'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['friends'];?>
</a></li>
                                <li><a href="?action=mails&char_id=<?php echo $_GET['char_id'];?>
"><?php echo $_smarty_tpl->getVariable('lang')->value['mail'];?>
</a></li>
                                 <li><a href="?action=skills&char_id=<?php echo $_GET['char_id'];?>
">Скиллы</a></li>
                                <!--<li><a href="?action=delchar&char_id=<?php echo $_GET['char_id'];?>
">Удалить персонажа</a></li>-->
							<?php }?>
                            <?php if (isset($_GET['action'])&&$_GET['action']=='construct'){?>
                                <li><a href="?action=construct&show=create"><?php echo $_smarty_tpl->getVariable('lang')->value['constr_query'];?>
</a></li>
                                <li><a href="?action=construct&show=list"><?php echo $_smarty_tpl->getVariable('lang')->value['query_list'];?>
</a></li>
                                <li><a href="http://wiki.fdcore.ru/aioncp:price" target='_blank'><?php echo $_smarty_tpl->getVariable('lang')->value['buyq'];?>
</a></li>
                            <?php }?>
							</ul>
						</li>
						<?php }?>
						<?php if (isset($_GET['action'])&&$_GET['action']=='info'){?>
						<?php if (isset($_smarty_tpl->getVariable('char_list')->value)&&$_smarty_tpl->getVariable('char_list')->value!=FALSE){?> 
								<li><a href="#" class="sub"><?php echo $_smarty_tpl->getVariable('lang')->value['chars'];?>
<span>&nbsp;</span></a>
								<ul>
								<?php  $_smarty_tpl->tpl_vars['char'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('char_list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['char']->key => $_smarty_tpl->tpl_vars['char']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['char']->key;
?>
	 								<li><a href="?action=char&char_id=<?php echo $_smarty_tpl->getVariable('key')->value;?>
"><?php echo $_smarty_tpl->getVariable('char')->value;?>
</a></li>
	 							<?php }} ?>
	 							</ul>
							<?php }?></li>
						<?php }?>
						<li><a href="http://wiki.fdcore.ru/aioncp:main" title='Only Russian' target='_blank'><?php echo $_smarty_tpl->getVariable('lang')->value['help'];?>
</a></li>
					</ul>
					
					 <!-- Page title --> 
					<div><?php echo $_smarty_tpl->getVariable('title')->value;?>
</div>
					<div class="cr_pass"></div>
				</div>
				
				<div class="clearfix content">
					 <!-- Page content --> 
				
<div class="clearfix">
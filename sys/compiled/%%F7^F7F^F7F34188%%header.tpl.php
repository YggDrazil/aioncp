<?php /* Smarty version 2.6.26, created on 2010-08-18 20:35:05
         compiled from header.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" > 
	<head>
		<title><?php if (isset ( $this->_tpl_vars['title'] ) && $this->_tpl_vars['title'] !== ''): ?><?php echo @TITLE; ?>
 &rarr; <?php echo $this->_tpl_vars['title']; ?>
<?php else: ?><?php echo @TITLE; ?>
<?php endif; ?></title>
		<meta name="description"		content="Free AionCP for Aion Unique" />
		<meta name="keywords"  			content="Aion CP" />
		<meta name="copyright" 			content="FDCore Studio (www.fdcore.ru)" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		 <!-- Jquery directly from google servers--> 
		<script type="text/javascript" src="<?php echo @TPL_URL; ?>
js/jquery.js" ></script>
		<script type="text/javascript" src="<?php echo @TPL_URL; ?>
js/ui.js" ></script>
		 <!-- Javascript for client side table sort--> 
		<script type="text/javascript" src="<?php echo @TPL_URL; ?>
js/tinytable.js"></script>
		
		 <!-- WYSIWYG Editor --> 
		<script type="text/javascript" src="<?php echo @TPL_URL; ?>
js/jquery.wysiwyg.js"></script> 
		
		 <!-- Style switcher --> 
		<script type="text/javascript" src="<?php echo @TPL_URL; ?>
js/stylesheetToggle.js"></script>
		
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo @TPL_URL; ?>
css/reset.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo @TPL_URL; ?>
css/blue.css" />
		
		
		<!-- comment extra.css for css validation -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo @TPL_URL; ?>
css/extra.css" />
		
		<link rel="alternate stylesheet" title="red" type="text/css" media="all" href="<?php echo @TPL_URL; ?>
css/red.css" />
		<link rel="alternate stylesheet" title="green" type="text/css" media="all" href="<?php echo @TPL_URL; ?>
css/green.css" />
		<link rel="alternate stylesheet" title="brown" type="text/css" media="all" href="<?php echo @TPL_URL; ?>
css/brown.css" />
		<!-- JQ UI -->
		<link type="text/css" href="<?php echo @TPL_URL; ?>
css/ui-lightness/jquery-ui-1.8.1.custom.css" rel="stylesheet" />	
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo @TPL_URL; ?>
favicon.ico">
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['lang']['aiondatabase']; ?>
/js/exsyndication.js"></script>
		<!-- See Interface Configuration --> 
		<script type="text/javascript" src="<?php echo @TPL_URL; ?>
js/seeui.js"></script>
		
		<!--[if IE 6]>
			<script type="text/javascript" src="<?php echo @TPL_URL; ?>
js/ddbelatedpng.js"></script>
			<script type="text/javascript">	
				DD_belatedPNG.fix('img, .info a');
			</script>
		<![endif]-->
	</head>
		
	<body onload="$('#loader').fadeOut()">
	<div id='loader'><img src='<?php echo @TPL_URL; ?>
i/wait.gif' alt='wait'></div>
		<div id="bk">
		
		 <!-- Header  --> 
		<div id="pannelDash" class="clearfix">
			
			 <!-- Tabs--> 
			<div class="menu">
				<ul>
					<li class="selected">
						<a href="#" onclick="showOnly('tabDashboard','dashWidget')"><img src="<?php echo @TPL_URL; ?>
img/icons/home.png" alt="Dashboard" /><?php echo $this->_tpl_vars['lang']['dashboard']; ?>
</a>
					</li>
					<li>
						<a href="#" onclick="showOnly('tabSettings','dashWidget')"><?php echo $this->_tpl_vars['lang']['settings']; ?>
</a>
					</li>
					<li>
						<a href="#" onclick="showOnly('tabAccount','dashWidget')"><?php echo $this->_tpl_vars['lang']['profile']; ?>
</a>
					</li>
				</ul>
				<div class="info">
					<div><a href="?action=logout" class="icOff"><?php echo $this->_tpl_vars['lang']['menu_exit']; ?>
</a></div>
					<div class="user">
						<img width="27" height="27" src="<?php echo @TPL_URL; ?>
img/user_icon.png" alt="<?php echo $_SESSION['login']; ?>
" />
						<span><?php echo $_SESSION['login']; ?>
</span>
						<br />
						<span class="detail"><?php echo $_SERVER['REMOTE_ADDR']; ?>
</span>
					</div>
				</div>
				
				<div class="theme">
					<a href="#" class="styleswitch red" rel="red">&nbsp;</a>
					<a href="#" class="styleswitch green" rel="green">&nbsp;</a>
					<a href="#" class="styleswitch brown" rel="brown">&nbsp;</a>
					<a href="#" class="styleswitch blue" rel="blue">&nbsp;</a>
					<span> <?php echo $this->_tpl_vars['lang']['themes']; ?>
 </span>
				</div>
			</div>
			
			 <!-- Dashboard fast menu (6 items)  --> 
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu/dashboard.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			
			 <!-- Large left widget --> 
			<div class="widget dashWidget">
				<div class="content tabContent">
					<div class="tabDashboard"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu/mainboard.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
					<div class="tabSettings" style="overflow:auto">
					<form method="post" action="?action=config">
						<div class="fields">
							<p class="sep">
								<label class="small"><?php echo $this->_tpl_vars['lang']['atitle']; ?>
</label>
								<input type="text" value="<?php echo @TITLE; ?>
" class="sText" name='title'/>
							</p>	
							<p class="sep">
								<label class="small"><?php echo $this->_tpl_vars['lang']['default_lang']; ?>
</label>
								<select class="sSelect" name='lang'>
                                    <?php $_from = $this->_tpl_vars['lang_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['l']):
?>
									<option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (@DEFAULT_LANG == $this->_tpl_vars['key']): ?>selected<?php endif; ?> title="<?php echo $this->_tpl_vars['l']['lang']; ?>
"><?php echo $this->_tpl_vars['l']['lang']; ?>
</option>
									<?php endforeach; endif; unset($_from); ?>
								</select>
							</p>
							<p class="sep">
								<label class="small"><?php echo $this->_tpl_vars['lang']['acl']; ?>
</label>
								<input type="text" value="<?php echo @ALLOW_ACL; ?>
" class="sText" name='acl'/>
							</p>
							<div class="fields">
								<p> <input class="sCheck" type="checkbox" name="effect" value="on" 
								<?php if (@JS_EFFECT == TRUE): ?>checked<?php endif; ?>/><label><?php echo $this->_tpl_vars['lang']['effects']; ?>
</label> </p>
								<p> <input class="sCheck" type="checkbox" name="debug" value="on"
								<?php if (@DEBUG == TRUE): ?>checked<?php endif; ?>/><label>Debug</label> </p>
							</div>	
							<input type="submit" class="butDef" value="<?php echo $this->_tpl_vars['lang']['save']; ?>
" />
						</div>
						</form>
					</div>
				<div class="tabAccount">
                    <?php $_from = $this->_tpl_vars['lang_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['l']):
?>
                      <a href='?lang=<?php echo $this->_tpl_vars['key']; ?>
'><img src="<?php echo @TPL_URL; ?>
<?php echo $this->_tpl_vars['l']['icon']; ?>
" title="<?php echo $this->_tpl_vars['l']['lang']; ?>
" class="lang_icon boxshadow"></a> &nbsp;
                    <?php endforeach; endif; unset($_from); ?>
				</div>
				</div>
			</div>
		</div>
		
		<?php if ($this->_tpl_vars['speedbar'] !== ''): ?>
		 <!-- Tooltip zone --> 
		<div class="toolTip tpYellow" >
			<p class="clearfix">
				<img src="<?php echo @TPL_URL; ?>
img/icons/light-bulb-off.png" alt="Tip!" />
				<?php echo $this->_tpl_vars['speedbar']; ?>

			</p>
			
			<a class="close" title="Close"></a>
		</div>
		<?php endif; ?>
		
		<div id="container" class="clearfix">
			 <!-- Left Menu --> 
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu/leftmenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			
			<div id="page">
				<div class="menu clearfix">
					 <!-- Page Dropdown  Menu --> 
					<ul id="pgmenu">
                        <?php if ($this->_tpl_vars['bookmarks'] != ''): ?>
						<li><a href="#" class="sub"><?php echo $this->_tpl_vars['lang']['bookmarks']; ?>
<span>&nbsp;</span></a>
							<ul>
								<?php echo $this->_tpl_vars['bookmarks']; ?>

							</ul>
						</li>
						<?php endif; ?>
						
						<?php if (isset ( $_GET['char_id'] ) || isset ( $_GET['action'] ) && $_GET['action'] == 'construct'): ?>
						<li><a href="#" class="sub"><?php echo $this->_tpl_vars['lang']['action']; ?>
<span>&nbsp;</span></a>
							<ul>
							<?php if (isset ( $_GET['char_id'] )): ?>
								<li><a href="?action=char&char_id=<?php echo $_GET['char_id']; ?>
"><?php echo $this->_tpl_vars['lang']['info']; ?>
</a></li>
								<li><a href="?action=items&char_id=<?php echo $_GET['char_id']; ?>
"><?php echo $this->_tpl_vars['lang']['inven']; ?>
</a></li>
								<li><a href="?action=chardata&char_id=<?php echo $_GET['char_id']; ?>
"><?php echo $this->_tpl_vars['lang']['char_data']; ?>
</a></li>
                                <li><a href="?action=friends&char_id=<?php echo $_GET['char_id']; ?>
"><?php echo $this->_tpl_vars['lang']['friends']; ?>
</a></li>
                                <li><a href="?action=mails&char_id=<?php echo $_GET['char_id']; ?>
"><?php echo $this->_tpl_vars['lang']['mail']; ?>
</a></li>
                                 <li><a href="?action=skills&char_id=<?php echo $_GET['char_id']; ?>
">Скиллы</a></li>
                                <!--<li><a href="?action=delchar&char_id=<?php echo $_GET['char_id']; ?>
">Удалить персонажа</a></li>-->
							<?php endif; ?>
                            <?php if (isset ( $_GET['action'] ) && $_GET['action'] == 'construct'): ?>
                                <li><a href="?action=construct&show=create"><?php echo $this->_tpl_vars['lang']['constr_query']; ?>
</a></li>
                                <li><a href="?action=construct&show=list"><?php echo $this->_tpl_vars['lang']['query_list']; ?>
</a></li>
                                <li><a href="http://wiki.fdcore.ru/aioncp:price" target='_blank'><?php echo $this->_tpl_vars['lang']['buyq']; ?>
</a></li>
                            <?php endif; ?>
							</ul>
						</li>
						<?php endif; ?>
						<?php if (isset ( $_GET['action'] ) && $_GET['action'] == 'info'): ?>
						<?php if (isset ( $this->_tpl_vars['char_list'] ) && $this->_tpl_vars['char_list'] != FALSE): ?> 
								<li><a href="#" class="sub"><?php echo $this->_tpl_vars['lang']['chars']; ?>
<span>&nbsp;</span></a>
								<ul>
								<?php $_from = $this->_tpl_vars['char_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['char']):
?>
	 								<li><a href="?action=char&char_id=<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['char']; ?>
</a></li>
	 							<?php endforeach; endif; unset($_from); ?>
	 							</ul>
							<?php endif; ?></li>
						<?php endif; ?>
						<li><a href="#" class="sub">Help<span>&nbsp;</span></a>
							<ul>
								<li><a href="http://wiki.fdcore.ru/aioncp:main" title='Only Russian' target='_blank'><?php echo $this->_tpl_vars['lang']['help']; ?>
</a></li>
								<li><a href="http://gameacp.ru/aioncp" target='_blank'>Официальный сайт</a></li>
							</ul>
							</li>
					</ul>
					
					 <!-- Page title --> 
					<div><?php echo $this->_tpl_vars['title']; ?>
</div>
					<div class="cr_pass"></div>
				</div>
				
				<div class="clearfix content">
					 <!-- Page content --> 
				
<div class="clearfix">
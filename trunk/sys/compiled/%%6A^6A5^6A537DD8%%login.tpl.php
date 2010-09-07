<?php /* Smarty version 2.6.26, created on 2010-08-18 22:19:42
         compiled from login.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" > 
	<head>
		<title><?php echo @TITLE; ?>
 &rarr; <?php echo $this->_tpl_vars['lang']['authorize']; ?>
</title>
		<meta name="description"		content="Premium Aion Control Panel" />
		<meta name="keywords"  			content="" />
		<meta name="copyright" 			content="FDCore Studio (http://fdcore.ru)" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		 <!-- Jquery directly from google servers--> 
		<script type="text/javascript" src="<?php echo @TPL_URL; ?>
js/jquery.js" ></script>
		<!-- Login javscript--> 
		<script type="text/javascript" src="<?php echo @TPL_URL; ?>
js/loginui.js"></script> 
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo @TPL_URL; ?>
css/reset.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo @TPL_URL; ?>
css/login.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo @TPL_URL; ?>
css/blue.css" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo @TPL_URL; ?>
favicon.ico">
		<!-- comment extra.css for css validation -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo @TPL_URL; ?>
css/extra.css" />
	</head>
		
	<body>
		<div class="boxLogin clearfix">
			 <!-- Tooltip styles  --> 
			 <?php if (( isset ( $this->_tpl_vars['error'] ) && $this->_tpl_vars['error'] !== '' )): ?>
			<div class="toolTip tpRed clearfix" >
				<p>
					<img src="<?php echo @TPL_URL; ?>
img/icons/exclamation-red.png" alt="Tip!" />
					<?php echo $this->_tpl_vars['error']; ?>

				</p>
				
				<a class="close" title="Close"></a>
			</div>
			<?php endif; ?>
			<div class="ajax_div">
			<div class="toolTip tpRed clearfix ajax_msg">
				<p>
					<img src="<?php echo @TPL_URL; ?>
img/icons/exclamation-red.png" alt="Tip!" />
					<span></span>
				</p>
				
				<a class="close" title="Close"></a>
			</div>
			</div>
			<form method="post">
			<div class="fields">
				<p class="sep<?php if (( isset ( $this->_tpl_vars['error'] ) && $this->_tpl_vars['error'] !== '' )): ?> error<?php endif; ?>">
					<label class="small" for="user01"><?php echo $this->_tpl_vars['lang']['login']; ?>
</label>
					<input type="text" value="<?php if (isset ( $_POST['login'] )): ?><?php echo $_POST['login']; ?>
<?php endif; ?>" name='login' class="sText" id="login"/>
				</p>
				
				<p class="sep<?php if (( isset ( $this->_tpl_vars['error'] ) && $this->_tpl_vars['error'] !== '' )): ?> error<?php endif; ?>">
					<label class="small" for="pass01"><?php echo $this->_tpl_vars['lang']['password']; ?>
</label>
					<input type="password" value="<?php if (isset ( $_POST['password'] )): ?><?php echo $_POST['password']; ?>
<?php endif; ?>" name='password' class="sText" id="password"/>
				</p>
				
				<div class="action">
					<img src='<?php echo @TPL_URL; ?>
i/pie.gif' alt='wait' class="wait">  <input type="submit" class="butDef loginajax" value="<?php echo $this->_tpl_vars['lang']['enter']; ?>
" />
				</div>
			</div>
			</form>
		</div><div style="font-size:10px; position:fixed; bottom:0px; left:0px;"><a href="http://fdcore.ru" target="_blank" title='Touch me ;)'><img src='<?php echo @TPL_URL; ?>
i/F.png' alt='FDCore Studio'></a>

<?php $_from = $this->_tpl_vars['lang_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['l']):
?>
  <a href='?lang=<?php echo $this->_tpl_vars['key']; ?>
'><img src="<?php echo @TPL_URL; ?>
<?php echo $this->_tpl_vars['l']['icon']; ?>
" title="<?php echo $this->_tpl_vars['l']['lang']; ?>
" class="lang_icon"></a> &nbsp;
<?php endforeach; endif; unset($_from); ?></div>
<script>

</script>
<!-- Copyright FDcore Studio | Powered by FDcore Studio -->
	</body>

</html>
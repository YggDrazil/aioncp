<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" > 
	<head>
		<title>{$smarty.const.TITLE} &rarr; {$lang.authorize}</title>
		<meta name="description"		content="Premium Aion Control Panel" />
		<meta name="keywords"  			content="" />
		<meta name="copyright" 			content="FDCore Studio (http://fdcore.ru)" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		 <!-- Jquery directly from google servers--> 
		<script type="text/javascript" src="{$smarty.const.TPL_URL}js/jquery.js" ></script>
		<!-- Login javscript--> 
		<script type="text/javascript" src="{$smarty.const.TPL_URL}js/loginui.js"></script> 
		<link rel="stylesheet" type="text/css" media="all" href="{$smarty.const.TPL_URL}css/reset.css" />
		<link rel="stylesheet" type="text/css" media="all" href="{$smarty.const.TPL_URL}css/login.css" />
		<link rel="stylesheet" type="text/css" media="all" href="{$smarty.const.TPL_URL}css/blue.css" />
		<link rel="shortcut icon" type="image/x-icon" href="{$smarty.const.TPL_URL}favicon.ico">
		<!-- comment extra.css for css validation -->
		<link rel="stylesheet" type="text/css" media="all" href="{$smarty.const.TPL_URL}css/extra.css" />
	</head>
		
	<body>
		<div class="boxLogin clearfix">
			 <!-- Tooltip styles  --> 
			 {if (isset($error) && $error !== '')}
			<div class="toolTip tpRed clearfix" >
				<p>
					<img src="{$smarty.const.TPL_URL}img/icons/exclamation-red.png" alt="Tip!" />
					{$error}
				</p>
				
				<a class="close" title="Close"></a>
			</div>
			{/if}
			<div class="ajax_div">
			<div class="toolTip tpRed clearfix ajax_msg">
				<p>
					<img src="{$smarty.const.TPL_URL}img/icons/exclamation-red.png" alt="Tip!" />
					<span></span>
				</p>
				
				<a class="close" title="Close"></a>
			</div>
			</div>
			<form method="post">
			<div class="fields">
				<p class="sep{if (isset($error) && $error !== '')} error{/if}">
					<label class="small" for="user01">{$lang.login}</label>
					<input type="text" value="{if isset($smarty.post.login)}{$smarty.post.login}{/if}" name='login' autofocus autocomplete="off" class="sText" id="login"/>
				</p>
				
				<p class="sep{if (isset($error) && $error !== '')} error{/if}">
					<label class="small" for="pass01">{$lang.password}</label>
					<input type="password" value="{if isset($smarty.post.password)}{$smarty.post.password}{/if}" name='password' class="sText" id="password"/>
				</p>
				
				<div class="action">
					<img src='{$smarty.const.TPL_URL}i/pie.gif' alt='wait' class="wait">  <input type="submit" class="butDef loginajax" value="{$lang.enter}" />
				</div>
			</div>
			</form>
		</div><div style="font-size:10px; position:fixed; bottom:0px; left:0px;"><a href="http://fdcore.ru" target="_blank" title='Touch me ;)'><img src='{$smarty.const.TPL_URL}i/F.png' alt='FDCore Studio'></a>

{foreach key=key item=l from=$lang_list}
  <a href='?lang={$key}'><img src="{$smarty.const.TPL_URL}{$l.icon}" title="{$l.lang}" class="lang_icon"></a> &nbsp;
{/foreach}</div>
<script>

</script>
<!-- Copyright FDcore Studio | Powered by FDcore Studio -->
	</body>

</html>
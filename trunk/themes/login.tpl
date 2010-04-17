<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" > 
	<head>
		<title>AionCP {$lang.authorize}</title>
		<meta name="description"		content="Premium Aion Control Panel" />
		<meta name="keywords"  			content="" />
		<meta name="copyright" 			content="FDCore Studio (http://fdcore.ru)" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		 <!-- Jquery directly from google servers--> 
		<script type="text/javascript" src="themes/js/jquery.js" ></script>
		
		<!-- Login javscript--> 
		<script type="text/javascript" src="themes/js/loginui.js"></script> 
		
		<link rel="stylesheet" type="text/css" media="all" href="themes/css/reset.css" />
		<link rel="stylesheet" type="text/css" media="all" href="themes/css/login.css" />
		<link rel="stylesheet" type="text/css" media="all" href="themes/css/blue.css" />
		
		<!-- comment extra.css for css validation -->
		<link rel="stylesheet" type="text/css" media="all" href="themes/css/extra.css" />
	</head>
		
	<body>
		<div class="boxLogin clearfix">
			 <!-- Tooltip styles  --> 
			 {if (isset($error) && $error!=='') }
			<div class="toolTip tpRed clearfix" >
				<p>
					<img src="themes/img/icons/exclamation-red.png" alt="Tip!" />
					{$error}
				</p>
				
				<a class="close" title="Close"></a>
			</div>
			{/if}
			<form method="post">
			<div class="fields">
				<p class="sep{if (isset($error) && $error!=='') } error{/if}">
					<label class="small" for="user01">{$lang.login}</label>
					<input type="text" value="{if isset($quicky.post.login)}{$quicky.post.login}{/if}" name='login' class="sText" id="user01"/>
				</p>
				
				<p class="sep{if (isset($error) && $error!=='') } error{/if}">
					<label class="small" for="pass01">{$lang.password}</label>
					<input type="password" value="{if isset($quicky.post.password)}{$quicky.post.password}{/if}" name='password' class="sText" id="pass01"/>
				</p>
				
				<div class="action">
					<input type="submit" class="butDef" value="{$lang.enter}" />
				</div>
			</div>
			</form>
		</div><div style="font-size:10px; position:fixed; bottom:0px; left:0px;"><a href="http://lab.fdcore.ru" target="_blank" title='Touch me ;)'><img src='themes/i/F.png' alt='FDCore Studio'></a>
		<a href="http://fdcore.ru/donate" targer="_blank" title="Сделать Добравольное пожертвование"><img src="themes/i/donate.png"></a>
		<a href='?lang=ru'><img src="themes/i/russian.png"></a>
		<a href='?lang=en'><img src="themes/i/english.png"></a></div>
<!-- Copyright FDcore Studio | Powered by FDcore Labs -->
	</body>

</html>

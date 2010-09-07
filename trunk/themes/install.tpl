{*
/* ------------------------------------------------------------------------

 * Free Control Panel for Aoin
 *
 * @version 1.0
 * @author NetSoul ( FDCore main Developer )
 * @link http://www.fdcore.ru
 *
 * http://code.google.com/p/aioncp/
 *
 * @license http://fdcore.ru/license.html

------------------------------------------------------------------------ */
*}<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" > 
	<head>
		<title>AionCP Installer</title>
		<meta name="description"		content="Aion Control Panel" />
		<meta name="keywords"  			content="" />
		<meta name="copyright" 			content="FDCore Studio (http://fdcore.ru)" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		 <!-- Jquery directly from google servers--> 
		<script type="text/javascript" src="{$smarty.const.TPL_URL}js/jquery.js" ></script>
		<script type="text/javascript" src="{$smarty.const.TPL_URL}js/ui.js" ></script>
		
		<!-- Login javscript--> 
		<script type="text/javascript" src="{$smarty.const.TPL_URL}js/loginui.js"></script> 
		
		<link rel="stylesheet" type="text/css" media="all" href="{$smarty.const.TPL_URL}css/reset.css" />
		<link rel="stylesheet" type="text/css" media="all" href="{$smarty.const.TPL_URL}css/login.css" />
		<link rel="stylesheet" type="text/css" media="all" href="{$smarty.const.TPL_URL}css/blue.css" />
		<link type="text/css" href="{$smarty.const.TPL_URL}css/ui-lightness/jquery-ui-1.8.1.custom.css" rel="stylesheet" />	
		<!-- comment extra.css for css validation -->
		<link rel="stylesheet" type="text/css" media="all" href="{$smarty.const.TPL_URL}css/extra.css" />
        {literal}
        <script>
        $(document).ready(function() {
        	$('#add').click(function(){
        		$('#connection').fadeOut('fast',function(){
                  $('#addon').fadeIn('fast');
                });
        		return false;
        	});
        	$('#conn').click(function(){
        		$('#addon').fadeOut('fast',function(){
                    $('#connection').fadeIn('fast');
                });
        	});
        });
        </script>
		
		<style>
			.area{width: 99%}
            .butDef{cursor:pointer;}
            #license{display:none; }
		</style>
		{/literal}
	</head>
		
	<body>
		<div class="boxLogin clearfix">
			 <!-- Tooltip styles  --> 
			 {if isset($error)}
			 {foreach item=err from=$error}
			<div class="toolTip tpRed clearfix" >
				<p>
					<img src="{$smarty.const.TPL_URL}img/icons/exclamation-red.png" alt="Tip!" />
					{$err}
				</p>
				
				<a class="close" title="Close"></a>
			</div>
			{/foreach}
			{/if}
			{if $smarty.get.lic=='yes' && $mcrypt==TRUE}
			<div class="toolTip tpBlue clearfix" > 
				<p> 
					<img src="{$smarty.const.TPL_URL}img/icons/light-bulb-off.png" alt="Tip!" /> 
					{$lang.install_notice_mcr}
				</p> 
				
				<a class="close" title="Close"></a> 
			</div> 
			{/if}
			<form method="post">
            
			<div class="fields" style="height:300px;-moz-border-radius: 5px; overflow: auto; -webkit-border-radius: 5px; position:relative; left:-10px">
            
			{if $step==1}
				{include file="install/step1.tpl"}
			{/if}
			
			{if $step==2}
				{include file="install/step2.tpl"}
	
			{/if}
	
			{if $step==3}
           		{include file="install/step3.tpl"}
			{/if}
			
		</form>
		</div><div style="font-size:10px; position:fixed; bottom:0px; left:0px;"><a href="http://lab.fdcore.ru" target="_blank" title='Touch me ;)'><img src='{$smarty.const.TPL_URL}i/F.png' alt='FDCore Studio'></a>
		<a href="http://fdcore.ru/donate" targer="_blank" title="Donate Please"><img src="{$smarty.const.TPL_URL}i/donate.png"></a></div>
<!-- Copyright FDcore Studio | Powered by FDcore Studio -->
	</body>

</html>

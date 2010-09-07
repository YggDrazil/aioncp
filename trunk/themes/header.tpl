{*
/* ------------------------------------------------------------------------

 * Aion Control Panel [Professional Version]
 *
 * @version 1.1
 * @author NetSoul (FDCore main Developer)
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
		<title>{if isset($title) && $title!==''}{$smarty.const.TITLE} &rarr; {$title}{else}{$smarty.const.TITLE}{/if}</title>
		<meta name="description"		content="Free AionCP for Aion Unique" />
		<meta name="keywords"  			content="Aion CP" />
		<meta name="copyright" 			content="FDCore Studio (www.fdcore.ru)" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		 <!-- Jquery directly from google servers--> 
		<script type="text/javascript" src="{$smarty.const.TPL_URL}js/jquery.js" ></script>
		<script type="text/javascript" src="{$smarty.const.TPL_URL}js/ui.js" ></script>
		 <!-- Javascript for client side table sort--> 
		<script type="text/javascript" src="{$smarty.const.TPL_URL}js/tinytable.js"></script>
		
		 <!-- WYSIWYG Editor --> 
		<script type="text/javascript" src="{$smarty.const.TPL_URL}js/jquery.wysiwyg.js"></script> 
		
		 <!-- Style switcher --> 
		<script type="text/javascript" src="{$smarty.const.TPL_URL}js/stylesheetToggle.js"></script>
		
		<link rel="stylesheet" type="text/css" media="all" href="{$smarty.const.TPL_URL}css/reset.css" />
		<link rel="stylesheet" type="text/css" media="all" href="{$smarty.const.TPL_URL}css/blue.css" />
		
		
		<!-- comment extra.css for css validation -->
		<link rel="stylesheet" type="text/css" media="all" href="{$smarty.const.TPL_URL}css/extra.css" />
		
		<link rel="alternate stylesheet" title="red" type="text/css" media="all" href="{$smarty.const.TPL_URL}css/red.css" />
		<link rel="alternate stylesheet" title="green" type="text/css" media="all" href="{$smarty.const.TPL_URL}css/green.css" />
		<link rel="alternate stylesheet" title="brown" type="text/css" media="all" href="{$smarty.const.TPL_URL}css/brown.css" />
		<!-- JQ UI -->
		<link type="text/css" href="{$smarty.const.TPL_URL}css/ui-lightness/jquery-ui-1.8.1.custom.css" rel="stylesheet" />	
        <link rel="shortcut icon" type="image/x-icon" href="{$smarty.const.TPL_URL}favicon.ico">
		<script type="text/javascript" src="{$lang.aiondatabase}/js/exsyndication.js"></script>
		<!-- See Interface Configuration --> 
		<script type="text/javascript" src="{$smarty.const.TPL_URL}js/seeui.js"></script>
		
		<!--[if IE 6]>
			<script type="text/javascript" src="{$smarty.const.TPL_URL}js/ddbelatedpng.js"></script>
			<script type="text/javascript">	
				DD_belatedPNG.fix('img, .info a');
			</script>
		<![endif]-->
	</head>
		
	<body onload="$('#loader').fadeOut()">
	<div id='loader'><img src='{$smarty.const.TPL_URL}i/wait.gif' alt='wait'></div>
		<div id="bk">
		
		 <!-- Header  --> 
		<div id="pannelDash" class="clearfix">
			
			 <!-- Tabs--> 
			<div class="menu">
				<ul>
					<li class="selected">
						<a href="#" onclick="showOnly('tabDashboard','dashWidget')"><img src="{$smarty.const.TPL_URL}img/icons/home.png" alt="Dashboard" />{$lang.dashboard}</a>
					</li>
					<li>
						<a href="#" onclick="showOnly('tabSettings','dashWidget')">{$lang.settings}</a>
					</li>
					<li>
						<a href="#" onclick="showOnly('tabAccount','dashWidget')">{$lang.profile}</a>
					</li>
				</ul>
				<div class="info">
					<div><a href="?action=logout" class="icOff">{$lang.menu_exit}</a></div>
					<div class="user">
						<img width="27" height="27" src="{$smarty.const.TPL_URL}img/user_icon.png" alt="{$smarty.session.login}" />
						<span>{$smarty.session.login}</span>
						<br />
						<span class="detail">{$smarty.server.REMOTE_ADDR}</span>
					</div>
				</div>
				
				<div class="theme">
					<a href="#" class="styleswitch red" rel="red">&nbsp;</a>
					<a href="#" class="styleswitch green" rel="green">&nbsp;</a>
					<a href="#" class="styleswitch brown" rel="brown">&nbsp;</a>
					<a href="#" class="styleswitch blue" rel="blue">&nbsp;</a>
					<span> {$lang.themes} </span>
				</div>
			</div>
			
			 <!-- Dashboard fast menu (6 items)  --> 
			{include file="menu/dashboard.tpl"}
			
			 <!-- Large left widget --> 
			<div class="widget dashWidget">
				<div class="content tabContent">
					<div class="tabDashboard">{include file="menu/mainboard.tpl"}</div>
					<div class="tabSettings" style="overflow:auto">
					<form method="post" action="?action=config">
						<div class="fields">
							<p class="sep">
								<label class="small">{$lang.atitle}</label>
								<input type="text" value="{$smarty.const.TITLE}" class="sText" name='title'/>
							</p>	
							<p class="sep">
								<label class="small">{$lang.default_lang}</label>
								<select class="sSelect" name='lang'>
                                    {foreach key=key item=l from=$lang_list}
									<option value="{$key}" {if $smarty.const.DEFAULT_LANG == $key}selected{/if} title="{$l.lang}">{$l.lang}</option>
									{/foreach}
								</select>
							</p>
							<p class="sep">
								<label class="small">{$lang.acl}</label>
								<input type="text" value="{$smarty.const.ALLOW_ACL}" class="sText" name='acl'/>
							</p>
							<div class="fields">
								<p> <input class="sCheck" type="checkbox" name="effect" value="on" 
								{if $smarty.const.JS_EFFECT == TRUE}checked{/if}/><label>{$lang.effects}</label> </p>
								<p> <input class="sCheck" type="checkbox" name="debug" value="on"
								{if $smarty.const.DEBUG == TRUE}checked{/if}/><label>Debug</label> </p>
							</div>	
							<input type="submit" class="butDef" value="{$lang.save}" />
						</div>
						</form>
					</div>
				<div class="tabAccount">
                    {foreach key=key item=l from=$lang_list}
                      <a href='?lang={$key}'><img src="{$smarty.const.TPL_URL}{$l.icon}" title="{$l.lang}" class="lang_icon boxshadow"></a> &nbsp;
                    {/foreach}
				</div>
				</div>
			</div>
		</div>
		
		{if $speedbar!==''}
		 <!-- Tooltip zone --> 
		<div class="toolTip tpYellow" >
			<p class="clearfix">
				<img src="{$smarty.const.TPL_URL}img/icons/light-bulb-off.png" alt="Tip!" />
				{$speedbar}
			</p>
			
			<a class="close" title="Close"></a>
		</div>
		{/if}
		
		<div id="container" class="clearfix">
			 <!-- Left Menu --> 
			{include file="menu/leftmenu.tpl"}
			
			<div id="page">
				<div class="menu clearfix">
					 <!-- Page Dropdown  Menu --> 
					<ul id="pgmenu">
                        {if $bookmarks !=''}
						<li><a href="#" class="sub">{$lang.bookmarks}<span>&nbsp;</span></a>
							<ul>
								{$bookmarks}
							</ul>
						</li>
						{/if}
						
						{if isset($smarty.get.char_id) or isset($smarty.get.action) && $smarty.get.action=='construct'}
						<li><a href="#" class="sub">{$lang.action}<span>&nbsp;</span></a>
							<ul>
							{if isset($smarty.get.char_id)}
								<li><a href="?action=char&char_id={$smarty.get.char_id}">{$lang.info}</a></li>
								<li><a href="?action=items&char_id={$smarty.get.char_id}">{$lang.inven}</a></li>
								<li><a href="?action=chardata&char_id={$smarty.get.char_id}">{$lang.char_data}</a></li>
                                <li><a href="?action=friends&char_id={$smarty.get.char_id}">{$lang.friends}</a></li>
                                <li><a href="?action=mails&char_id={$smarty.get.char_id}">{$lang.mail}</a></li>
                                 <li><a href="?action=skills&char_id={$smarty.get.char_id}">Скиллы</a></li>
                                <!--<li><a href="?action=delchar&char_id={$smarty.get.char_id}">Удалить персонажа</a></li>-->
							{/if}
                            {if isset($smarty.get.action) && $smarty.get.action=='construct'}
                                <li><a href="?action=construct&show=create">{$lang.constr_query}</a></li>
                                <li><a href="?action=construct&show=list">{$lang.query_list}</a></li>
                                <li><a href="http://wiki.fdcore.ru/aioncp:price" target='_blank'>{$lang.buyq}</a></li>
                            {/if}
							</ul>
						</li>
						{/if}
						{if isset($smarty.get.action) && $smarty.get.action=='info'}
						{if isset($char_list) && $char_list!=FALSE} 
								<li><a href="#" class="sub">{$lang.chars}<span>&nbsp;</span></a>
								<ul>
								{foreach key=key item=char from=$char_list}
	 								<li><a href="?action=char&char_id={$key}">{$char}</a></li>
	 							{/foreach}
	 							</ul>
							{/if}</li>
						{/if}
						<li><a href="#" class="sub">Help<span>&nbsp;</span></a>
							<ul>
								<li><a href="http://wiki.fdcore.ru/aioncp:main" title='Only Russian' target='_blank'>{$lang.help}</a></li>
								<li><a href="http://gameacp.ru/aioncp" target='_blank'>Официальный сайт</a></li>
							</ul>
							</li>
					</ul>
					
					 <!-- Page title --> 
					<div>{$title}</div>
					<div class="cr_pass"></div>
				</div>
				
				<div class="clearfix content">
					 <!-- Page content --> 
				
<div class="clearfix">
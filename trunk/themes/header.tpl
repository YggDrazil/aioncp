<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" > 
	<head>
		<title>{if isset($title) && $title!==''}{$title}AionCP 1.0{else}{/if}</title>
		<meta name="description"		content="" />
		<meta name="keywords"  			content="" />
		<meta name="copyright" 			content="" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		 <!-- Jquery directly from google servers--> 
		<script type="text/javascript" src="themes/js/jquery.js" ></script>
		<script type="text/javascript" src="themes/js/ui.js" ></script>
		 <!-- Javascript for client side table sort--> 
		<script type="text/javascript" src="themes/js/tinytable.js"></script>
		
		 <!-- WYSIWYG Editor --> 
		<script type="text/javascript" src="themes/js/jquery.wysiwyg.js"></script> 
		
		 <!-- Style switcher --> 
		<script type="text/javascript" src="themes/js/stylesheetToggle.js"></script>
		
		<link rel="stylesheet" type="text/css" media="all" href="themes/css/reset.css" />
		<link rel="stylesheet" type="text/css" media="all" href="themes/css/blue.css" />
		
		<!-- comment extra.css for css validation -->
		<link rel="stylesheet" type="text/css" media="all" href="themes/css/extra.css" />
		
		<link rel="alternate stylesheet" title="red" type="text/css" media="all" href="themes/css/red.css" />
		<link rel="alternate stylesheet" title="green" type="text/css" media="all" href="themes/css/green.css" />
		<link rel="alternate stylesheet" title="brown" type="text/css" media="all" href="themes/css/brown.css" />
		<script type="text/javascript" src="http://{if $quicky.session.lang =='en'}www{else}ru{/if}.aiondatabase.com/js/exsyndication.js"></script>
		<!-- See Interface Configuration --> 
		<script type="text/javascript" src="themes/js/seeui.js"></script>
		
		<!--[if IE 6]>
			<script type="text/javascript" src="themes/js/ddbelatedpng.js"></script>
			<script type="text/javascript">	
				DD_belatedPNG.fix('img, .info a');
			</script>
		<![endif]-->
	</head>
		
	<body onload="$('#loader').fadeOut()">
	<div id='loader'><img src='themes/i/wait.gif' alt='wait'></div>
		<div id="bk">
		
		 <!-- Header  --> 
		<div id="pannelDash" class="clearfix">
			
			 <!-- Tabs--> 
			<div class="menu">
				<ul>
					<li class="selected">
						<a href="#" onclick="showOnly('tabDashboard','dashWidget')"><img src="themes/img/icons/home.png" alt="Dashboard" />{$lang.dashboard}</a>
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
						<img width="27" height="27" src="themes/img/user_icon.png" alt="User name" />
						<span>{$quicky.session.login}</span>
						<span class="detail"></span>
					</div>
				</div>
				
				<div class="theme">
					<a href="#" class="styleswitch red" rel="red">&nbsp;</a>
					<a href="#" class="styleswitch green" rel="green">&nbsp;</a>
					<a href="#" class="styleswitch brown" rel="brown">&nbsp;</a>
					<a href="#" class="styleswitch blue" rel="blue">&nbsp;</a>
					<span> Тема </span>
				</div>
			</div>
			
			 <!-- Dashboard fast menu (6 items)  --> 
			<div class="dashboard">
				<ul>
					<li>
						<a href="?action=accounts">
							<img src="themes/i/kontact_contacts.png" alt="{$lang.menu_acclist}" />
							{$lang.menu_acclist}
						</a>
					</li>
					<li>
						<a href="backup/">
							<img src="themes/i/backup.png" />
							{$lang.backup}
						</a>
					</li>
					<li>
						<a href="?action=construct">
							<img src="themes/i/constructor.png" />
							{$lang.construct}
						</a>
					</li>
					<li>
						<a href="?action=search">
							<img src="themes/i/edit_find.png" alt="{$lang.menu_search}" />
							{$lang.menu_search}
						</a>
					</li>
					<li>
						<a href="?action=statistic">
							<img src="themes/i/help_about.png" alt="Recent comments!" />
							{$lang.menu_stat}
						</a>
					</li>
					<li>
						<a href="index.php?action=favarites">
							<img src="themes/i/dashbookm.png" alt="My Bookmarks!" />
							{$lang.bookmarks}
						</a>
					</li>
				</ul>
			</div>
			
			 <!-- Large left widget --> 
			<div class="widget dashWidget">
				<div class="content tabContent">
					<div class="tabDashboard" id="AjaxPlace">&nbsp;</div>
					<div class="tabSettings" style="overflow:auto">
					<form method="post" action="?action=config">
						<div class="fields">
							<p class="sep">
								<label class="small">Имя скрипта</label>
								<input type="text" value="{$quicky.const.TITLE}" class="sText" name='title'/>
							</p>	
							<p class="sep">
								<label class="small">Стандартный язык</label>
								<select class="sSelect" name='lang'>
									<option value="ru" {if $quicky.const.DEFAULT_LANG =="ru"}selected{/if}>Russian</option>
									<option value="en" {if $quicky.const.DEFAULT_LANG =="en"}selected{/if}>English</option>
								</select>
							</p>
							<p class="sep">
								<label class="small">Уровень доступа для входа</label>
								<input type="text" value="{$quicky.const.ALLOW_ACL}" class="sText" name='acl'/>
							</p>
							<div class="fields">
								<p> <input class="sCheck" type="checkbox" name="effect" value="on" 
								{if $quicky.const.JS_EFFECT == TRUE}checked{/if}/><label>Эффекты</label> </p>
								<p> <input class="sCheck" type="checkbox" name="debug" value="on"
								{if $quicky.const.DEBUG == TRUE}checked{/if}/><label>Debug</label> </p>
							</div>	
							<input type="submit" class="butDef" value="Сохранить" />				
						</div>
						</form>
					</div>
				<div class="tabAccount">
					<a href='?lang=ru'><img src='themes/i/russian.png' /></a> 
					<a href='?lang=en'><img src='themes/i/english.png' /></a>
				</div>
				</div>
			</div>
		</div>
		
		{if $speedbar!==''}
		 <!-- Tooltip zone --> 
		<div class="toolTip tpYellow" >
			<p class="clearfix">
				<img src="themes/img/icons/light-bulb-off.png" alt="Tip!" />
				{$speedbar}
			</p>
			
			<a class="close" title="Close"></a>
		</div>
		{/if}
		
		<div id="container" class="clearfix">
			 <!-- Left Menu --> 
			<div id="menu">
				<ul>
					<li>
						<a href="javascript:void(0)" class="clearfix">
							<img src="themes/img/icons/list.png" class="icon" alt="Lists"/>
							{$lang.lists}
							<span></span>
						</a>
						
						 <!-- Sub items --> 
						<ol class="clearfix">
							<li>
								<a href="?action=accounts">
									<img src="themes/img/icons/users.png" class="icon" alt="Dashboard" />
									{$lang.menu_acclist}
								</a>
							</li>
							
							<li>
								<a href="?action=charlist">
									<img src="themes/img/icons/chars.png" class="icon" alt="Contact e-mails" />
									{$lang.menu_char_list}
								</a>
							</li>
							
							<li>
								<a href="?action=itemlist">
									<img src="themes/img/icons/mail-small.png" class="icon" alt="Список предметов" />
									{$lang.itemlist}
									<span class="pin"><img src="themes/img/pin-small.png" alt="" /></span>
								</a>
							</li>
						</ol>
					</li>
				
					<li>
						<a href="javascript:void(0)" class="clearfix">
							<img src="themes/img/icons/chart-up.png" class="icon" alt="Trafic analytics"/>
							{$lang.adds}
							<span></span>
						</a>
							
						<ol class="clearfix">
							<li>
								<a href="?action=additem">
									<img src="themes/img/icons/plus-small.png" class="icon" alt="Site feeds" />
									{$lang.additemtitle}
									<span class="pin"><img src="themes/img/pin-small.png" alt="" /></span>
								</a>
							</li>
							
							<li>
								<a href="#">
									<img src="themes/img/icons/plus-small.png" class="icon" alt="Feeds clicks today" />
									{$lang.addabyss}
									<span class="pin"><img src="themes/img/pin-small.png" alt="" /></span>
								</a>
							</li>
						</ol>
					</li>
					
					<li>
						<a href="./backup/">
							<img src="themes/img/icons/database.png" class="icon" alt="Backup" />
							{$lang.backup}
						</a>
					</li>
					
					<li>
						<a href="javascript:void(0)">
							<img src="themes/img/icons/statistics.png" class="icon" alt="Statistic" />
							{$lang.menu_stat}
							<span></span>
						</a>
						
						<ol class="clearfix">
							<li><a href="index.php?action=statistic&type=total">{$lang.statdata}</a></li>
							<li><a href="index.php?action=statistic&type=graph">{$lang.graph}</a></li>
							<li><a href="index.php?action=statistic&type=online">{$lang.online}</a></li>
						</ol>
					</li>
					
					<li>
						<a href="javascript:void(0)">
							<img src="themes/img/icons/tool2.png" class="icon" alt="" />
							{$lang.tools}
							<span></span>
						</a>
						<ol class="clearfix">
							<!--<li><a href="index.php?action=statistic&type=total">Создать аккаунт</a></li>-->
							<li><a href="index.php?action=items">{$lang.itemwork}</a></li>

						</ol>
					</li>

				{if $debug==TRUE}
					<li class="tasks widget">
						<a href="javascript:void(0)">
							<img src="themes/img/icons/calendar-task.png" class="icon" alt="Tasks" />
							Debug
							<span></span>
						</a>
						<div class="content">
						{if $debug !==''}{$debug}{else}no data{/if}
						</div>
					</li>
				{/if}						
				</ul>
			</div>
			
			<div id="page">
				<div class="menu clearfix">
					 <!-- Page Dropdown  Menu --> 
					<ul id="pgmenu">
						<li><a href="#" class="sub">{$lang.bookmarks}<span>&nbsp;</span></a>
							<ul>
								{$bookmarks}
							</ul>
						</li>
						
						<li><a href="#" class="sub">{$lang.action}<span>&nbsp;</span></a>
							<ul>
							{if isset($quicky.get.char_id)}
								<li><a href="?action=char&char_id={$quicky.get.char_id}">{$lang.info}</a></li>
								<li><a href="?action=items&char_id={$quicky.get.char_id}">{$lang.inven}</a></li>
								<li><a href="?action=chardata&char_id={$quicky.get.char_id}">{$lang.char_data}</a></li>
							{/if}
							</ul>
						</li>
						
						{if isset($quicky.get.action) && $quicky.get.action=='info'}
						{if isset($char_list) && $char_list!=FALSE} 
								<li><a href="#" class="sub">{$lang.chars}<span>&nbsp;</span></a>
								<ul>
								{foreach key=key item=char from=$char_list}
	 								<li><a href="?action=char&char_id={$key}">{$char}</a></li>
	 							{/foreach}
	 							</ul>
							{/if}</li>
						{/if}
						<li><a href="http://wiki.fdcore.ru/aioncp:main" title='Only Russian'>{$lang.help}</a></li>
					</ul>
					
					 <!-- Page title --> 
					<div>{$title}</div>
					<div class="cr_pass"></div>
				</div>
				
				<div class="clearfix content">
					 <!-- Page content --> 
				
<div class="clearfix tabbar barProds">
	
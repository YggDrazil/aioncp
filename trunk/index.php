<?php
session_start();
/* ------------------------------------------------------------------------

	CP for Aoin
	version 0.4
	www.fdcore.ru
	
*/
define('CONF', 'config.php');
include('./class/core.php');
define('START_TIME', microtime());

// includes files
$class_list=array(
	'controller.php',
	 DRIVER.'.class.php',
	'table.class.php',
	DRIVER.'.model.php',
);

foreach ($class_list as $key => $value) {
	$value="class/$value";
	// есть чо?
	if (!file_exists($value)) {
		// не никуя нет
		exit("File $value is not found.");
	}
	// ням ^_^"
	include($value);
}
// ------------------------------------------------------------------------
/*	Меняем язык \ Changes lang */
if (isset($_GET['lang'])) {
	$_SESSION['lang']=$_GET['lang'];
	header("location: ".$_SERVER['HTTP_REFERER']);
	exit(0);
}
/* ------------------------------------------------------------------------
*/
$cp		=	new cpanel; // мну понелькО
$cp->check_sql_inject();  // проверка POST
$cp->db_mssql_check_xss(); // проверка GET 
$data	=	$cp->index(); // главный контроллер
/* ------------------------------------------------------------------------
	Jquery Effect (chenged in core.php)
*/
if (JS_EFFECT==FALSE) {
	$cp->js="$.fx.off = !$.fx.off;".$cp->js;
}
/* ------------------------------------------------------------------------
	CP Action 
*/
if (isset($_GET['action'])) {
	$ACT=$_GET['action'];
} else $ACT='';
	$h='icon-spacer'; // выделенно
	$unh='icon-no-spacer'; // yе выделенно
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
	"http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:php="http://php.net/xsl">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $cp->title." ".TITLE; ?></title>
<link rel="stylesheet" href="themes/css/style.css" type="text/css">
<link type="text/css" href="themes/css/blitzer/jquery-ui-1.8rc3.custom.css" rel="stylesheet" />
<script type="text/javascript" src="themes/js/jquery.js"></script>
<script type="text/javascript" src="themes/js/ui.js"></script>  
</head>
<body onload="$('#loader').fadeOut()">
 	<div class='fav'><a href="javascript:void(0)" onclick="$('.ajax_fav').toggle('slow');"><img src='themes/i/bookmark.png' alt='fav'></a></div>
 	
 	<div class='ajax_fav hide fav'>
 		<div class='fav'><a href="javascript:void(0)" onclick="$('.ajax_fav').hide('slow');"><img src='themes/i/dialog_close.png' alt='close'></a></div>
 		<div class='ajax_fav_load'><?php echo $cp->ajax() ?></div></div>
	<div id='loader'><img src='themes/i/wait.gif' alt='wait'></div>
<?php if($cp->logged) { ?>		
	<div class='topmenu' id='hm'><?php echo $cp->lang['hm'];?></div>
	<div class='topmenu hide' id='sm'><?php echo $cp->lang['sm'];?></div>
<?php };?>	
<div align="center">
	<table>
		<tr>
			<td><table>
				<tr>
			<td>
				<div id='logo'><p><img src="themes/i/new_logo.png" alt='Logo'><br>AionCP 0.4</p></div>  
					</td>          
			<td><div id='hidetopmenu' class='hide'>
				<div id='hiddenmenu'>
<?php if($cp->logged) { ?>						
				<div class="<?php if($ACT=='') echo $unh; else echo $h;?>"> 
					<p><a href="?"><img src="themes/i/gohome.png" /><br><?php echo $cp->lang['menu_main'];?></a></p> 
				</div> 
				<div class="<?php if($ACT=='accounts') echo $unh; else echo $h;?>"> 
					<p><a href="?action=accounts"><img src="themes/i/kontact_contacts.png" alt=''/><br><?php echo $cp->lang['menu_acclist'];?></a></p> 
				</div>
				<div class="<?php if($ACT=='additem')echo $unh; else echo $h;?>"> 
					<p><a href="?action=additem"><img src="themes/i/list_add.png" alt='' /><br/><?php echo $cp->lang['additemtitle'];?></a></p>
				</div> 
				<div class="<?php if($ACT=='charlist')echo $unh; else echo $h;?>"> 
					<p><a href="?action=charlist"><img src="themes/i/view_media_artist.png" alt='' /><br><?php echo $cp->lang['menu_char_list'];?></a></p>
				</div> 
				<div class="<?php if($ACT=='search')echo $unh; else echo $h;?>"> 
					<p><a href="?action=search"><img src="themes/i/edit_find.png" alt='' /><br><?php echo $cp->lang['menu_search'];?></a></p> 
				</div>  
				<div class="<?php if($ACT=='statistic')echo $unh; else echo $h;?>"> 
					<p><a href="?action=statistic"><img src="themes/i/help_about.png" alt='' /><br><?php echo $cp->lang['menu_stat'];?></a></p> 
				</div>
				<!--<div class="<?php if($ACT=='server')echo $unh; else echo $h;?>"> 
					<p><a href="?action=server"><img src="themes/i/work_server.png" alt='' /><br>Work for server</a></p> 
				</div> -->
				
				<div class="<?php if($ACT=='items')echo $unh; else echo $h;?>"> 
					<p><a href="?action=items"><img src="themes/i/items.png" alt='' /><br><?php echo $cp->lang['workitem'];?></a></p> 
				</div> 				
				
				<div class="<?php echo $h;?>"> 
					<p><a href="./backup"><img src="themes/i/backup.png" alt='' /><br>BackUP</a></p> 
				</div>								  
				<div class="icon-spacer"> 
					<p><a href="?action=logout"><img src="themes/i/system_log_out.png" alt='' /><br><?php echo $cp->lang['menu_exit'];?></a></p> 
				</div> 
<?php };?>				
			</div><!-- #hiddenmenu -->				
			</div></td>
		</tr>				
	</table></td>
		</tr>

<tr>
	<td><div style='height:20px;'></div><?php if($cp->speedbar!==''){?><div id='speedbar'><?=$cp->speedbar;?></div><?php }?></td>
</tr>

<tr>
	<td align="left"><form method='post'><?php echo $data?></form></td>
</tr>	
<tr>
	<td align='left' style='font-size:10px;'>
		<a href="http://lab.fdcore.ru" target="_blank" title='Touch me ;)'><img src='themes/i/F.png' alt='FDCore Studio'></a>
		<a href="http://fdcore.ru/donate" targer="_blank" title="Сделать Добравольное пожертвование"><img src="themes/i/donate.png"></a>
		<a href='?lang=ru'>RU</a> | 
		<a href='?lang=en'>EN</a> |
		Powered by HTML, <a href='http://php.net' target='_blank'>PHP</a>, XML, CSS 3, JS, SQL, 
		<a href='http://jquery.com' target='_blank'>JQuery</a>, 
		<a href="http://www.oxygen-icons.org/" target='_blank'>Oxygen</a>
		</td>
	</tr>
</table>
</div>
<script type="text/javascript"><?php echo $cp->js?></script>
<script type="text/javascript" src="themes/js/admincp.js"></script>
<!-- Copyright FDcore Studio | Powered by FDcore Labs -->
</body></html>

<?php
session_start();
/* ------------------------------------------------------------------------

	Free CP for Aoin
	beta version
	Developer www.fdcore.ru
	
	http://code.google.com/p/aioncp/
------------------------------------------------------------------------ */
define('CONF', 'config.php');
include('./class/core.php');
define('START_TIME', microtime());

// includes files
$class_list=array(
	'controller.php',
	 DRIVER.'.class.php',
	'table.class.php',
	'Quicky.class.php',
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
	$unh='icon-no-spacer'; // не выделенно

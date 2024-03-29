<?php
/* ------------------------------------------------------------------------

 * Aion Control Panel
 *
 * @version 1.2
 * @author NetSoul (FDCore main Developer)
 * @link http://www.fdcore.ru
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/deed.ru
 *
 * http://code.google.com/p/aioncp/
 * http://gameacp.ru/aioncp/
 *
 * @license http://fdcore.ru/license.html

------------------------------------------------------------------------ */
// Sessions

//get current path  FIX 04-09-2010
$pathinfo = pathinfo(__FILE__);
define('ROOT', $pathinfo['dirname'].DIRECTORY_SEPARATOR);

if(!defined('DOMAIN')){
	define("DOMAIN",'AionCP');
	define("SYSTEM_PATH",ROOT.'sys/');
	define("USER_PATH",ROOT.'app/');
	define("TPL_DIR",'themes/');
	define("TPL_URL",'themes/');
	@session_name('aioncp_free');
	
} else{
	@session_name('aioncp_'.DOMAIN);
}

@session_start();

// fix 24-05-2010
if (!extension_loaded('sqlite') && function_exists('dl')) {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        @dl('php_sqlite.dll');
    } else {
        @dl('sqlite.so');
    }
}
// route path
if(!file_exists(SYSTEM_PATH.'path.php'))
       exit('File SYSTEM_PATH/path.php not found :(');

if(!is_readable(SYSTEM_PATH.'path.php'))
	exit('File SYSTEM_PATH/path.php not readable :(');

include_once(SYSTEM_PATH.'path.php');

// Proffessional version check 
if(file_exists(CLASS_PATH . 'pro.controller.php')) include (CLASS_PATH . 'pro.controller.php');

// includes files
$class_list=array(
	 'controller.php',
	'mysql.class.php',
	'table.class.php',
   'helper.class.php',
   'Smarty.class.php',
    'cache.class.php',
     'throttling.php',
	'mysql.model.php',
	'SQLiteDatabase2.php',
  'encrypt.class.php'
 );


foreach ($class_list as $key => $value) {
	$value=CLASS_PATH . $value;
	// есть чо?
	if (!file_exists($value)) {
		// не никуя нет
		exit("Critical File $value is not found.");
	}
	// ням ^_^"
	include_once($value);
}
// ------------------------------------------------------------------------
/*	Меняем язык \ Changes lang */
if (isset($_GET['lang'])) {
	$_SESSION['lang']=$_GET['lang'];
	@header("location: ".$_SERVER['HTTP_REFERER']);
	exit(0);
}
/* ------------------------------------------------------------------------
*/

$cp		=	new aioncp; // главный класс
/* ------------------------------------------------------------------------
	Jquery Effect (chenged in core.php)
*/
if (JS_EFFECT==FALSE) {
	$cp->js="$.fx.off = !$.fx.off;".$cp->js;
}
$cp->check_sql_inject();  // проверка POST
$cp->db_mssql_check_xss(); // проверка GET 
$cp->index(); // главный контроллер
unset($cp);


if(defined('DEBUG') && DEBUG==TRUE){
    define("END_TIME",microtime());
    echo "<div style='position:fixed; bottom:0px;'>Compile for ".(END_TIME-START_TIME).' sec.</div>';
}
	

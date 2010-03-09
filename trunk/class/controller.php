<?php  
/* ------------------------------------------------------------------------

	Free CP for Aoin
	beta version
	www.fdcore.ru
	
	*комменты бля специально для русских няко-няк прогеров xD*
*/
/**
 * Main controller class
 *
 * @package default
 * @author NetSoul
 */        
define('VOID', 'javascript:void(0);');

class cpanel
{
	private $table;
	private $db;
	public $js='';
	public $title=TITLE;
	public $logged=FALSE;
	public $speedbar='';
	public $lang=array();
	private $time;
	private $items='';
	private $connect_db='';
	
	function __construct()
	{

		$this->table=new Table;
		$this->time=START_TIME;
		$this->lang_init(); 
		if (!file_exists(CONF)) {
			$this->install();
			exit("File ".CONF." is not found.");
		}
	} 
	/**
	 * Install AdminCP
	 *
	 * @return void
	 * @author NetSoul
	 */
	function install()
	{  
		if (!isset($_GET['l'])) {
			echo $this->_header(); 
			echo "<h2>Free AionCP [Installer]</h2>
			<h3>Select Languages</h3>
			<h2><a href='?l=en'>EN</a> | <a href='?l=ru'>RU</a></h2>
			";
			echo $this->_footer();     
			exit();
		} 
		$_SESSION['lang']=$_GET['l']; 
		
		$L = & $this->lang; 
		// print_r($this->lang);                            
		if (!isset($_GET['lic'])) {    
			echo $this->_header();
			
			echo '<div style="text-align:left"><p>Copyright (c) 2010 FDCore Studio<br>
		     All rights reserved.</p>

		    <p>Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:</p>

		    <ul>
		      <li>Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.</li>

		      <li>Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.</li>

		      <li>Neither the name of the FDCore Studio nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.</li>
		    </ul>

		    <p>THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.</p>   </div>
			<hr>
			<a href="?l='.$_GET['l'].'&lic=yes"><img src="themes/i/ok.png"></a> <a href="http://www.google.ru/search?client=safari&rls=en&q=buy+aion+admin+cp"><img src="themes/i/no.png"></a>';
			echo $this->_footer();     
			exit();	
		}
		$errors=0;
		if (
			isset($_POST['host']) &&
			isset($_POST['login']) &&
			isset($_POST['password']) &&
			isset($_POST['ls']) &&
			isset($_POST['gs'])
			) {
			$C=0;
			if (!$r=@mysql_connect($_POST['host'],$_POST['login'],$_POST['password'])) {
				$this->table->add_row('MySQL Connect',"<img src='themes/i/error.png' />");
				$C++;
			} else $this->table->add_row('MySQL Connect',"<img src='themes/i/success.gif' />");

			if (!$r=@mysql_select_db($_POST['ls'])) {
				$this->table->add_row('Connect to Login DB',"<img src='themes/i/error.png' />");
				$C++;
			} else $this->table->add_row('Connect to Login DB',"<img src='themes/i/success.gif' />");
			
			if (!$r=@mysql_select_db($_POST['gs'])) {
				$this->table->add_row('Connect to Game DB',"<img src='themes/i/error.png' />");
				$C++;
			} else $this->table->add_row('Connect to Game DB',"<img src='themes/i/success.gif' />");						
			if ($C==0) {
$file="<?php
\$db_host='".$_POST['host']."';
\$db_login='".$_POST['login']."';
\$db_password='".$_POST['password']."';
\$db_login_server='".$_POST['ls']."';
\$db_game_server='".$_POST['gs']."';";
			@file_put_contents(CONF,$file);
			@header('location: index.php');
			}
			
		}
	   	if (function_exists('simplexml_load_file'))
	   		$this->table->add_row('Simplexml',"<img src='themes/i/success.gif' />");
   		 else {
   	 		$this->table->add_row('Simplexml',"<img src='themes/i/error.png' />");
   	 		$errors++;
   	 	}
 	   	if (function_exists('mysql_connect'))
	   		$this->table->add_row('MySQL',"<img src='themes/i/success.gif' />");
   		 else {
   	 		$this->table->add_row('MySQL',"<img src='themes/i/error.png' />");
   	 		$errors++;
   	 	}  	
   	 	if ($errors==0) {
   	 		$this->table->add_row($L['host'],"<input type='text' name='host'>");
   	 		$this->table->add_row($L['login'],"<input type='text' name='login'>");
   	 		$this->table->add_row($L['password'],"<input type='text' name='password'>");
   	 		$this->table->add_row($L['ldb'],"<input type='text' name='ls'>");
   	 		$this->table->add_row($L['gdb'],"<input type='text' name='gs'>");
   	 		$this->table->add_row('',"<input type='submit' value='".$L['install']."'>");
   	 	}
		echo $this->_header(); 
		echo "<form method='post'><h2><a href='index.php' >Free AionCP [Installer]</a></h2>".$this->table->generate()."</form>";  
		echo $this->_footer();     
		exit();
	}
	
	private function _header()
	{
$TEXT=<<<TEXT
	 	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
			"http://www.w3.org/TR/html4/strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xmlns:php="http://php.net/xsl">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Setup Free Aion CP</title>
		<link rel="stylesheet" href="themes/i/style.css" type="text/css">
		<script type="text/javascript" src="themes/i/jquery-1.4.1.min.js"></script> 
		</head><body>
		<div align="center"> 
TEXT;
	return $TEXT;
} 
private function _footer()
{
	$TEXT=<<<TEXT
		</div>
		<!-- Copyright FDcore Studio | Powered by FDcore Labs -->
		</body></html>
TEXT;
		return $TEXT;
}
// ------------------------------------------------------------------------
	/*
		Интернализация ? =)
	*/	
	private function lang_init()
	{
	
			// составляем путь
		if (isset($_SESSION['lang'])) {
			$path =   "./xml/".$_SESSION['lang']."_lang.xml"; // основной файл языка
			$cachepath="./cache/".$_SESSION['lang']."_lang.cache";// файш кеша
		} else {
			$path =  "./xml/".DEFAULT_LANG."_lang.xml";// основной файл языка
			$cachepath="./cache/".DEFAULT_LANG."_lang.cache"; // файш кеша
		}
		// проверка кеш файла
		if(file_exists($cachepath)){
			$temp=unserialize(file_get_contents($cachepath));
			$this->lang=$temp;
			unset($temp);
			return;
		}
		
		// проверка библиотеки
	   	if ( ! function_exists('simplexml_load_file'))
	   	{
	   		exit("Function simplexml_load_file not found, enabled simplexml lib.");
	   	}

	   // проверяем наличие файла   
      if (file_exists($path)) {
         
         $xml=simplexml_load_file($path);
         
         if (!is_object($xml)) {
         	exit("Lang object is not created :(");
         }
         
         foreach ($xml as $key => $value) {

         	$this->lang[$key]=(string)$value[0];
         }
         
         $temp=serialize($this->lang);
         file_put_contents($cachepath,$temp);
         unset($temp);
         
		} else {
			exit("File $path not found!");
		}
	}
	// ------------------------------------------------------------------------
	/*
		main router
	*/
	public function index()
	{
		if (isset($_SESSION['login']) && isset($_SESSION['token'])) {
			if ($_SESSION['token']=sha1($_SESSION['login'])) {  
				return $this->main_form();
			}
			else {
				$this->logged=TRUE;
				return $this->show_login();
			}
		} else {
			$this->logged=FALSE; 
			return $this->show_login();
		}

		return;
	}
	
	function check_logins()
	{
		if (isset($_SESSION['login']) && isset($_SESSION['token'])) {
			if ($_SESSION['token']=sha1($_SESSION['login'])) return TRUE; else exit('not access');
		} else 	exit('not access');
	}	
// ------------------------------------------------------------------------
	/*
		show login form for auth in cp
	*/	
	private function show_login()
	{
		$this->title.=$this->lang['authorize'];
		$return='';
		
		if($this->connect_db!=='ls'){
			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server); 
			$this->connect_db='ls';
		}
			
		if (isset($_POST['login'])) {
			$login		=	$this->secure($_POST['login']);
			$password	=	$this->secure($_POST['password']);
			if ($this->check_login($login,$password)) {
				$_SESSION['login']=$login;
				$_SESSION['token']=sha1($login);
				header("location: index.php");
				return;
			} else {
				$return='<div class="error_msg" onclick="$(this).hide(\'slow\')"><img src="themes/i/error.png">'.$this->lang['error_enter'].'</div>';
			}
		}
		$tmpl = array ('table_open' => '<table border="0" align="center" class="main_form" cellpadding="1" cellspacing="0">');
		
		$this->table->set_template($tmpl);
		$this->table->add_row($this->lang['login'],'<input name="login" type="text">');
		$this->table->add_row($this->lang['password'],'<input name="password" type="password">');
		
		$this->table->add_row('','<input type="submit" value="'.$this->lang['enter'].'" class="button">');
		
		return $return.'<form method="post">'.$this->table->generate().'</form>';
	}
  /**
   * Main admin form 
   *
   * @return void
   * @author NetSoul
   */
	private function main_form()
	{
		$return='';
				
		if (isset($_GET['action'])) {
			$return.=$this->action($_GET['action']);
		} else {
			if (isset($_SESSION['lang']) && $_SESSION['lang']=='en') $return="Thank you for choosing our implementation 
			of a control panel for game server Aion.<br>Now Current sponsor is:
			<br><a href='http://pvpworld.ru'><img src='themes/i/sponsor.jpg'></a>
				<br>Donate: PayPal email sealnetsoul@gmail.com";
				else
			$return='<div>Спасибо что выбрали нашу разработку панели управления для игрового сервера Aion.<br>Наш текущий спонсор:
			<br><a href="http://pvpworld.ru"><img src="themes/i/sponsor.jpg"></a></div>';
		}
		$this->logged=TRUE;
		if (DEBUG) {
			$alltime=microtime()-START_TIME;
			$pattern="<div id='debug' onclick='\$(this).hide();'>Debug mode:<br>Queryes: %d<br>Time db: %s<br>All time: %s<hr>
			<textarea rows='10' cols='30'>POST ".var_export($_POST, 1)."</textarea>
			</div>";
			if(is_object($this->db))
					$debug=sprintf($pattern,$this->db->num_queries,$this->db->total_time_db,$alltime);
			else $debug='';
				
			return $return.$debug;
		}		
		
		
		return $return;
	}
// ------------------------------------------------------------------------
	/*
		check login and pass in database
	*/	
	private function check_login($login,$password)
	{
		$password=base64_encode(sha1($password,true));
		
		$result=$this->db->sql_query(aion::login($login,$password));
		
		if ($this->db->sql_numrows($result) > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
// ------------------------------------------------------------------------
	/*
		clear string
	*/	
	function secure($check_string)
	{
	    $ret_string = $check_string;
	    $ret_string = htmlspecialchars ($ret_string);
	    $ret_string = strip_tags ($ret_string);
	    $ret_string = trim ($ret_string);
	    $ret_string = str_replace ('\\l', '', $ret_string);
	    $ret_string = str_replace (' ', '', $ret_string);
	    $ret_string  = str_replace("'", "", $ret_string );
	    $ret_string  = str_replace("\"", "",$ret_string );
	    $ret_string  = str_replace("--", "",$ret_string );
	    $ret_string  = str_replace("#", "",$ret_string );
	    $ret_string  = str_replace("$", "",$ret_string );
	    $ret_string  = str_replace("%", "",$ret_string );
	    $ret_string  = str_replace("^", "",$ret_string );
	    $ret_string  = str_replace("&", "",$ret_string );
	    $ret_string  = str_replace("(", "",$ret_string );
	    $ret_string  = str_replace(")", "",$ret_string );
	    $ret_string  = str_replace("=", "",$ret_string );
	    $ret_string  = str_replace("+", "",$ret_string );
	    $ret_string  = str_replace("%00", "",$ret_string );
	    $ret_string  = str_replace(";", "",$ret_string );
	    $ret_string  = str_replace(":", "",$ret_string );
	    $ret_string  = str_replace("|", "",$ret_string );
	    $ret_string  = str_replace("<", "",$ret_string );
	    $ret_string  = str_replace(">", "",$ret_string );
	    $ret_string  = str_replace("~", "",$ret_string );
	    $ret_string  = str_replace("`", "",$ret_string );
	    $ret_string  = str_replace("%20and%20", "",$ret_string );
	    $ret_string = stripslashes ($ret_string);
	    return $ret_string;
	}
// ------------------------------------------------------------------------ 		
	function db_mssql_check_xss () {
		$url = html_entity_decode(urldecode($_SERVER['QUERY_STRING']));
		if ($url) {
			if ((strpos($url, '<') !== false) ||
				(strpos($url, '>') !== false) ||
				(strpos($url, '"') !== false) ||
				(strpos($url, '\'') !== false) ||
				(strpos($url, './') !== false) ||
				(strpos($url, '../') !== false) ||
				(strpos($url, '--') !== false) ||
				(strpos($url, '.php') !== false)
			   )
			{
				die("Hacking attept!");
			}
		}
		$url = html_entity_decode(urldecode($_SERVER['REQUEST_URI']));
		if ($url) {
			if ((strpos($url, '<') !== false) ||
				(strpos($url, '>') !== false) ||
				(strpos($url, '"') !== false) ||
				(strpos($url, '\'') !== false)
			   )
			{
				die("Hacking attept!");
			}
		}
	
	}
	/*
		Обработка глобального POST массива
		защищает от XSS и SQL Injection
	*/
	 function check_sql_inject() 
	  { 
	    $badchars = array("--","truncate","tbl_","exec",	";","'","*","/"," \ ","drop",
	    	"select","update","delete","where", "-1", "-2", "-3","-4", "-5", "-6", "-7", "-8", "-9"); 
	    foreach($_POST as $value) 
	    { 
		    foreach($badchars as $bad) 
		    {
			    if(strstr(strtolower($value),$bad)<>FALSE) 
			    {
			    	die('Hacking attept!');
			    }
			}
	    } 
	  } 
// ------------------------------------------------------------------------
	  /*
	  	Шо где и куды?
	  	
	  */	  
	  private function action($ACT='')
  	{
  		$this-> check_logins();
  		
  		$ACT=$this->secure($ACT);
  		
  		switch ($ACT) {
  			case 'logout':
  				session_destroy();
  				header("location: index.php");
  				return;
  				break;
  			case 'accounts':
  				return $this->accounts_list();
  				break;	
  				  
  			case 'info':
  				return $this->account();
  				break;	 
  				
  			case 'statistic':
  				return $this->statistic();
  				break;	
  				
  			case 'char':
  				return $this->char();
  				break;	 
  				
  			case 'search':
  				return $this->search();
  				break;	 
  				
  			case 'bookmarks':
  				return $this->bookmarks();
  				break;	  
				 				 	
  			case 'additem':
  				return $this->additem();
  				break;
  					
			case 'charlist':
				return $this->charlist();
				break;
			case 'items':
				return $this->items();
				break;	
				
			case 'edititem':
				return $this->edititem();  
				break;
			case 'chardata':
				return $this->chardata();
				break;
									 							
  			default:
  				return 'not action';
  				break;
  		}
  	}	
// ------------------------------------------------------------------------
  	/*
  		Вывод списка аккаунтов
  	*/  	
  	function accounts_list()
  	{
		$return='';
		$L = & $this->lang;
		$this->title=$L['menu_acclist'];
		if($this->connect_db!=='gs') {
			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
			$this->connect_db='gs';
		}
		$this->table->clear();
$this->js=<<<JS
\$('#chkey').keyup(function(){
	  var char;
	  char=\$('#chkey').val();
	  ajax_chars(char);  
	  return false;
});
JS;
		$chars=range('a','z');
		foreach ($chars as $key => $value) {
			$chars[$key]="<a href='?action=accounts&C=$value' onclick=\"ajax_chars('$value');return false;\">$value</a> ";
		}
		$chars[]="<a href='?action=accounts' onclick=\"ajax_chars('');return false;\">".$L['all']."</a> <input type='text' id='chkey' name='char' maxlength='1' style='width:10px'>";
		$this->speedbar="<strong>".$this->table->generate($chars).'</strong>';
		$this->table->clear();
		$this->table->set_heading($L['account'],$L['char']);
		
		//------------- QUERY BUILD----------------//
		if (isset($_GET['C'])) {
			$char=$this->secure($_GET['C']);
			$char="WHERE account_name LIKE '$char%'";
			$result=$this->db->sql_query("SELECT name,account_name,account_id FROM `players` $char");
		} else {
			$result=$this->db->sql_query("SELECT name,account_name,account_id FROM `players` LIMIT 0 , 30");
		}
			$tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" id="tablesorter">',
                    'row_start'           => '<tr style="background:#E9E9E9">',
                    'row_alt_start'       => '<tr style="background:#F8F8F8">',
              );
			$this->table->set_template($tmpl);			
		
		if ($this->db->sql_numrows($result) > 0) {
			while (list($name,$account_name,$account_id)=$this->db->sql_fetchrow($result)) {
				$this->table->add_row(
				"<a href='?action=info&char=$account_id'>$account_name</a>",
				"<a href='?action=char&char_name=$name'>$name</a>");
			}
		}
		if (isset($_GET['ajax'])) exit($this->table->generate());
		/*
			TODO сделать кастомное поле для ввода символа
		*/
		$return.="<div id='ajax'>".$this->table->generate()."</div>";
		return $return;
  	}
// ------------------------------------------------------------------------
  	/*
  		Edit Account
  	*/  	
  	function account()
  	{
  		$L = & $this->lang;
  		$this->title=$L['acc_info'];
		//connection
		if($this->connect_db!=='ls'){
			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server); 
			$this->connect_db='ls';	
		}
		if (isset($_GET['char'])) {
			$char=intval($this->secure($_GET['char']));
			$this->table->clear();
			$message='';
			// POST data start
			if (isset($_POST['name'])) {
				$result=$this->db->sql_query("SELECT name,password,access_level,email FROM account_data WHERE id='$char'");
				$row=$this->db->sql_fetchrow($result);
				//----------------- activated
				if(isset($_POST['activated']) && $_POST['activated']!=='') 
					$activated=$this->secure($_POST['activated']);
						else $activated=0;
				$this->db->sql_query("UPDATE account_data SET activated = '$activated' WHERE id=$char LIMIT 1;");		
				
				//----------------- password
				if (isset($_POST['password']) && $_POST['password']!=='') {
					$password		=$this->secure($_POST['password']);
					if (base64_encode(sha1($password,true))!==$row['password']) {
						$password=base64_encode(sha1($password,true));
						$this->db->sql_query("UPDATE account_data SET password = '$password' WHERE id=$char LIMIT 1;");
						$message.='<div class="succes_msg"><img src="themes/i/success.gif">'.$L['pass_changed'].'</div>';
					}
				}
				//----------------- access_level
				if (isset($_POST['access_level']) && $_POST['access_level']!==$row['access_level']) {
					$access_level	=	intval($this->secure($_POST['access_level']));
					$this->db->sql_query("UPDATE account_data SET access_level = '$access_level' WHERE id=$char LIMIT 1;");
					$message.='<div class="succes_msg"><img src="themes/i/success.gif">'.$L['acl_change'].'</div>';
				}
				
				
				//----------------- name
				$name			=$this->secure($_POST['name']);
				if ($name!==$row['name']) {
					$this->db->sql_query("UPDATE account_data SET name = '$name' WHERE id=$char LIMIT 1;");
					include(CONF);
					$db_gs	=new sql_db($db_host, $db_login, $db_password, $db_game_server);			
					$db_gs->sql_query("UPDATE players SET account_name = '$name' WHERE account_id=$char LIMIT 1;");	
					unset($db_gs);
					$message.='<div class="succes_msg"><img src="themes/i/success.gif">'.$L['login_ch'].'</div>';
				}
				//----------------- email
				$email	=$this->secure($_POST['email']);
				
				if ($email!==$row['email']) {
					$this->db->sql_query("UPDATE account_data SET email = '$email' WHERE id=$char LIMIT 1;");
					$message.='<div class="succes_msg"><img src="themes/i/success.gif">'.$L['email_ch'].'</div>';
				}
				if($this->connect_db!=='ls'){		
					include(CONF);		
					$this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server);
					$this->connect_db='ls';
				}
			}
			// POST data end
			
			$result=$this->db->sql_query("SELECT id,name,password,activated,access_level,email,last_ip,ip_force FROM account_data WHERE id=$char");
			if ($this->db->sql_numrows($result) > 0) {
				$row=$this->db->sql_fetchrow($result);
				
				if ($row['activated']=='1') {
					$ACTIV='checked';
				} else $ACTIV='';
				$this->title.=$row['name'];
				$FAV="<a href='".VOID."' onclick=\"add_bookmark('%s','%s');\$(this).fadeOut('slow')\" title='".$L['addbookm']."'><img src='themes/i/bookmark_add.png' title='".$L['addbookm']."'></a>"; 
				$this->table->add_row($L['login'],
						'<input type="text" name="name" value="'.$row['name'].'">'.sprintf($FAV,$row['id'],$row['name']));  
						
				$this->table->add_row($L['password'],'<input type="text" name="password">');
				$this->table->add_row($L['active'],'<input type="checkbox" '.$ACTIV.' name="activated" value="1">');
				$this->table->add_row($L['acl'],'<input type="text" name="access_level" value="'.$row['access_level'].'">');
				$this->table->add_row($L['email'],'<input type="text" name="email" value="'.$row['email'].'">');
				$this->table->add_row($L['last_ip'],($row['last_ip']=='')?$L['none']:$row['last_ip']);
				
				$r="<form metdod='post'>".$message.$this->table->generate().'<input type="submit" value="'.$L['edit'].'"></form>';
				
				if ($ch=$this->my_chars(intval($_GET['char']))) {
					$list='<h2><a href="'.VOID.'" 
						onclick="$(\'#chars\').slideToggle(500)" 
					    title="'.$L['clickme'].'">'.$L['acc_char'].'</a>
					</h2><ul id="chars" class="hide list_none">';
					
					foreach ($ch as $key => $value) {
						$ajax="<a href='".VOID."' onclick=\"ajax_char('$key','#ajax_$key');\" title='".$L['preload']."'><img src='themes/i/info.png'></a>";
						$list.="<li><h3><a href='?action=char&char_id=$key'>$value</a>&nbsp;&nbsp;$ajax<div id='ajax_$key' class='hide'></div></h3></li>";
					}
					$list.='</ul>';
					$r.=$list;
				} else $r.="<p>".$L['no_char']."</p>";
				return $r;
				
			}
			return $L['acc_nf'];
		}  else {
			return $L['acc_nf'];
		}
  	}
// ------------------------------------------------------------------------
  	/*
  		Срёт массивом персов акка
  	*/  	
	function my_chars($account_id='')
	{
		
		$ret = array();	
		// Хде?
		if($this->connect_db!=='gs'){
			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
			$this->connect_db='gs';
		}
		// шо?
		$account_id=intval($account_id);
		$result=$this->db->sql_query("SELECT id,name FROM players WHERE account_id=$account_id");
		
		// есть чО?
		if ($this->db->sql_numrows($result) > 0) {
			while (list($key,$val)=$this->db->sql_fetchrow($result)) {
				$ret[$key]= $val;
			}
			// срём
			return $ret;
		} else {
			// нечем срать
			return FALSE;
		}
	}
// ------------------------------------------------------------------------
  	/*
  		Статистика
  	*/  	
  	private function statistic()
  	{
  		$L = & $this->lang;
  		
  		$this->title=$L['stat_title'];
  		if($this->connect_db!=='ls'){
			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server); 
			$this->connect_db='ls';
		} 		
  		$this->speedbar="<a href='".VOID."' 
  		onclick=\"$('#text').slideToggle('slow');return false;\">".$L['text']."</a> | 
  			<a href='".VOID."' 
  		onclick=\"$('#chart').slideToggle('slow');\">".$L['graph']."</a>";
  		$result=$this->db->sql_query("SELECT COUNT(*) as count FROM `account_data` WHERE activated=1");
  		list($count_active)=$this->db->sql_fetchrow($result);
  		$this->table->add_row($L['stat_act'],$this->b($count_active));
  		
  		$result=$this->db->sql_query("SELECT COUNT(*) as count FROM `account_data` WHERE activated=0");
  		list($count_unactive)=$this->db->sql_fetchrow($result); 
  		$this->table->add_row($L['stat_unact'],$this->b($count_unactive));
  		
  		$result=$this->db->sql_query("SELECT COUNT(*) as count FROM `account_data`");
  		list($count_all)=$this->db->sql_fetchrow($result); 	
  		$this->table->add_row($L['stat_allacc'],$this->b($count_all));	
  		
  		include(CONF);
  		$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
  		
  		$result=$this->db->sql_query("SELECT COUNT(*) AS count FROM  `players` WHERE  `gender` =  'MALE'");
  		list($CountMalePlayers)=$this->db->sql_fetchrow($result);
  		$this->table->add_row($L['stat_male'],$this->b($CountMalePlayers));
  		  		
   		$result=$this->db->sql_query("SELECT COUNT(*) AS count FROM  `players` WHERE  `gender` =  'FEMALE'");
  		list($CountFemalePlayers)=$this->db->sql_fetchrow($result);
  		$this->table->add_row($L['stat_fam'],$this->b($CountFemalePlayers));

   		$result=$this->db->sql_query("SELECT COUNT(*) AS count FROM  `players`");
  		list($CountAllPlayers)=$this->db->sql_fetchrow($result);
  		$this->table->add_row($L['stat_allch'],$this->b($CountAllPlayers));  
  		
  		$gapi1=$this->chart("$count_active,$count_unactive",sprintf($L['actdeac'],$count_active,$count_unactive),$L['accounts']);
  		$gapi2=$this->chart("$CountMalePlayers,$CountFemalePlayers",sprintf($L['sexchart'],$CountMalePlayers,$CountFemalePlayers),$L['sex']);
  		
  		$texts="<div id='text'>".$this->table->generate()."</div>";
  		$this->table->clear();
  		
  		$this->table->add_row($gapi1,$gapi2);
 
  		$chart="<div id='chart' style='display:none'>".$this->table->generate()."</div>";
  		
  		
  		return $texts.$chart;
  	}
// ------------------------------------------------------------------------
  	/*
  		Bold text ^_^
  	*/  	
  	private function b($text)
  	{
  		return "<strong>$text</strong>";
  	}
// ------------------------------------------------------------------------
  	/*
  		Google API Chars
  	*/  	
  	private function chart($chd,$chl,$chtt='',$cht='p')
  	{
  		$chtt=urlencode($chtt);
  		$chl=urlencode($chl);
		return "<img src='http://chart.apis.google.com/chart?cht=$cht&chd=t:$chd&chs=400x200&chl=$chl&chtt=$chtt'>";
  	}
// ------------------------------------------------------------------------
  	/*
  		а вот и Чар нах 
  	*/  	
  	private function char()
  	{	
		$L = & $this->lang;
		$content='';
		if($this->connect_db!=='gs'){
			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
			$this->connect_db='gs';	
		}
		if (isset($_GET['char_id']) || isset($_GET['char_name'])) { 
			 if (isset($_POST['name'])) {     
				$upname=$this->secure($_POST['name']);      
				if(isset($_GET['char_id'])){
					 $char_id=intval($_GET['char_id']); 
					 $WHERE="id='$char_id'";
				}          
				if (isset($_GET['char_name'])) {
					$name=$this->secure($_GET['char_name']);   
					$WHERE="name='$name'";
				}

			 	$this->db->sql_query("UPDATE players SET name='$upname' WHERE $WHERE LIMIT 1");  
			  if (isset($_GET['char_name'])) {  
				 header("location: ?action=char&char_name=$upname"); 
				 exit();
				}
			  $content.="<div id='informer' onclick=\"$(this).slideUp('slow')\">".$L['charnamech']."$upname.</div>";
			 }                                                                        
			
			// передан id
			if (isset($_GET['char_id'])){
				$char_id=intval($_GET['char_id']);
				$result=$this->db->sql_query("SELECT * FROM players WHERE id='$char_id' LIMIT 1");	
			}
			// передан ник
			if (isset($_GET['char_name'])) {
				$name=$this->secure($_GET['char_name']);
				$result=$this->db->sql_query("SELECT * FROM players WHERE name='$name' LIMIT 1");
			}
			// высераем данные
if (isset($_GET['ajax']))  { $js=<<<JS
<script type="text/javascript">
function destroy_div(target){
\$(target).slideUp('slow',function(){\$(target).text('');});
}
</script>
JS;
echo $js;
}           
$this->js=<<<JS
$("#chname").focus(
      function () {
        $(".editbtn1").fadeIn('slow');
      }, 
      function () {
        $(".editbtn1").fadeOut('slow');
      }
    ); 
$("#chname").blur(
		  function () {
		     $(".editbtn1").fadeOut('slow');  
		  });                
		
$(".class_edit").click(function(){ 
	var class_text=$(".class_edit").text();
	 $(".class_edit").html("<input type='text' value='"+class_text+"'>");
});		                 
JS;
			if ($this->db->sql_numrows($result) > 0) {   
				$row=$this->db->sql_fetchrow($result);
				$this->table->add_row('id',	$row['id']);
				if (isset($_GET['ajax'])){
					$this->table->add_row($L['name'],$row['name']);
				} else {
					$this->table->add_row($L['name'],"<input type='text' name='name' id='chname' value='".$row['name']."'>
				<input type='submit' value='".$L['edit']."' class='hide editbtn1'>");  
				}    
				/*
					TODO multi lang
				*/
				$this->table->add_row($L['login'],"<a href='?action=info&char=".$row['account_id']."' title='Open Account'>".$row['account_name'].'</a>'); 
				/*
					TODO edit class and other
				*/
				if (isset($_GET['ajax'])) $EDIT=''; else $EDIT="<a href='".VOID."' onclick=\"alert('Данная функция будет доступна позже.')\" title='Изменить'><img src='themes/i/edit.png'  title='Изменить'></a>";
				
				
				$this->table->add_row($L['class'],	$row['player_class'].$EDIT);
				$this->table->add_row($L['race'],	$row['race'].$EDIT);
				$this->table->add_row($L['create'],	$row['creation_date']);
				$this->table->add_row($L['lastexit'],$row['last_online']);
				$this->table->add_row($L['level'],	$this->get_level($row['exp']));
				if (isset($_GET['ajax'])) {
					exit($content.$this->table->generate().
					"<a href='".VOID."' 
						onclick=\"destroy_div('#ajax_{$row['id']}');\" title='".$L['close']."'>
					<img src='themes/i/dialog_close.png'></a>");
				}
				if (!isset($_GET['ajax'])){
					$menu='<hr>
					<p><a href="?action=items&char_id='.$row['id'].'">'.$L['inven'].'</a></p>
					<p><a href="?action=chardata&char_id='.$row['id'].'">'.$L['char_data'].'</a></p>
					<p><a href="#?action=extra&func=delete_char&char_id='.$row['id'].'">'.$L['delchar'].'</a></p>
					';
				} else $menu='';
				return $content.$this->table->generate().$menu;
			} else {
				return $L['char_datanotf'];
			}
		} else {
			return $L['char_datanotf'];
		}
		
  	}
// ------------------------------------------------------------------------
  	/*
  		изменение данных персонажа
  	*/   	
  	function chardata(){
		 
		 $L = & $this->lang;
		 $content='';
		 
		 if($this->connect_db!=='gs'){
		 	 include(CONF);
			 $this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server); 
			 $this->connect_db='gs';
		}
		
		if (isset($_POST['editabyss']) && isset($_GET['char_id'])) {
			$char_id=intval($_GET['char_id']);
			$abyss=intval($_POST['abyss']);
			$this->db->sql_query("UPDATE abyss_rank SET ap = $abyss WHERE player_id = $char_id LIMIT 1");
			$content.="<div class='info_msg'>Значение абис очков изменено на $abyss!</div>";
		}
			
		 // передан id
		 if (isset($_GET['char_id'])){
		 	
		 
		 	// быстрый список *__*
		 	if(file_exists('./cache/level.cache')){
		 		$ll=file_get_contents('./cache/level.cache');	
		 	} else {
		 		$ll='&rarr; <select name="levels" class="levels" onclick="$(\'.level\').val($(this).val())">'; // Level List
			 	$level=$this->exp_list();
			 	foreach ($level as $key => $value)
			 	{
			 		$ll.="<option value='$value'>$key</option>";
			 	}
			 	$ll.="</select>";
			 	file_put_contents('./cache/level.cache',$ll);
		 	}
		 	
		 	$char_id=intval($_GET['char_id']);
		 	$result=$this->db->sql_query("SELECT * FROM players WHERE id='$char_id' LIMIT 1");
		 // проверка 		
		 	if ($this->db->sql_numrows($result) > 0) {
		 	// парсинг
		 		$row=$this->db->sql_fetchrow($result);
		 		$this->speedbar="<p><a href='?action=info&char=".$row['account_id']."'>".$row['account_name']."</a> &rarr; <a href='?action=char&char_name=".$row['name']."'>".$row['name']."</a> &rarr; $char_id</p>";
		 		
		 		$this->table->add_row($L['level'],$this->get_level($row['exp'])."
		 		<a href='".VOID."' onclick=\"$('.chlevel').toggle('slow')\" title='".$L['edit']."'>
		 			<img src='themes/i/edit.png' title='".$L['edit']."'></a>
		 		
		 		<div class='chlevel hide'>EXP:<input type='text' class='level' name='level' value='".$row['exp']."'>
		 				<input type='submit' name='editlevel' class='ui-button ui-state-default ui-corner-all' value='".$L['edit']."'>
		 			<a href='".VOID."' onclick=\"$('.ll').slideToggle('slow')\"><img src='themes/i/wizard.png'></a>
		 			<div class='ll hide'>$ll</div>
		 		</div>");
		 		
		 		$this->table->add_row('Абис очки',"<input type='text' name='abyss' value='".$this->abyss($char_id)."'>
		 			<input type='submit' name='editabyss' class='ui-button ui-state-default ui-corner-all' value='".$L['edit']."'>");
		 		return $content.$this->table->generate();
		 	
		 	} else return 'Персонаж не найден о_О';
		 }// if	
		 
		 
  	}// func
// ------------------------------------------------------------------------
  	/*
  		поиск
  	*/  	
  	private function search()
  	{
$this->js=<<<JS
$('#account_search').keyup(function(){
	$('#loader').fadeIn('fast');
	$('#ajax_result').load('?action=search&type=account_search&account_search='+$('#account_search').val(),
	function(){\$('#loader').fadeOut('slow');});
});
$('#char_name').keyup(function(){
	$('#loader').fadeIn('fast');
	$('#ajax_result').load('?action=search&type=char_name&char_name='+$('#char_name').val(),
	function(){\$('#loader').fadeOut('slow');});
});
$('#email_search').keyup(function(){
	$('#loader').fadeIn('fast');
	$('#ajax_result').load('?action=search&type=email_search&email_search='+$('#email_search').val(),
	function(){\$('#loader').fadeOut('slow');});
});
JS;

		$L = & $this->lang;
		if (isset($_GET['type'])) {
			$ACT=$_GET['type'];
			$tmpl = array (
                    'table_open'          => '<table cellpadding="4">',
                    'row_start'           => '<tr style="background:#E9E9E9">',
                    'row_alt_start'       => '<tr style="background:#F8F8F8">',
              );
			$this->table->set_template($tmpl);	
						
			// поиск аккаунта по имени
			if ($ACT=='account_search') {
			
			if($this->connect_db!=='ls'){
				include(CONF);
				$this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server);
				$this->connect_db='ls';	
			}
				$account=$this->secure($_GET['account_search']);
				if ($account=='') {
					exit($this->b($L['no_result']));
				}
				$FAV="<a href='".VOID."' onclick=\"add_bookmark('%s','%s');\$(this).fadeOut('slow')\" title='".$L['addbookm']."'><img src='themes/i/bookmark_add.png' title='".$L['addbookm']."'></a>";
				
				$result=$this->db->sql_query("SELECT id,name FROM `account_data` WHERE name LIKE '$account%' OR name='$account'");
				
				if ($this->db->sql_numrows($result) > 0) {
					while (list($id,$name)=$this->db->sql_fetchrow($result)) {
						$this->table->add_row("<a href='?action=info&char=$id'>$name</a>",sprintf($FAV,$id,$name));
					}
				} else exit($this->b($L['no_result']));
				exit($this->b("<div>".$L['finded'].$this->db->sql_numrows($result)."</div><hr>").$this->table->generate());				
			}
			// поиск персонажа
			if ($ACT=='char_name') {
				$name=$this->secure($_GET['char_name']);
				if($this->connect_db!=='gs'){
					include(CONF);
					$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
					$this->connect_db='gs';	
				}
				if ($name=='') {
					exit($this->b($L['no_result']));
				}				
				
				$result=$this->db->sql_query("SELECT id,name FROM `players` WHERE name LIKE '$name%' OR name='$name'");
				
				if ($this->db->sql_numrows($result) > 0) {
					while (list($id,$name)=$this->db->sql_fetchrow($result)) {
						$this->table->add_row("<a href='?action=char&char_id=$id'>$name</a>");
					}
				} else exit($this->b($L['no_result']));
				exit($this->b("<div>Найдено: ".$this->db->sql_numrows($result)."</div><hr>").$this->table->generate());					
			}
			// поиск по email
			if ($ACT=='email_search') {
			
				if($this->connect_db!=='ls'){
					include(CONF);
					$this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server);
					$this->connect_db='ls';	
				}
				$email=$this->secure($_GET['email_search']);
				if ($email=='') {
					exit($this->b($L['no_result']));
				}				
				$result=$this->db->sql_query(aion::search_email($email));
				
				if ($this->db->sql_numrows($result) > 0) {
					while (list($id,$name,$email)=$this->db->sql_fetchrow($result)) {
						$this->table->add_row("<a href='?action=info&char=$id'>$name</a>",$email);
					}
				} else exit($this->b($L['no_result']));
				exit($this->b("<div>Найдено: ".$this->db->sql_numrows($result)."</div><hr>").$this->table->generate());					
			}			
		}
  		$this->table->add_row($L['search_account_name'],"<input type='text' name='account_search' id='account_search'>");
  		$this->table->add_row($L['char_name'],			"<input type='text' name='char_name' id='char_name'>");
  		$this->table->add_row($L['searchemail'],		"<input type='text' name='email_search' id='email_search'>");
  		return "<div class='info_msg'>".$L['searchnotice']."</div>".$this->table->generate()."<div id='ajax_result'></div>";
  	}
// ------------------------------------------------------------------------ 
/**
 * bookmars ajax preloader
 *
 * @return void
 * @author NetSoul
 */  	
  	public function ajax()
  	{
  		if (!isset($_SESSION['login'])) {
  			return;
  		}
  		$login=$_SESSION['login'];
  		
  		if (file_exists(".{$login}_bookmark")) {
  			$S=unserialize(file_get_contents(".{$login}_bookmark"));
  			$list='<h2>'.$this->lang['bookmarks'].'</h2>';
  			foreach ($S as $key => $value) {
  				$list.="$value <a href='".VOID."' 
  					onclick=\"$(this).hide();$(this).load('?action=bookmarks&delid=$key');\"><img src='themes/i/delete.png'>
  				</a><br>";
  			}
  			return $list;
  		}
  		
  		return '';
  	}
// ------------------------------------------------------------------------ 
/**
 * Add in bookmarks
 *
 * @return void
 * @author NetSoul
 */  	
  	private function bookmarks()
  	{
  		$login	=	$_SESSION['login'];
  		if(isset($_GET['id'])) $id		=	$this->secure($_GET['id']);
  		if(isset($_GET['name'])) $name	=	$this->secure($_GET['name']);
  		if(isset($_GET['delid'])) $delid=	$this->secure($_GET['delid']);
  		
  		$S=array();
  		if (file_exists(".{$login}_bookmark")) {
  			$S=unserialize(file_get_contents(".{$login}_bookmark"));
  		}  		
  		if (isset($_GET['delid'])) {
  			unset($S[$delid]);
  		}else {
  			$S[$id]="<a href='?action=info&char=$id'>$name</a>";
  		}
  		
  		file_put_contents(".{$login}_bookmark",serialize($S));
  		exit(0);
  	} 
// ------------------------------------------------------------------------     
/*
	TODO сделать больше проверок при выдачи предмета
*/
		function additem()
		{  
			$L = & $this->lang;
			                    
			$this->title=$L['additemtitle'];                                                                               
			$content='';     
			
			if (isset($_POST['id'])) { 
				// start try checking
				try {      
					// проверка количества
					if(isset($_POST['count'])){
						  $count=intval($_POST['count']);
						} else {
						 throw new Exception($L['errcount']);
					}		
					// проверка персонажа или id    
					$char_id=FALSE;
					if (isset($_POST['name']) && $_POST['name']!=='') {
						$char_id=$this->get_serial($this->secure($_POST['name']));
					}elseif (isset($_POST['char_id']) && $_POST['char_id']!=='') {
						$char_id=intval($_POST['char_id']);
					}	else {
						throw new Exception($L['err_not_idorname']);		
					}		 
					 if (!$char_id) {
					 	throw new Exception($L['char_id_nf']);
					 	
					 }
					if ($this->is_online($char_id)) {
						throw new Exception($L['charidgame']);
					}
					$eqiped=0;   
					if (isset($_POST['eqip'])) {
						$eqiped=intval($_POST['eqip']);
					}
					// construct:
					// $eqiped
					// $count   - count items
					//$char_id - id characters
					$slot			=	intval($_POST['slot']);  // slot in db? 
					$item_id	=	intval($_POST['id']); // item number
					if (!$item_id || !$char_id || !$count) {
						throw new Exception("Critical error!");
						
					}
					// connecting to game server
					include(CONF);          
					$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
					echo $insert_query="INSERT INTO inventory (itemId,itemCount,itemOwner,isEquiped,slot ) 
						VALUES($item_id,$count,$char_id,$eqiped,$slot)";
					$update_query="UPDATE inventory SET itemCount=itemCount+$count WHERE itemOwner='$char_id' AND itemId='$item_id' LIMIT 1";
											
					if ($count > 1) {    
						// есть чО?      
						$res=$this->db->sql_query("SELECT * FROM inventory WHERE itemOwner='$char_id' AND itemId='$item_id' LIMIT 1"); 
						if ($this->db->sql_numrows($res)  > 0) { 
							// чОтО есть  
						  $this->db->sql_query($update_query);
						}  else {   
							// нет никуя
						  $this->db->sql_query($insert_query);
						}
						// даём без проверок						
					} else {
						 $this->db->sql_query($insert_query); 
					}
					
					
					$content.="<div class='succes_msg fademe'>".$L['itemadded']."</div>"; 
				} catch (Exception $e) {
					   $content.="<div class='error_msg'>".$e->getMessage()."</div>"; 
				}
      // end try  
		}// end isset 
			$this->table->add_row($L['iditem'],"<input type='text' name='id' id='iid'><a href='".VOID."' onclick=\"$('.fastlist').toggle('fast');\" title='Fast items'><img src='themes/i/wizard.png' title='Fast items'></a>");  
			
			$this->table->add_row('',"<div class='fastlist hide'>
			
			 <a href='".VOID."' onclick=\"add_item('182400001')\">".$this->get_item_name(182400001)."</a><br>
			 <a href='".VOID."' onclick=\"add_item('162000029')\">".$this->get_item_name(162000029)."</a><br>
			 <a href='".VOID."' onclick=\"add_item('162000066')\">".$this->get_item_name(162000066)."</a><br>

			 
			</div>");
			
			$this->table->add_row($L['count'],"<input type='text' name='count' value='1'>");
			$this->table->add_row($L['eqiped'],"<input type='checkbox' value='1' name='eqip'>");		 
			$this->table->add_row($L['slot'],"<input type='text' name='slot' value='0'>");  
			$SIWCH="<a href='".VOID."' onclick=\"\$('.switch').toggle('slow');\">".$L['swidname']."</a>";
			// переключалкО
			$SW_FIELD="<div class='switch'>".$L['char_name']."<br>
				<input type='text' name='name'></div>
			<div class='switch hide'>".$L['char_id']."<br>
				<input type='text' name='char_id'></div>";  
				
			$this->table->add_row($SIWCH,$SW_FIELD); 			
			return $content.="<div class='succes_msg fademe'>".$L['itemnotice']."</div>".
					$this->table->generate()."<input type='submit' value='".$L['additem']."'>";
		}  
// ------------------------------------------------------------------------ 		       
		/**
		 * получение серийника персонажа
		 *
		 * @param string $name 
		 * @return void
		 * @author NetSoul
		 */
		function get_serial($name)
		{                 
			if($this->connect_db!=='gs'){
				include(CONF);          
				$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server); 
				$this->connect_db='gs';
			} 
			$result=$this->db->sql_query("SELECT id FROM players WHERE name='$name' LIMIT 1"); 
			if ($this->db->sql_numrows($result) > 0) {
					 list($id)=$this->db->sql_fetchrow($result);
					return $id;
			}  else {
				return FALSE;
			}          
			
		}  
//  check online char		
		function is_online($char_id)
		{
			include(CONF);          
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);     
			
			$result=$this->db->sql_query("SELECT id FROM players WHERE id='$char_id' AND online='1' LIMIT 1"); 
			
			if ($this->db->sql_numrows($result) > 0) {
				 	return TRUE; 
			}  else {
				return FALSE;
			}          
			
		}
		
	function charlist()
	{
		
		$return='';
		$L = & $this->lang;
		$this->title=$L['menu_char_list'];
		if($this->connect_db!=='gs'){
			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
			$this->connect_db='gs';
		}
		$this->table->clear();
$this->js=<<<JS
\$('#chkey').keyup(function(){
	  var char;
	  char=\$('#chkey').val();
	  ajax_player(char);  
	  return false;
});
JS;
		$chars=range('a','z');
		foreach ($chars as $key => $value) {
			$chars[$key]="<a href='?action=accounts&C=$value' onclick=\"ajax_player('$value');return false;\">$value</a> ";
		}
		$chars[]="<a href='?action=accounts' onclick=\"ajax_player('');return false;\">".$L['all']."</a> <input type='text' id='chkey' name='char' maxlength='1' style='width:10px'>";
		$this->speedbar="<strong>".$this->table->generate($chars).'</strong>';
		$this->table->clear();
		//todo need translate
		$this->table->set_heading($L['char'],$L['account'],$L['level']);
		
		//------------- QUERY BUILD----------------//
		if (isset($_GET['C'])) {
			$char=$this->secure($_GET['C']);
			$char="WHERE name LIKE '$char%'";
			$result=$this->db->sql_query("SELECT exp,name,account_name,account_id FROM `players` $char");
		} else {
			$result=$this->db->sql_query("SELECT exp,name,account_name,account_id FROM `players` LIMIT 0 , 30");
		}
			$tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" id="tablesorter">',
                    'row_start'           => '<tr style="background:#E9E9E9">',
                    'row_alt_start'       => '<tr style="background:#F8F8F8">',
              );
			$this->table->set_template($tmpl);			
		
		if ($this->db->sql_numrows($result) > 0) {
			while (list($exp,$name,$account_name,$account_id)=$this->db->sql_fetchrow($result)) {
				$this->table->add_row(
				"<a href='?action=char&char_name=$name'>$name</a>",
				"<a href='?action=info&char=$account_id'>$account_name</a>",
				$this->get_level($exp)
				);
			}
		}
		if (isset($_GET['ajax'])) exit($this->table->generate());
		/*
			TODO сделать кастомное поле для ввода символа
		*/
		$return.="<div id='ajax'>".$this->table->generate()."</div>";
		return $return;		
	}
	// получение уровня няко няк
	function get_level($EXP='') 
	{
	   if($EXP=='') return false;
	  
	    if ($EXP > 0 && $EXP <= 650) {$level = 1;}
	   else if ($EXP < 650) {$level = 2;}
	   else if ($EXP < 2567) {$level = 3;}
	   else if ($EXP < 6797) {$level = 4;}
	   else if ($EXP < 15490) {$level = 5;}
	   else if ($EXP < 30073) {$level = 6;}
	   else if ($EXP < 52958) {$level = 7;}
	   else if ($EXP < 87894) {$level = 8;}
	   else if ($EXP < 140329) {$level = 9;}
	   else if ($EXP < 213454) {$level = 10;}
	   else if ($EXP < 307558) {$level = 11;}
	   else if ($EXP < 483553) {$level = 12;}
	   else if ($EXP < 608161) {$level = 13;}
	   else if ($EXP < 825336) {$level = 14;}
	   else if ($EXP < 1091985) {$level = 15;}
	   else if ($EXP < 1418170) {$level = 16;}
	   else if ($EXP < 1810467) {$level = 17;}
	   else if ($EXP < 2332547) {$level = 18;}
	   else if ($EXP < 3002259) {$level = 19;}
	   else if ($EXP < 3820081) {$level = 20;}
	   else if ($EXP < 4820228) {$level = 21;}
	   else if ($EXP < 6115322) {$level = 22;}
	   else if ($EXP < 7725199) {$level = 23;}
	   else if ($EXP < 9727123) {$level = 24;}
	   else if ($EXP < 12075781) {$level = 25;}
	   else if ($EXP < 14762522) {$level = 26;}
	   else if ($EXP < 17879938) {$level = 27;}
	   else if ($EXP < 21482201) {$level = 28;}
	   else if ($EXP < 25494737) {$level = 29;}
	   else if ($EXP < 30171209) {$level = 30;}
	   else if ($EXP < 35999532) {$level = 31;}
	   else if ($EXP < 42807774) {$level = 32;}
	   else if ($EXP < 50898898) {$level = 33;}
	   else if ($EXP < 60588305) {$level = 34;}
	   else if ($EXP < 73257434) {$level = 35;}
	   else if ($EXP < 89381899) {$level = 36;}
	   else if ($EXP < 109123921) {$level = 37;}
	   else if ($EXP < 135145762) {$level = 38;}
	   else if ($EXP < 165081925) {$level = 39;}
	   else if ($EXP < 201229895) {$level = 40;}
	   else if ($EXP < 243367815) {$level = 41;}
	   else if ($EXP < 292723295) {$level = 42;}
	   else if ($EXP < 350683175) {$level = 43;}
	   else if ($EXP < 415055544) {$level = 44;}
	   else if ($EXP < 485437946) {$level = 45;}
	   else if ($EXP < 559304956) {$level = 46;}
	   else if ($EXP < 643833129) {$level = 47;}
	   else if ($EXP < 741341640) {$level = 48;}
	   else if ($EXP < 853768081) {$level = 49;}
	   else if ($EXP < 982677974) {$level = 50;}
	   else {$level = 51;}
	   unset($EXP);
	   return $level;
	}
	
	function exp_list() 
	{
	 $level[1]=0;
	 $level[2]=650;
	 $level[3]=2567;
	 $level[4]=6797;
	 $level[5]=15490;
	 $level[6]=30073;
	 $level[7]=52958;
	 $level[8]=87894;
	 $level[9]=140329;
	 $level[10]=213454;
	 $level[11]=307558;
	 $level[12]=483553;
	 $level[13]=608161;
	 $level[14]=825336;
	 $level[15]=1091985;
	 $level[16]=1418170;
	 $level[17]=1810467;
	 $level[18]=2332547;
	 $level[19]=3002259;
	 $level[20]=3820081;
	 $level[21]=4820228;
	 $level[22]=6115322;
	 $level[23]=7725199;
	 $level[24]=9727123;
	 $level[25]=12075781;
	 $level[26]=14762522;
	 $level[27]=17879938;
	 $level[28]=21482201;
	 $level[29]=25494737;
	 $level[30]=30171209;
	 $level[31]=35999532;
	 $level[32]=42807774;
	 $level[33]=50898898;
	 $level[34]=60588305;
	 $level[35]=73257434;
	 $level[36]=89381899;
	 $level[37]=109123921;
	 $level[38]=135145762;
	 $level[39]=165081925;
	 $level[40]=201229895;
	 $level[41]=243367815;
	 $level[42]=292723295;
	 $level[43]=350683175;
	 $level[44]=415055544;
	 $level[45]=485437946;
	 $level[46]=559304956;
	 $level[47]=643833129;
	 $level[48]=741341640;
	 $level[49]=853768081;
	 $level[50]=982677974;

	 return $level;
	}
	
	// просмотр и изменение предметов
	private function items(){
	
		include(CONF);
		$return="<div class='popup hide'>
		<div class='popup_close'><a href='".VOID."' onclick=\"\$('.popup').fadeOut('slow');\"><img src='themes/i/dialog_close.png'></a></div><div id='popupajax'></div></div>";
			
		$this->js="function invenload(qitems){
			\$('#loader').fadeIn('fast');
			\$('#popupajax').load('?action=edititem&item='+qitems+'&ajax=1',function(){\$('#loader').hide('slow');\$(target).slideDown('slow')});
			\$('#loader').fadeOut('slow');
			\$('.popup').fadeIn('slow');
		} 
		$(function() {
				$('.popup').draggable();
			});
		";
		
		$L = & $this->lang;
		$this->title=$L['inven'];
		
		$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
		// указан серийник 
		if (isset($_GET['char_id'])) {
			$char_id=intval($_GET['char_id']);
			// удаление предмета нах
			if(isset($_GET['delete'])){
				$del_id=intval($_GET['delete']);
				$this->db->sql_query("DELETE FROM inventory WHERE itemUniqueId = $del_id LIMIT 1");
				unset($del_id);
			}
			// удаление предмета
		//обновление предмета
		if(isset($_POST['edited'])) {
		   $itemUniqueId=intval($_POST['itemUniqueId']);
			$itemId		=intval($_POST['itemId']);
			$itemCount	=intval($_POST['itemCount']);
			$isEquiped	=intval($_POST['isEquiped']);
			$slot		=intval($_POST['slot']);
			$this->db->sql_query("UPDATE inventory 
			SET  
				itemId =  '$itemId',
				itemCount='$itemCount',
				isEquiped='$isEquiped',
				slot='$slot'
			WHERE 
				itemUniqueId =$itemUniqueId;");
		}	
			$result=$this->db->sql_query("SELECT name,account_name,account_id FROM players WHERE id='$char_id' LIMIT 1"); 
			if ($this->db->sql_numrows($result) > 0) {
					 list($name,$account_name,$account_id)=$this->db->sql_fetchrow($result);
					 $this->speedbar="<p><a href='?action=info&char=$account_id'>$account_name</a> &rarr; <a href='?action=char&char_name=$name'>$name</a> &rarr; $char_id</p>";
			}  else {
				return FALSE;
			} 
			
			
			$result=$this->db->sql_query("SELECT itemUniqueId,itemId,itemCount,isEquiped,slot FROM inventory WHERE itemOwner=$char_id ORDER BY isEquiped DESC");
			$this->table->set_heading($L['item_name'],$L['count'],$L['eqiped'],$L['action']);
			
			while (list($itemUniqueId,$itemId,$itemCount,$isEquiped,$slot)=$this->db->sql_fetchrow($result))
			{
				$action="<a href='".VOID."' onclick=\"invenload('$itemUniqueId')\"><img src='themes/i/edit.png'></a>
				<a href='?action=items&char_id=$char_id&delete=$itemUniqueId' 
					onclick=\"if (!confirm('".$L['confimdelitem']."')) return false;\"><img src='themes/i/delete.png'></a>";
				$this->table->add_row($this->get_item_name($itemId),$itemCount,($isEquiped)?$L['y']:$L['n'],$action);
			}
			return $return.$this->table->generate();
		} else {
			return $this->item_finder();
		}
	}
	
	function item_finder(){
		$content='';
		$itemid='';
		
		if(isset($_POST['item'])){
			$itemid=intval($_POST['item']);
			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);	
			$result=$this->db->sql_query("SELECT itemUniqueId,itemId,itemCount,isEquiped,slot FROM inventory WHERE itemId = $itemid");
			$content="Найдено ".$this->db->sql_numrows($result)." предметов.
			<p><a href='#indev'><img src='themes/i/showcharitems.png'> Показать всех персонажей с данным предметом</a></p>
			<p><a href='#indev'><img src='themes/i/delitem.png'> <font color='red'>Удалить предмет у всех</font></a></p>
			";	
		}
	
		return "Введите код предмета для поиска <input type='text' name='item' value='$itemid'><input type='submit' value='Поиск'><hr>".$content;	
	}
	
	function edititem(){
	
		include(CONF);
		$L = & $this->lang;
		$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
		
		if(isset($_GET['item'])){
			$qitems=intval($_GET['item']);
			$result=$this->db->sql_query("SELECT itemUniqueId,itemId,itemCount,isEquiped,slot FROM inventory WHERE itemUniqueId = $qitems");
				$row=$this->db->sql_fetchrow($result);
				extract($row);
				
				$this->table->add_row('Уникальный номер',"<input name='itemUniqueId' type='hidden' value='$itemUniqueId'>".$itemUniqueId);
				$this->table->add_row($L['iditem'],"<input name='itemId' type='text' value='$itemId'><br>".$this->get_item_name($itemId));
				$this->table->add_row($L['count'],"<input name='itemCount' type='text' value='$itemCount'>");
				$this->table->add_row($L['eqiped'],"<input name='isEquiped' type='text' value='$isEquiped'>");
				$this->table->add_row($L['slot'],"<input name='slot' type='text' value='$slot'>");
				
				exit($this->table->generate()."<input type='submit' name='edited' value='Сохранить'>");			
		}
	}
// получение название предмета	
	private function get_item_name($id){
	if (isset($_SESSION['lang'])) {
		$file_name=$_SESSION['lang']."_items";
	} else $file_name="ru_items";
	
	// если не создан массив
	if($this->items==''){
	// есть ли кешированый объект?
		if (file_exists("./cache/{$file_name}.cache.php")) {
			include("./cache/{$file_name}.cache.php");
			$this->items=$items;
		} else {
			$xml=simplexml_load_file("./xml/{$file_name}.xml");
		
		// создаём массив предметов	
		$this->items=array();
		
		$file="<?php\r\n\$items=array(\r\n";
		foreach ($xml->aionitem  as $key => $value)
		{
			$itid=intval($value['id']);
			$val=$value['name'][0];
			$this->items[$itid]=$val;
			$file.="'$itid'=>\"$val\",\r\n";
		}
		$file.=");";
		file_put_contents("./cache/{$file_name}.cache.php", $file);
	 }
	} 
	// массив есть ищем предмет
		if(isset($this->items[$id])) return $this->items[$id]; else return 'Неизвестный предмет';
	}

/*------------------------------------------------------------------------
 	мощная функция показа абис очков! если записи нет то создаёт её 
*------------------------------------------------------------------------*/
	function abyss($char_id){
	
		if($this->connect_db!=='gs')
		{
			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
			$this->connect_db!='gs';
		}
		
		$result=$this->db->sql_query("SELECT ap FROM abyss_rank WHERE player_id='$char_id' LIMIT 1");	
		
		if ($this->db->sql_numrows($result) > 0) {
			
			$row=$this->db->sql_fetchrow($result);
			return $row['ap'];
			
		} else {
			$this->db->sql_query("INSERT INTO abyss_rank  (player_id,ap) VALUES('$char_id',0)");
		}
		
		return 0;
	}
// ------------------------------------------------------------------------
  	/*
  		is the end
  	*/  	
}

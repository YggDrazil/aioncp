<?php  
/* ------------------------------------------------------------------------

	CP for Aoin
	version 1.0
	Developer www.fdcore.ru
	
	http://code.google.com/p/aioncp/
------------------------------------------------------------------------ */
/**
 * Main controller class
 *
 * @package aioncp
 * @author NetSoul
 */        
define('VOID', 'javascript:void(0);');

class cpanel
{
	private $table; // table class
	private $db; // database class
	public $js=''; // javascript
	public $title=''; // titles
	public $logged=FALSE; // checking auth
	public $speedbar=''; // speedbar for link
	public $lang=array(); // current lang parsed from xml
	private $items=''; //список предметов
	private $connect_db='';
	public $tpl; // квики шаблонизатор
	
	function cpanel()
	{
		$this->tpl		=	new Quicky;
		$this->table	=	new Table;
		
		$this->tpl->template_dir = './themes/'; # Путь корневой папки с шаблонами
		$this->tpl->compile_dir = './compiled/'; # Путь папки с компиляциями шаблонов
		$this->tpl->cache_dir = './cache/'; # Путь до папки кеша.
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
			$this->tpl->assign('step',1);
			$this->tpl->display('install.tpl');  
			exit(0);   
		} 
		$_SESSION['lang']=$_GET['l']; 
		
		$L = & $this->lang; 
                          
		if (!isset($_GET['lic'])) {    
		
			$this->tpl->assign('step',2);
			$this->tpl->display('install.tpl');  
			exit();	
		}

		$error=array();
		if (
			isset($_POST['host']) &&
			isset($_POST['login']) &&
			isset($_POST['password']) &&
			isset($_POST['ls']) &&
			isset($_POST['gs'])
			) {
			$C=0;
			if (!$r=@mysql_connect($_POST['host'],$_POST['login'],$_POST['password'])) {
				$error[]=$L['connecttmysql'];
				$C++;
			}

			if (!$r=@mysql_select_db($_POST['ls'])) {
				$error[]=$L['conls'];
				$C++;
			}
			
			if (!$r=@mysql_select_db($_POST['gs'])) {
				$error[]=$L['congs'];
				$C++;
			}						
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
		list($memory_limit) = sscanf(ini_get('memory_limit'), "%d");
	   	if (!function_exists('simplexml_load_file')) 	$error[]=$L['simplexml'];
 	   	if (!function_exists('mysql_connect')) 			$error[]=$L['mysqlib'];
 	   	if (!function_exists('sqlite_open')) 			$error[]="No SQLite Lib";
 	   	if($memory_limit < 32) 							$error[]=$L['memlim'];
 	   	
		$this->tpl->assign('error',$error);
   		$this->tpl->assign('step',3);
		$this->tpl->display('install.tpl');
		exit();
	}

// ------------------------------------------------------------------------
	/*
		Интернализация ? =)
	*/	
	private function lang_init()
	{
	
			// составляем путь
		if (isset($_SESSION['lang'])) {
			$path =   "./data/".$_SESSION['lang']."_lang.xml"; // основной файл языка
			$md5_file=md5_file($path);
			$cachepath="./cache/$md5_file.cache";// файш кеша
		} else {
			$_SESSION['lang']=DEFAULT_LANG;
			$path =  "./data/".DEFAULT_LANG."_lang.xml";// основной файл языка
			$md5_file=md5_file($path);
			$cachepath="./cache/$md5_file.cache"; // файш кеша
		}
		// проверка кеш файла
		if(file_exists($cachepath)){
			$temp=unserialize(file_get_contents($cachepath));
			$this->lang=$temp;
			unset($temp);
			$this->tpl->assign('lang',$this->lang);
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
         $this->tpl->assign('lang',$this->lang);
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

			try{
				if ($this->check_login($login,$password)) {
					$_SESSION['login']=$login;
					$_SESSION['token']=sha1($login);
					header("location: index.php");
					return;
				} else {
					$this->tpl->assign('error',$this->lang['error_enter']);
				}
			} catch (Exception $e) {
					   $this->tpl->assign('error',$e->getMessage()); 
			}
		}
		$this->tpl->display('login.tpl');		
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
			of a control panel for game server Aion.
				<br>Donate: PayPal email sealnetsoul@gmail.com";
				
				else $return='<div>Спасибо что выбрали нашу разработку панели управления для игрового сервера Aion.<br>
				Мы будем рады если вы пожертвуете немного денег на развитие </div>';
		}
		$this->logged=TRUE;
		if (DEBUG) {
			$alltime=microtime()-START_TIME;
			$pattern="<div id='debug'>Debug mode:<br>Queryes: %d<br>Time db: %s<br>All time: %s<hr>
			<textarea rows='10' cols='30'>POST ".var_export($_POST, 1)."</textarea>
			</div>";
			if(is_object($this->db))
					$debug=sprintf($pattern,$this->db->num_queries,$this->db->total_time_db,$alltime);
			else $debug='';
			
		} else $debug=FALSE;

			$this->tpl->assign('debug',$debug);
			$this->tpl->assign('text',$return);
			$this->tpl->assign('title',$this->title);
			$this->tpl->assign('speedbar',$this->speedbar);
			$this->tpl->assign('js',$this->js);
			$this->tpl->assign('bookmarks',$this->ajax());
			$this->tpl->display('main.tpl');
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
			list($access_level)=$this->db->sql_fetchrow($result);
			if($access_level!==ALLOW_ACL) throw new Exception('Недостаточно прав у аккаунта');
			return TRUE;
		} else {
			
			return FALSE;
		}
	}
// ------------------------------------------------------------------------
	/*
		clear string
		@param raw string
		@return cleared string
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
	    $badchars = array("--","truncate","tbl_","exec",";","'","*","/"," \ ","drop","delete","where"); 
	    foreach($_POST as $value) 
	    { 
		    foreach($badchars as $bad) 
		    {
			    if(strstr(strtolower($value),$bad)<>FALSE) 
			    {
			    	die("Hacking attept! Found text: $bad");
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
				
			case 'favarites':
				return $this->favarites();
				break;	
				
			case 'construct':
				return $this->construct();
				break;	
				
			case 'config':
				return $this->config();
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
		
$this->js.=<<<JS
\$('#chkey').keyup(function(){
	  var char;
	  char=\$('#chkey').val();
	  ajax_chars(char);  
	  return false;
});
JS;
		// проверка наличия кеша
		if(file_exists("./cache/account_chars.cache")){
			$this->speedbar=file_get_contents("./cache/account_chars.cache");
		} else {
			$chars=range('a','z');
			foreach ($chars as $key => $value) {
				$chars[$key]="<a href='?action=accounts&C=$value' class='butPage' onclick=\"ajax_chars('$value');return false;\">$value</a> ";
			}
			$chars[]="<a href='?action=accounts' class='butPage' onclick=\"ajax_chars('');return false;\">".$L['all']."</a> <input type='text' id='chkey' name='char' maxlength='1' style='width:10px'>";
			$sp=implode('&nbsp;',$chars);
			// запись в кеш
			file_put_contents("./cache/account_chars.cache",$sp);
			$this->speedbar=$sp;
		}

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
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" class="uiTable">',
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
		$return.="<div id='ajax'>".$this->table->generate()."</div>";
		return $return;
  	}
// ------------------------------------------------------------------------
  	/*
  		Edit Account
  		
  		account.tpl
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
			$message=array(); // информативные сообщения
			
			// POST data start
			/*------------------------------------------------
				изменение данных аккаунта
			------------------------------------------------*/
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
						$message[]=$L['pass_changed'];
					}
				}
				//----------------- access_level
				if (isset($_POST['access_level']) && $_POST['access_level']!==$row['access_level']) {
					$access_level	=	intval($this->secure($_POST['access_level']));
					$this->db->sql_query("UPDATE account_data SET access_level = '$access_level' WHERE id=$char LIMIT 1;");
					$message[]=$L['acl_change'];
				}
				
				
				//----------------- name
				$name			=$this->secure($_POST['name']);
				if ($name!==$row['name']) {
					$this->db->sql_query("UPDATE account_data SET name = '$name' WHERE id=$char LIMIT 1;");
					include(CONF);
					$db_gs	=new sql_db($db_host, $db_login, $db_password, $db_game_server);			
					$db_gs->sql_query("UPDATE players SET account_name = '$name' WHERE account_id=$char LIMIT 1;");	
					unset($db_gs);
					$message[]=$L['login_ch'];
				}
				//----------------- email
				$email	=$this->secure($_POST['email']);
				
				if ($email!==$row['email']) {
					$this->db->sql_query("UPDATE account_data SET email = '$email' WHERE id=$char LIMIT 1;");
					$message[]=$L['email_ch'];
				}
				if($this->connect_db!=='ls'){		
					include(CONF);		
					$this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server);
					$this->connect_db='ls';
				}
			}
			// POST data end		
			/*------------------------------------------------
					показ данных аккаунта
			------------------------------------------------*/	
			$result=$this->db->sql_query("SELECT * FROM account_data WHERE id=$char");
			if ($this->db->sql_numrows($result) > 0) {
				$row=$this->db->sql_fetchrow($result);
				
				if ($row['activated']=='1') {
					$ACTIV='checked';
				} else $ACTIV='';
				 $this->speedbar="<p><a href='?action=info&char=".$row['id']."'>".$row['name']."</a> &rarr; ".$row['id']."</p>";
				
				$this->tpl->assign('message',$message);
				$this->tpl->assign('active',$ACTIV);
				$this->tpl->assign('row',$row);
				$this->title.=$row['name'];

				
				$ch=$this->my_chars(intval($_GET['char']));
				$this->tpl->assign('char_list',$ch);
				
				if ($ch=$this->my_chars(intval($_GET['char']))) {
					$r.=$list;
				} else $r.="<p>".$L['no_char']."</p>";
				return $this->tpl->fetch('account.tpl');
				
			}
			return $L['acc_nf'];
		}  else {
			return $L['acc_nf'];
		}
  	}
// ------------------------------------------------------------------------
  	/*
  		@return Array  chars from account
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
  		Статистика версия 1.0
  		
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
		$tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" id="tablesorter">',
                    'row_start'           => '<tr style="background:rgba(233,233,233,0.8)">',
                    'row_alt_start'       => '<tr style="background:rgba(248,248,248,0.8)">',
        );
		$this->table->set_template($tmpl);	
		
			
  		$this->speedbar="
  		<a href='?action=statistic&type=total' class='butPage'>".$L['statdata']."</a>
  		<a href='?action=statistic&type=graph' class='butPage'>".$L['graph']."</a>
  		<a href='?action=statistic&type=online' class='butPage'>".$L['online']."</a>
  		<a href='?action=statistic&type=abyss' class='butPage'>".$L['topabyss']."</a>
  		";
  		
  		if(isset($_GET['type'])){
  			$t=$_GET['type'];
  		} else $t='total';
  			
  			if($t=='online'){
  				include(CONF);
	  			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
  				$result=$this->db->sql_query("SELECT COUNT(*) AS count FROM  `players` WHERE  online='1'");
  				list($count_online)=$this->db->sql_fetchrow($result);
	  			$this->table->add_row($L['online'],$this->b($count_online));
	  			 $result=$this->db->sql_query("SELECT COUNT(*) AS count FROM  `players` WHERE  online='0'");
  				list($count_offline)=$this->db->sql_fetchrow($result);
	  			$this->table->add_row($L['offline'],$this->b($count_offline));
	  			$gapi1=$this->chart("$count_online,$count_offline",
	  				sprintf($L['onoff'],$count_online,$count_offline),$L['curronline']);
	  			$this->table->add_row($gapi1);
	  			//TODO вывести список персонажей с листингом
	  			
  			}
  		
  			if($t=='total'){
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
  			}//total
  			
  			if($t=='graph'){
  				$result=$this->db->sql_query("SELECT COUNT(*) as count FROM `account_data` WHERE activated=1");
		  		list($count_active)=$this->db->sql_fetchrow($result);
		  		
		  		$result=$this->db->sql_query("SELECT COUNT(*) as count FROM `account_data` WHERE activated=0");
		  		list($count_unactive)=$this->db->sql_fetchrow($result); 
		  		
		  		$result=$this->db->sql_query("SELECT COUNT(*) as count FROM `account_data`");
		  		list($count_all)=$this->db->sql_fetchrow($result); 	
		  		
		  		include(CONF);
		  		$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
		  	
		  		$result=$this->db->sql_query("SELECT COUNT(*) AS count FROM  `players` WHERE  `gender` =  'MALE'");
		  		list($CountMalePlayers)=$this->db->sql_fetchrow($result);
		  		  		
		   		$result=$this->db->sql_query("SELECT COUNT(*) AS count FROM  `players` WHERE  `gender` =  'FEMALE'");
		  		list($CountFemalePlayers)=$this->db->sql_fetchrow($result);
		
		   		$result=$this->db->sql_query("SELECT COUNT(*) AS count FROM  `players`");
		  		list($CountAllPlayers)=$this->db->sql_fetchrow($result);
  				$gapi1=$this->chart("$count_active,$count_unactive",sprintf($L['actdeac'],$count_active,$count_unactive),$L['accounts']);
	  			$gapi2=$this->chart("$CountMalePlayers,$CountFemalePlayers",sprintf($L['sexchart'],$CountMalePlayers,$CountFemalePlayers),$L['sex']);
  				$this->table->add_row($gapi1);
	 			$this->table->add_row($gapi2);
  			}//graph
  			
  			if($t=='abyss'){
  				include(CONF);
		  		$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
  				$result=$this->db->sql_query(aion::stat_abyss());
  				$this->table->set_heading($L['char_name'],$L['abyss']);
  				while(list($name,$abyss,$id)=mysql_fetch_array($result)){
  					$this->table->add_row("<a href='index.php?action=char&char_id=$id'>$name</a>",$abyss);
  				}
  				
  			}
  		return $this->table->generate();
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
  		Character informations
  		tpl: character_info.tpl
  	*/  	
  	private function char()
  	{	
		$L = & $this->lang;
		$content='';
		// Connect to db
		if($this->connect_db!=='gs'){
			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
			$this->connect_db='gs';	
		}
		// 
		if (isset($_GET['char_id']) || isset($_GET['char_name'])) {
		 
			// edit data!
			 if (isset($_POST['name'])) {     
			 // GET POST DATA
				$upname		=	$this->secure($_POST['name']);  
				$gender		=	$this->secure($_POST['gender']);
				$race		=	$this->secure($_POST['race']); 
				$player_class=$this->secure($_POST['player_class']); 
				
				    
				if(isset($_GET['char_id'])){
					 $char_id=intval($_GET['char_id']); 
					 $WHERE="id='$char_id'";
				}          
				if (isset($_GET['char_name'])) {
					$name=$this->secure($_GET['char_name']);   
					$WHERE="name='$name'";
				}

			 	if($upname!=='' && $gender!=='' && $race!=='' && $player_class!=='') 
			 		$this->db->sql_query(aion::players_update($upname,$gender,$race,$player_class,$WHERE)); 
			 	 
			  if (isset($_GET['char_name'])) {  
				 header("location: ?action=char&char_name=$upname"); 
				 exit();
				}
			 }                                                                        
			// END edit name
			
			// передан id
			if (isset($_GET['char_id'])){
				$char_id=intval($_GET['char_id']);
				$result=$this->db->sql_query(aion::players_id($char_id));	
			}
			// передан ник
			if (isset($_GET['char_name'])) {
				$name=$this->secure($_GET['char_name']);
				$result=$this->db->sql_query(aion::players_name($name));
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
/*------------------------------------------------
	Вывод данных  	
------------------------------------------------*/  
			if ($this->db->sql_numrows($result) > 0) {   
				$row=$this->db->sql_fetchrow($result);
				$this->title=$L['charinfo'].$row['name'];
				 $this->speedbar="<p><a href='?action=info&char=".$row['account_id']."'>
				 ".$row['account_name']."</a> &rarr; <a href='?action=char&char_name=".$row['name']."'>
				 ".$row['name']."</a> &rarr; ".$row['id']."</p>";
				 
				$this->tpl->assign('row',$row);
				$this->tpl->assign('level',$this->get_level($row['exp']));  
				
				if($this->is_online($row['id'])){
					$this->tpl->assign('online',TRUE);
		 		} else{
		 			$this->tpl->assign('online',FALSE);
		 		}
		 		
				$this->tpl->assign('ajax',(bool)isset($_GET['ajax']));
				
				if (isset($_GET['ajax'])) {
					exit($content.$this->tpl->fetch('character_info.tpl').
					"<a href='".VOID."' 
						onclick=\"destroy_div('#AjaxPlace');\" title='".$L['close']."'>
					<img src='themes/i/dialog_close.png'></a>");
				}

				return $this->tpl->fetch('character_info.tpl');
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
		 $this->title=$L['char_data'];
		 if($this->connect_db!=='gs'){
		 	 include(CONF);
			 $this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server); 
			 $this->connect_db='gs';
		}
		// изменение абис очков
		if (isset($_POST['editabyss']) && isset($_GET['char_id'])) {
			$char_id=intval($_GET['char_id']);
			$abyss=intval($_POST['abyss']);
			$this->db->sql_query("UPDATE abyss_rank SET ap = $abyss WHERE player_id = $char_id LIMIT 1");
			$this->tpl->assign('message',sprintf($L['abysschange'],$abyss));
		}
		// изменение уровня персонажа
		if(isset($_POST['editlevel']) && isset($_GET['char_id']))	
		{
			$char_id=intval($_GET['char_id']);
			$level=intval($_POST['level']);
			$this->db->sql_query("UPDATE players SET exp = $level WHERE id = $char_id LIMIT 1");
			$this->tpl->assign('message',$L['levelchange']);			
		}
		// телепортирование
		if (isset($_POST['teleport']) && isset($_GET['char_id'])) {
			$char_id=intval($_GET['char_id']);
			$cordinate=intval($_POST['cordinate']);
			$C=$this->world($cordinate);
			$this->db->sql_query("UPDATE players 
				SET world_id = ".$C['w'].", 
				x = ".$C['x'].",
				y = ".$C['y'].",
				z = ".$C['z']."
				WHERE id = $char_id LIMIT 1");
			$this->tpl->assign('message',$L['teleported']);	
		}
		 // передан id
		 if (isset($_GET['char_id'])){
		 	
		 
		 	// быстрый список *__*
		 	if(file_exists('./cache/level.cache')){
		 		$ll=file_get_contents('./cache/level.cache');	
		 	} else {
		 		$ll='&rarr; <select class="levels" onclick="$(\'.level\').val($(this).val())">'; // Level List
			 	$level=$this->exp_list();
			 	foreach ($level as $key => $value)
			 	{
			 		$value=$value-1;
			 		$ll.="<option value='$value'>$key</option>";
			 	}
			 	$ll.="</select>";
			 	file_put_contents('./cache/level.cache',$ll);
		 	}
		 	
		 	$this->tpl->assign('LevelList',$ll);
		 	
		 	$char_id=intval($_GET['char_id']);
		 	$result=$this->db->sql_query("SELECT * FROM players WHERE id='$char_id' LIMIT 1");
		 // проверка 		
		 	if ($this->db->sql_numrows($result) > 0) {
		 	// парсинг
		 		$row=$this->db->sql_fetchrow($result);
		 		$this->speedbar="<p><a href='?action=info&char=".$row['account_id']."'>".$row['account_name']."</a> &rarr; <a href='?action=char&char_name=".$row['name']."'>".$row['name']."</a> &rarr; $char_id</p>";
		 		
		 		
		 		if($this->is_online($char_id)) $this->tpl->assign('online',TRUE);
		 			else $this->tpl->assign('online',FALSE);
		 		
		 		$this->tpl->assign('level',$this->get_level($row['exp']));
		 		$this->tpl->assign('abyss',$this->abyss($char_id));
		 		$this->tpl->assign('row',$row);
		 		return $this->tpl->fetch('chardata.tpl');		
		 	} else return $L['charnotfound'];
		 }// if	
		 
		 
  	}// func
// ------------------------------------------------------------------------
  	/*
  		поиск
  	*/  	
  	private function search()
  	{
		$L = & $this->lang;
		$tooltip='<div class="toolTip tpWhite clearfix"><p><img src="themes/img/icons/light-bulb-off.png" alt="Tip!" />'.$L['finded'].' %d</p></div>';

		
		if (isset($_GET['type'])) {
			$ACT=$_GET['type'];
			$tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" class="uiTable">',
                    'row_start'           => '<tr style="background:#E9E9E9">',
                    'row_alt_start'       => '<tr style="background:#F8F8F8">',
              );
			$this->table->set_template($tmpl);	
						
/*------------------------------------------------
	Search accounts
------------------------------------------------*/
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
				
				$result=$this->db->sql_query(aion::search_account($account));
				$this->table->set_heading('Account','Last IP','Bookmark');
				
				if ($this->db->sql_numrows($result) > 0) {
					while (list($id,$name,$last_ip)=$this->db->sql_fetchrow($result)) {
						$this->table->add_row("<a href='?action=info&char=$id'>$name</a>",$last_ip,sprintf($FAV,$id,$name));
					}
				} else exit($this->b($L['no_result']));
				exit(sprintf($tooltip,$this->db->sql_numrows($result)).$this->table->generate());				
			}
/*------------------------------------------------
	Search characters
------------------------------------------------*/
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
				
				$result=$this->db->sql_query(aion::search_chars($name));
				$this->table->set_heading('Name','Account');
				
				if ($this->db->sql_numrows($result) > 0) {
					while (list($id,$name,$account_name)=$this->db->sql_fetchrow($result)) {
						$this->table->add_row("<a href='?action=char&char_id=$id'>$name</a>",$account_name);
					}
				} else exit($this->b($L['no_result']));
				exit(sprintf($tooltip,$this->db->sql_numrows($result)).$this->table->generate());					
			}
/*------------------------------------------------
	Search email
------------------------------------------------*/
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
				$this->table->set_heading('Name','Email');
				if ($this->db->sql_numrows($result) > 0) {
					while (list($id,$name,$email)=$this->db->sql_fetchrow($result)) {
						$this->table->add_row("<a href='?action=info&char=$id'>$name</a>",$email);
					}
				} else exit($this->b($L['no_result']));
				exit(sprintf($tooltip,$this->db->sql_numrows($result)).$this->table->generate());					
			}			
		}
		
		return $this->tpl->fetch('search.tpl');
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
  			return 'no bookmarks';
  		}
  		$login=$_SESSION['login'];
  		
  		if (file_exists(".{$login}_bookmark")) {
  			$S=unserialize(file_get_contents(".{$login}_bookmark"));
  			foreach ($S as $key => $value) {
  				$list.="<li>$value</li>";
  			}
  			return $list;
  		}
  		
  		return 'no bookmarks';
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
  	
  	
/*------------------------------------------------
  		Управление закладками
------------------------------------------------*/  	
	function favarites(){
  		if (!isset($_SESSION['login'])) {
  			return 'no bookmarks';
  		}
  		$this->title=$this->lang['bookmarks'];
  		$login=$_SESSION['login'];
  		
  		if (file_exists(".{$login}_bookmark")) {
  			$S=unserialize(file_get_contents(".{$login}_bookmark"));
  			if(count($S) == 0 || !is_array($S)) return 'no bookmarks';
  			
  			foreach ($S as $key => $value) {
  				$this->table->add_row($value,"<a href='".VOID."' 
  					onclick=\"$(this).hide();$(this).load('?action=bookmarks&delid=$key');\"><img src='themes/i/delete.png'>
  				</a>");
  			}
  			return "<div class=\"fields\"><h2>".$this->lang['bookmarks']."</h2>".$this->table->generate()."</div>";
  		}
  		
  		return 'no bookmarks';
	}

// ------------------------------------------------------------------------     
/*
    Выдача предмета
	additems.tpl
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

			$this->tpl->assign('');

			$this->table->add_row('',"<div class='fastlist hide'>
			
			 <a href='".VOID."' onclick=\"add_item('182400001')\">".$this->get_item_name(182400001)."</a><br>
			 <a href='".VOID."' onclick=\"add_item('162000029')\">".$this->get_item_name(162000029)."</a><br>
			 <a href='".VOID."' onclick=\"add_item('162000066')\">".$this->get_item_name(162000066)."</a><br>
			</div>");

            return $this->tpl->fetch('additems.tpl');

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
		
		
/*------------------------------------------------------------------------
	Список персонажей
*------------------------------------------------------------------------*/			
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
$this->js.=<<<JS
\$('#chkey').keyup(function(){
	  var char;
	  char=\$('#chkey').val();
	  ajax_player(char);  
	  return false;
});
JS;
		$chars=range('a','z');
		foreach ($chars as $key => $value) {
			$chars[$key]="<a href='?action=accounts&C=$value' class='butPage' onclick=\"ajax_player('$value');return false;\">$value</a> ";
		}
		$chars[]="<a href='?action=accounts' class='butPage' onclick=\"ajax_player('');return false;\">".$L['all']."</a> <input type='text' id='chkey' name='char' maxlength='1' style='width:10px'>";
		$this->speedbar=implode('&nbsp;',$chars);
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
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" class="uiTable">',
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
		$return.="<div id='ajax'>".$this->table->generate()."</div>";
		return $return;		
	}
/*------------------------------------------------------------------------
		получение уровня няко няк 	 
*------------------------------------------------------------------------*/ 
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
/*------------------------------------------------------------------------
	Преобразование exp.  	 
*------------------------------------------------------------------------*/		
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
	
/*------------------------------------------------------------------------
 	 просмотр и изменение предметов
*------------------------------------------------------------------------*/		
	private function items(){
	
		include(CONF);
		$return="<div class='popup hideme'>
		<div class='popup_close'><a href='".VOID."' onclick=\"\$('.popup').fadeOut('slow');\"><img src='themes/i/dialog_close.png'></a></div><div id='popupajax'></div></div>";
			
		$this->js.="function invenload(qitems){
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
			if(isset($_POST['isEquiped']) && $_POST['isEquiped']==1)
				$isEquiped	=1; else $isEquiped	=0;
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
			$tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" id="tablesorter">',
                    'row_start'           => '<tr style="background:#E9E9E9">',
                    'row_alt_start'       => '<tr style="background:#F8F8F8">',
              );
            // применяем шаблон  
			$this->table->set_template($tmpl);	
			
			// проверка и опреление ссылки для сортировки
			$CURRENT_LINK="?action=items&char_id=$char_id&order=";
			if(isset($_GET['sort']) && $_GET['sort']=='DESC'){
				$SORT='ASC';
			} else $SORT='DESC';
			
			
			$result=$this->db->sql_query("SELECT name,account_name,account_id FROM players WHERE id='$char_id' LIMIT 1"); 
			if ($this->db->sql_numrows($result) > 0) {
					 list($name,$account_name,$account_id)=$this->db->sql_fetchrow($result);
					 $this->speedbar="<p><a href='?action=info&char=$account_id'>$account_name</a> &rarr; <a href='?action=char&char_name=$name'>$name</a> &rarr; $char_id &rarr; ".$L['inven']."</p>";
			}  else {
				return FALSE;
			} 
			
			// сортируем данные
			$_sort='DESC';
			$_order='isEquiped';
			
			if(isset($_GET['order'])){
				if(isset($_GET['sort']) && $_GET['sort']=='DESC'){
					$_sort='DESC';
				} else $_sort='ASC';
				
				if($_GET['order']=='count') $_order='itemCount'; else  $_order='isEquiped';
			}
			$result=$this->db->sql_query("SELECT itemUniqueId,itemId,itemCount,isEquiped,slot FROM inventory WHERE itemOwner=$char_id ORDER BY $_order $_sort");
			
			$this->table->set_heading(
			'#',
				$L['item_name'],
				"<a href='{$CURRENT_LINK}count&sort=$SORT'>".$L['count']."</a>",
				"<a href='{$CURRENT_LINK}eqip&sort=$SORT'>".$L['eqiped']."</a>",
				$L['action']
			);
			
			while (list($itemUniqueId,$itemId,$itemCount,$isEquiped,$slot)=$this->db->sql_fetchrow($result))
			{
				$action="<a href='".VOID."' name='$itemUniqueId' onclick=\"invenload('$itemUniqueId')\"><img src='themes/i/edit.png'></a>
				<a href='?action=items&char_id=$char_id&delete=$itemUniqueId' 
					onclick=\"if (!confirm('".$L['confimdelitem']."')) return false;\"><img src='themes/i/delete.png'></a>";
				$aiondb=(isset($_SESSION['lang']) && $_SESSION['lang']=='en')?'www':'ru';	
				$this->table->add_row("<a class='aion-recipe-icon-medium' href='http://$aiondb.aiondatabase.com/item/$itemId'></a>",$this->get_item_name($itemId),$itemCount,($isEquiped)?$L['y']:$L['n'],$action);
			}
			return $return.$this->table->generate();
		} else {
			return $this->item_finder();
		}
	}
/*-----------------------------------------
	Поиск предметов
-----------------------------------------*/	
	function item_finder(){
		$content='';
		$itemid='';
		$L = & $this->lang;
		
					$tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" class="uiTable">',
                    'row_start'           => '<tr style="background:#E9E9E9">',
                    'row_alt_start'       => '<tr style="background:#F8F8F8">',
              );
			$this->table->set_template($tmpl);
        
		if(isset($_POST['item'])){
			$itemid=intval($_POST['item']);
			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);

			$result=$this->db->sql_query("SELECT i.slot,i.itemOwner, p.name, i.itemUniqueId FROM inventory as i, players as p WHERE i.itemId = $itemid AND i.itemOwner=p.id");
			
			$content="Найдено ".$this->db->sql_numrows($result)." предметов.
			<!--<p><a href='#indev'><img src='themes/i/showcharitems.png'> Показать всех персонажей с данным предметом</a></p>
			<p><a href='#indev'><img src='themes/i/delitem.png'> <font color='red'>Удалить предмет у всех</font></a></p>-->
			";

			while (list($slot,$itemOwner,$name,$itemUniqueId)=$this->db->sql_fetchrow($result))
			{

				$this->table->add_row("<a href='index.php?action=char&char_id=$itemOwner'>$name</a>","<a href='index.php?action=items&char_id=$itemOwner#$itemUniqueId'>".$L['gotoinven']."</a>");
			}

            $content.=$this->table->generate();

		}
	
		return "<form method='post'>".$L['itemsearch']."<input type='text' name='item' value='$itemid'><input type='submit' value='".$L['search']."'></form>
		<hr>".$content."</div>";	
	}
	
/*------------------------------------------------
	Конструктор данных
------------------------------------------------*/
private function construct(){
	$this->title="Конструктор";
	return "in developing :(";
	if(isset($_POST['name'])){
		$name	=	$_POST['name'];
		$type	=	$_POST['type'];
		$key	=	$_POST['key'];
		$value	=	$_POST['value'];
		$query	=	$_POST['query'];
		$db		=	$_POST['db'];
		$vars	=	array();
		
		for($i=0; $i < count($key); $i++){
			$vars[$key[$i]]=$value[$i];
		}
		
		$constructor=array(
			'name'=>$name,
			'type'=>$type,
			'vars'=>$vars,
			'query'=>$query
		);
		if(!file_exists("data/constructor.db")){
			$SQLITE= new SQLiteDatabase("data/constructor.db",0666,&$error) or dir("Ошибка: $error");
			$SQLITE->query("CREATE TABLE constr ( 
				id INT NOT NULL PRIMARY KEY,
				name TEXT NOT NULL,
				type TEXT NOT NULL, 
				vars TEXT, 
				query TEXT NOT NULL
			);");
		} else $SQLITE= new SQLiteDatabase("data/$file_name.db",0666,&$error) or dir("Ошибка: $error");
				
		file_put_contents('data/const.serialize',serialize($constructor));
	}
	
	return $this->tpl->fetch('const.tpl');
}
/*-----------------------------------------
	Изменение предмета
-----------------------------------------*/		
	function edititem(){
	
		include(CONF);
		$L = & $this->lang;
		$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
		$tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" id="tablesorter">',
                    'row_start'           => '<tr style="background:rgba(233,233,233,0.8)">',
                    'row_alt_start'       => '<tr style="background:rgba(248,248,248,0.8)">',
              );
		$this->table->set_template($tmpl);	
			
			
		if(isset($_GET['item'])){
			$qitems=intval($_GET['item']);
			$result=$this->db->sql_query("SELECT itemUniqueId,itemId,itemCount,isEquiped,slot FROM inventory WHERE itemUniqueId = $qitems");
				$row=$this->db->sql_fetchrow($result);
				extract($row);
				
				$this->table->add_row($L['uniqn'],"<input name='itemUniqueId' type='hidden' value='$itemUniqueId'>".$itemUniqueId);
				$this->table->add_row($L['iditem'],"<input name='itemId' class='sText' type='text' value='$itemId'><br>".$this->get_item_name($itemId));
				$this->table->add_row($L['count'],"<input name='itemCount' class='sText' type='text' value='$itemCount'>");
				$this->table->add_row($L['eqiped'],"<input name='isEquiped' class='sCheck' type='checkbox' value='1' ".(($isEquiped)?'checked':'').">");
				$this->table->add_row($L['slot'],"<input name='slot' class='sText' type='text' value='$slot'>");
				
				exit('<form method="post">'.$this->table->generate()."<input type='submit' name='edited' class='editbtn1 butDef' value='".$L['save']."'></form>");			
		}
	}
// получение название предмета	
	public function get_item_name($id){
	
	if (isset($_SESSION['lang'])) {
		$file_name=$_SESSION['lang']."_items";
	} else $file_name=DEFAULT_LANG."_items";
	
	$L = & $this->lang; // link
	
	// check db file
	if(!isset($this->itemsdb)){
	
	if(!file_exists("data/$file_name.db")){
	// create database
		$this->itemsdb= new SQLiteDatabase("data/$file_name.db",0666,&$error) or dir("Ошибка: $error");
		$this->itemsdb->query("CREATE TABLE items ( serial INT NOT NULL PRIMARY KEY , id INT NOT NULL , name TEXT NOT NULL );");
		$xml=simplexml_load_file("./data/{$file_name}.xml");
		
		// создаём массив предметов	
		$this->items=array();
		$i=0;
		foreach ($xml->aionitem as $key => $value)
		{
			$i++;
			$this->itemsdb->query("INSERT INTO items (serial,id,name) VALUES($i,".intval($value['id']).",'".sqlite_escape_string($value['name'][0])."');");
		}
		
	} else{
		$this->itemsdb= new SQLiteDatabase("data/$file_name.db",0666,&$error) or dir("Ошибка: $error");
	}//file_exists
	
	}//isset
	
	
	$ItemName=$this->itemsdb->singleQuery("SELECT name FROM items WHERE id=".intval($id));
	
	if($ItemName){
		return($ItemName);
	} else{
		return $L['erritem'];
	}
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
			$this->db->sql_query("INSERT INTO abyss_rank (player_id,ap) VALUES('$char_id',0)");
		}
		
		return 0;
	}
/*------------------------------------------------------------------------
 	 Метод  вывода координат для телепортирования
*------------------------------------------------------------------------*/	
	function world($id){
		switch ($id) {
		
		//Sanctum - //moveto 110010000 1532 1511 565
			case '1':
				return(array('w'=>110010000,'x'=>1532,'y'=>1511,'z'=>565));
				break;
				
		//Poeta - //moveto 210010000 526 1461 106		
			case '2':
				return(array('w'=>210010000,'x'=>526,'y'=>1461,'z'=>106));
				break;
				
		//Verteron - //moveto 210030000 1339 2195 143		
			case '3':
				return(array('w'=>210030000,'x'=>1339,'y'=>2195,'z'=>143));
				break;
				
		//Eltnen - //moveto 210020000 1487 1466 300		
			case '4':
				return(array('w'=>210020000,'x'=>1487,'y'=>1466,'z'=>300));
				break;
				
		//Theobomos - //moveto 210060000 1400 1550 31		
			case '5':
				return(array('w'=>210060000,'x'=>1400,'y'=>1550,'z'=>31));
				break;
				
		//Interdiktah - //moveto 210040000 1508 1568 112		
			case '6':
				return(array('w'=>210040000,'x'=>1508,'y'=>1568,'z'=>112));
				break;
				
		//Pandaemonium - //moveto 120010000 1268 1428 208		
			case '7':
				return(array('w'=>120010000,'x'=>1268,'y'=>1428,'z'=>208));
				break;
				
		//Ishalgen (Asmodian Starting Zone) - //moveto 220010000 850 2218 267
			case '8':
				return(array('w'=>220010000,'x'=>850,'y'=>2218,'z'=>267));
				break;
				
		//Altgard - //moveto 220030000 1781 1930 261		
			case '9':
				return(array('w'=>220030000,'x'=>1781,'y'=>1930,'z'=>261));
				break;
				
		//Morheim - //moveto 220020000 872 2180 337			
			case '10':
				return(array('w'=>220020000,'x'=>872,'y'=>2180,'z'=>337));
				break;
				
		//Brusthonin - //moveto 220050000 2428 2298 13							
			case '11':
				return(array('w'=>220050000,'x'=>2428,'y'=>2298,'z'=>13));
				break;	
				
		//Beluslan - //moveto 220040000 1967 2533 590		
			case '12':
				return(array('w'=>220040000,'x'=>1967,'y'=>2533,'z'=>590));
				break;
				
		//Ereshuranta (Abyss) - //moveto 400010000 1365 1177 1516			
			case '13':
				return(array('w'=>400010000,'x'=>1365,'y'=>1177,'z'=>1516));
				break;
					
		//No Zone Name - //moveto 300010000 225 276 206
			case '14':
				return(array('w'=>300010000,'x'=>225,'y'=>276,'z'=>206));
				break;
				
		//Karamatis - //moveto 310010000 225 276 206		
			case '15':
				return(array('w'=>310010000,'x'=>225,'y'=>276,'z'=>206));
				break;
		
		//Karamatis (not sure why there are two of these) - //moveto 310020000 225 276 206			
			case '16':
				return(array('w'=>310020000,'x'=>225,'y'=>276,'z'=>206));
				break;
				
		//Aerdina (Abyss Gate) - //moveto 310030000 269 173 204			
			case '17':
				return(array('w'=>310030000,'x'=>269,'y'=>173,'z'=>204));
				break;
				
		//Geranaia (Abyss Gate) - //moveto 310040000 269 173 204		
			case '18':
				return(array('w'=>310040000,'x'=>269,'y'=>173,'z'=>204));
				break;
				
		//Lepharist (Bio Experiment Lab) - //moveto 310050000 191 324 125			
			case '19':
				return(array('w'=>310050000,'x'=>191,'y'=>324,'z'=>125));
				break;	
				
		//Fragment of Darkness - //moveto 310060000 1618 782 1188		
			case '20':
				return(array('w'=>310060000,'x'=>1618,'y'=>782,'z'=>1188));
				break;
				
		//Fragment of Darkness (not sure why there are two of these) - //moveto 310070000 83 238 1222		
			case '21':	
				return(array('w'=>310070000,'x'=>83,'y'=>238,'z'=>1222));
				break;
		
		//Sanctum Underground Arena - //moveto 310080000 276 185 162		
			case '22':	
				return(array('w'=>310080000,'x'=>276,'y'=>185,'z'=>162));
				break;
		
		//Indratu (Castle Indratu) - //moveto 310090000 560 335 1016		
			case '23':	
				return(array('w'=>310090000,'x'=>560,'y'=>335,'z'=>1016));
				break;
		
		//Azoturan (Castle Lehpar) - //moveto 310100000 359 410 1537		
			case '24':	
				return(array('w'=>310100000,'x'=>359,'y'=>410,'z'=>1537));
				break;
		
		//Narsass - //moveto 320010000 225 276 206		
			case '25':	
				return(array('w'=>320010000,'x'=>225,'y'=>276,'z'=>206));
				break;
				
		//Narsass (not sure why there are two of these) - //moveto 320020000 225 276 206		
			case '26':	
				return(array('w'=>320020000,'x'=>225,'y'=>276,'z'=>206));
				break;
		
		//Bregirun (Abyss Gate) - //moveto 320030000 269 175 204				
			case '27':	
				return(array('w'=>320030000,'x'=>269,'y'=>175,'z'=>204));
				break;
				
		//Nidalber (Abyss Gate) - //moveto 320040000 269 175 204
			case '28':	
				return(array('w'=>320040000,'x'=>269,'y'=>175,'z'=>204));
				break;	
				/*
		//Inside of the Sky Temple of Arkanis 320050000 128 133 575	
		    case '29':	
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;
		//Space of Oblivion - //moveto 320060000 1709 807 1226		
			case '30':	
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;
				
		//Space of Destiny - //moveto 320070000 256 252 126		
			case '31':	
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;
		
		//Draupnir - //moveto 320080000 493 600 513 (central control room)			
			case '32':	
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;
				
		//Draupnir - //moveto 320080000 762 431 321 (beritra oracle chamber)			
			case '33':	
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;
				
		//Triniel Underground Arena - //moveto 320090000 276 183 162			
			case '34':	
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;	
		
		//Fire Temple - //moveto 320100000 148 455 142		
			case '35':	
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;
		
		//Alquimia - //moveto 320110000 545 527 200	
			case '36':	
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;
				
		//Secret Prison - //moveto 320120000 454 553 225			
			case '37':	
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;	
		
		//Player Prison 1- //moveto 510010000 229 257 50		
			case '38':	
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;
				
		//Player Prison 2- //moveto 520010000 229 257 50		
			case '39':	
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;
				
		//Test Basic - //moveto 900020000 151 135 20							
			case '40':	
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;
				
		//Test Server - //moveto 900030000 403 254 50			
			case '41':	
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;	
				
		//Test Giant Monster - //moveto 900100000 245 323 20		
			case '42':	
				return(array('w'=>,'x'=>,'y'=>,'z'=>));
				break;	*/											
			default:
				exit('teleport error');
				break;
		} 	
	}
	
	function config(){
	
		$lang	='ru';
		$acl	='1';
		$debug	='false';
		$effect	='false';
		$title	='AionCP 1.0';
		if(count($_POST) ==0) return "Ошибка получения данных";
		
		if(isset($_POST['title'])) $title=addslashes($_POST['title']);
		if(isset($_POST['lang']))  $lang=$this->secure($_POST['lang']);
		if(isset($_POST['debug'])) $debug='true';
		if(isset($_POST['effect']))	$effect='true';
		if(isset($_POST['acl']) && $_POST['acl'] >0) $acl=intval($_POST['acl']);
$file=<<<FILE
<?php\r\n/* ------------------------------------------------------------------------\r\n\tFree CP for Aoin\r\n\tDeveloper www.fdcore.ru\r\n\r\n\thttp://code.google.com/p/aioncp/\r\n------------------------------------------------------------------------ */\r\n// DEBUG MODE (bool)\r\ndefine('DEBUG', $debug);\r\n// Default lang in cp (ru \ end)\r\ndefine('DEFAULT_LANG','$lang');\r\n// jquery effect\r\ndefine('JS_EFFECT',$effect);\r\n// main title postfix\r\ndefine('TITLE','$title');\r\n// work driver !\r\ndefine('DRIVER', 'mysql');\r\n// Access level for login\r\ndefine('ALLOW_ACL', $acl);\r\n
FILE;
		if(is_writable('class/core.php')){
			file_put_contents('class/core.php',$file);
			unset($file);
			return "Настройки сохранены успешно!";
		}
		return "Не удалось сохранить настройки, недостаточно прав на файл class/core.php!";
	}
// ------------------------------------------------------------------------
  	/*
  		is the end
  	*/  	
}

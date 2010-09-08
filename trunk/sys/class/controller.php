<?php  
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
/**
 * Main controller class
 *
 * @package aioncp
 * @author NetSoul
 */        
define('VOID', 'javascript:void(0);');

if(defined('PRO'))
	define('AIONCP_VERSION','AionCP&trade; 1.1 Professional');
else
	define('AIONCP_VERSION','AionCP&trade; 1.1 Freeware');
	
if(!defined('CORE')) exit('hacking attept!');


class aioncp
{
	public $table; // table class
	public $db; // database class
	public $js=''; // javascript
	public $title=''; // titles
	public $logged=FALSE; // checking auth
	public $speedbar=''; // speedbar for link
	public $lang=array(); // current lang parsed from xml
	private $items=''; //список предметов
	private $connect_db='';
	public $tpl; // smarty
	private $const_db='';
    private static $instance=NULL;

	function aioncp()
	{
		$this->tpl		=	new Smarty;
		$this->table	=	new Table;

		$this->tpl->template_dir =TPL_DIR; # Путь корневой папки с шаблонами
		$this->tpl->compile_dir = SYSTEM_PATH.'compiled/'; # Путь папки с компиляциями шаблонов
		$this->tpl->cache_dir = CACHE_PATH; # Путь до папки кеша.
		$this->tpl->plugins_dir[]=SYSTEM_PATH.'plugins/';
		
		if(file_exists(CORE))
		{
		    include_once(CORE);
		       
			if(DEBUG==TRUE)
     			define('START_TIME', microtime());		
		}

       		
		$this->lang_init(); 
		
		if (!file_exists(CONF)) {
			$this->install();
			exit("File ".CONF." is not found.");
		}

		// create ref link for factory
		self::$instance=$this;
		
		$this->cache	=	new Cache();

	} 
	/**
	 * Install AdminCP
	 *
	 * @return void
	 * @author NetSoul
	 */
	function install()
	{  
        $langs=helper::GetAlli18n();
        $all_lang=array();

        foreach($langs as $l){
            include helper::GetLangPath($l);
            $all_lang[$l]=array('lang'=>$lang['lang'],'icon'=>$lang['icon']);

        }
        $this->tpl->assign('lang_list',$all_lang);

		if (!isset($_GET['l'])) {
			$this->tpl->assign('step',1);
			$this->tpl->display('install.tpl');  
			exit(0);   
		}

		$_SESSION['lang']=$this->secure($_GET['l']);
		$this->lang_init();
        
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
			isset($_POST['ls']) &&
			isset($_POST['gs'])
			) {

            try {
                // подключение к базе
                
                if (!$r=@mysql_connect($_POST['host'],$_POST['login'],$_POST['password']))
                        throw new Exception($L['connecttmysql'].": ".mysql_error());
                             
                // выбор логин сервера
                if (!$r=@mysql_select_db($_POST['ls']))
                        throw new Exception($L['conls']);
                
                // выбор гейм сервера
                if (!$r=@mysql_select_db($_POST['gs'])) 
                        throw new Exception($L['congs']);
                 
				if(isset($_POST['encrypt'])){
					$encrypt='TRUE';
					if(isset($_POST['en_key']))
						$en_key=$_POST['en_key'];
					else 
						$en_key='aioncpbyfdcore';
						
				$enc=new Encrypt;
				$enc->set_key($en_key);				
				
				$_POST['host']		=$enc->encode($_POST['host']);
				$_POST['login']		=$enc->encode($_POST['login']);
				$_POST['password']	=$enc->encode($_POST['password']);
				$_POST['ls']		=$enc->encode($_POST['ls']);
				$_POST['gs']		=$enc->encode($_POST['gs']);

				} else {
					$encrypt='FALSE';
				}
				
				                
                $file="<?php\r\n\$db_host='".$_POST['host']."';\r\n\$db_login='".$_POST['login']."';
\$db_password='".$_POST['password']."';\r\n\$db_login_server='".$_POST['ls']."';\r\n\$db_game_server='".$_POST['gs']."';";

                file_put_contents(CONF,$file);

                if ( ! @is_writable(CORE) && file_exists(CORE))
                {
                    throw new Exception($L['file'].CORE.$L['no_writable']);
                }
                
                if ( ! @is_writable(CONF) && file_exists(CONF))
                {
                    throw new Exception($L['file'].CONF.$L['no_writable']);
                }

                if(isset($_POST['acl']) && $_POST['acl'] < 0)
                    throw new Exception($L['noacl']);

                $lang   =   $this->secure($_POST['lang']);
                $acl    =   intval($_POST['acl']);
								
                $file="<?php
/* ------------------------------------------------------------------------
	".AIONCP_VERSION."
	Developer www.fdcore.ru

	http://code.google.com/p/aioncp/
------------------------------------------------------------------------ */
// DEBUG MODE (bool)
define('DEBUG', FALSE);
// Default lang in cp (ru \ en)
define('DEFAULT_LANG','$lang');
// jquery effect
define('JS_EFFECT',TRUE);
// main title postfix
define('TITLE','".AIONCP_VERSION."');
define('DRIVER', 'mysql');
// Access level for login
define('ALLOW_ACL', $acl);
define('ENCRYPT', $encrypt);
define('ENCRYPT_KEY', '$en_key');";

                file_put_contents(CORE,$file);
				copy(LANG_PATH.$_SESSION['lang'].DIRECTORY_SEPARATOR.'markdown.md',CONF_PATH.'note.txt');
                @header('location: index.php');
                exit();

            } catch (Exception $e) {
                    $error[]=$e->getMessage();
                    $this->tpl->assign('error',$error);
            }


		}

		list($memory_limit) = sscanf(ini_get('memory_limit'), "%d");
	   	if (!function_exists('simplexml_load_file')) 	$error[]=$L['simplexml'];
 	   	if (!function_exists('mysql_connect')) 			$error[]=$L['mysqlib'];
 	   	if (!function_exists('sqlite_open')) 			$error[]="No SQLite Lib";
 	   	if($memory_limit < 32) 							$error[]=$L['memlim'];
 	   	if(!is_dir(CONF_PATH)){
 	   		@mkdir(CONF_PATH);
 	   	}
        if (!@is_writable(CONF_PATH))                   $error[]=$L['ditectory'].CONF_PATH.$L['no_writable'];
        
        if (!function_exists('mcrypt_cbc')) 
        		$this->tpl->assign('mcrypt',FALSE);	
        	else  
        		$this->tpl->assign('mcrypt',TRUE);
               
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

			$path =   LANG_PATH.$_SESSION['lang'].DIRECTORY_SEPARATOR.$_SESSION['lang'].".php"; // основной файл языка
		} else {
			// FIX
			if(defined('DEFAULT_LANG')){
				$_SESSION['lang']=DEFAULT_LANG;
				$path =  LANG_PATH.DEFAULT_LANG.DIRECTORY_SEPARATOR.DEFAULT_LANG.".php";// основной файл языка
			} else{
				$_SESSION['lang']='en';
				$path =  LANG_PATH.'en'.DIRECTORY_SEPARATOR."en.php";// основной файл языка			
			}
		}

	   // проверяем наличие файла   
      if (file_exists($path)) {
         
         include($path);

         $this->lang=$lang;

         $this->tpl->assign('lang',$this->lang);

		} else {
            unset($_SESSION['lang']);
			exit("File $path not found!");
		}

        $langs=helper::GetAlli18n();
        $all_lang=array();

        foreach($langs as $l){
            include helper::GetLangPath($l);
            $all_lang[$l]=array('lang'=>$lang['lang'],'icon'=>$lang['icon']);

        }
        $this->tpl->assign('lang_list',$all_lang);
        unset($lang);
	}
	// ------------------------------------------------------------------------
	/*
		main router
	*/
	public function index()
	{
	
		if (isset($_SESSION['login']) && isset($_SESSION['token'])) {
		
			if ($_SESSION['token']==sha1($_SESSION['login'])) {
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

		$this->db->sql_close();
		return;
	}
	
	function check_logins()
	{
		if (isset($_SESSION['login']) && isset($_SESSION['token'])) {
			if ($_SESSION['token']==sha1($_SESSION['login'])) return TRUE; else exit('not access');
		} else exit('You not have access.');
	}	
// ------------------------------------------------------------------------
	/*
		show login form for auth in cp
	*/	
	private function show_login()
	{
		$this->title.=$this->lang['authorize'];
		$return='';
		
		if(isset($_GET['action']) && $_GET['action']=='ajax_login_check') {
			$this->ajax_login_check();
			return;
		}
		 
		if($this->connect_db!=='ls'){
			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server); 
			$this->connect_db='ls';
		}
			
		if (isset($_POST['login'])) {
			$login		=	$this->secure($_POST['login']);
			$password	=	$this->secure($_POST['password']);

			try{
				if ($id=$this->check_login($login,$password)) {
					$_SESSION['login']=$login;
					$_SESSION['token']=sha1($login);
					
					// совместимость с Soni AionWEB
					$_SESSION['admin']=ALLOW_ACL;
					$_SESSION['player'] =$login;
					$_SESSION['plid'] =$id;
					@header("location: index.php");
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
	
	function ajax_login_check()
	{
		if($this->connect_db!=='ls'){
			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server); 
			$this->connect_db='ls';
		}
			
		if (isset($_POST['login'])) {
			$login		=	$this->secure($_POST['login']);
			$password	=	$this->secure($_POST['password']);

			try{
				if ($id=$this->check_login($login,$password)) {
					$_SESSION['login']=$login;
					$_SESSION['token']=sha1($login);
					
					// совместимость с Soni AionWEB
					$_SESSION['admin']=ALLOW_ACL;
					$_SESSION['player'] =$login;
					$_SESSION['plid'] =$id;	
					echo 'y';
					
				} else  echo $this->lang['error_enter'];
				
			} catch (Exception $e) {
					echo $e->getMessage();
			}
		} else echo 'n';
		
		exit();
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
        if(file_exists(USER_PATH.'constr_list.html')){
            $list=file_get_contents(USER_PATH.'constr_list.html');
            $this->tpl->assign('const_list',$list);

        }
		if (isset($_GET['action'])) {
			$return.=$this->action($_GET['action']);
		} else {
            include CLASS_PATH."markdown.php";
            
            if(file_exists(CONF_PATH.'note.txt')){
            
            	$note=file_get_contents(CONF_PATH.'note.txt');
            	$this->tpl->assign('note',markdown($note));
            	         
            } else $this->tpl->assign('note','');
			
			$return=$this->tpl->fetch('note.tpl'); 
			$return.="<hr>Cache Space: ".helper::decodeSize(helper::dirSize(USER_PATH));  
		}
		$this->logged=TRUE;
		
		if(defined('DEBUG') && DEBUG==TRUE){
			$alltime=microtime()-START_TIME;
			$pattern="<div id='debug'>Debug mode:<br>Query: %d<br>Time db: %s<br>All time: %s<br>";
			if(count($_POST)>0) $pattern.="<textarea rows='10' cols='30'>POST ".var_export($_POST, 1)."</textarea>";
			$pattern.="</div>";
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
			list($access_level,$id)=$this->db->sql_fetchrow($result);
			
			//fix #4
			if($access_level < ALLOW_ACL) throw new Exception($this->lang['no_access']);
			return $id;
		} else {
			return false;
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
	    return helper::secure($check_string);
	}
// ------------------------------------------------------------------------ 		
	function db_mssql_check_xss () {

        if(isset($_GET['action']) && $_GET['action']=='construct') return;

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
        if(isset($_GET['action']) && $_GET['action']=='construct') return;
	    $badchars = array("truncate","tbl_","exec","drop","delete","where"); 
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
  		if(substr($ACT,0,1)=='_') return 'Access attept!';
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
 				
  		}
        
        if(method_exists($this, $ACT))
              return $this->$ACT();

		// Proffessional version check [pro file]
        if(defined('PRO'))
        {
			// create new pro controller
			try {
				
	        	$pro=new proaioncp;
	        	return $pro->index($ACT);
					
			} catch (Exception $e) {
				return $e->getMessage();
			}

        }

        return 'not action';
  	}	
// ------------------------------------------------------------------------
  	/*
  		Вывод списка аккаунтов
  	*/  	
  	function accounts_list()
  	{
		$return='';
		$total=50; // per page
		$L = & $this->lang;
		$this->title=$L['menu_acclist'];
		if($this->connect_db!=='gs') {
			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
			$this->connect_db='gs';
		}

	
		// проверка наличия кеша
		if(file_exists(CACHE_PATH."account_chars.cache")){
			$this->speedbar=file_get_contents(CACHE_PATH."account_chars.cache");
		} else {
			$chars=range('a','z');
			foreach ($chars as $key => $value) {
				$chars[$key]="<a href='?action=accounts&C=$value' class='butPage' onclick=\"ajax_chars('$value');return false;\">$value</a> ";
			}
			$chars[]="<a href='?action=accounts' class='butPage' onclick=\"ajax_chars('');return false;\">".$L['all']."</a> <input type='text' id='chkey' name='char' maxlength='3' style='width:20px'>";
			$sp=implode('&nbsp;',$chars);
			// запись в кеш
			if(!is_dir(CACHE_PATH)){
				mkdir(CACHE_PATH);
			}
			if(is_dir(CACHE_PATH)) file_put_contents(CACHE_PATH."account_chars.cache",$sp);
			$this->speedbar=$sp;
		}

		
		//------------- QUERY BUILD----------------//
		if (isset($_GET['C'])) {
			// account selected
			$char=$this->secure($_GET['C']);
			$pagechar=$this->secure($_GET['C']);
			$char="WHERE account_name LIKE '$char%'";
			
			//pagination
			if(isset($_GET['page'])){
				$page_offset=(intval($_GET['page'])*$total);
				$page_offset_q=" LIMIT $page_offset,$total";
				
			} else $page_offset_q="LIMIT 0 , $total";
		} else {
			$char=''; 
			$pagechar='';
			$page_offset_q="LIMIT 0 , $total";
		}
		
		$result=$this->db->sql_query("SELECT name,account_name,account_id FROM `players` $char $page_offset_q");
					
		// check num rows
		if ($this->db->sql_numrows($result) > 0) {
			$this->tpl->assign('rows',$this->db->sql_fetchrowset($result));
		} else $this->tpl->assign('rows',FALSE);
		
		// pagination
		$page=(isset($_GET['page']))?intval($_GET['page']):1;
		// get total rows
		$result=$this->db->sql_query("SELECT null FROM `players` $char");
		$pagination=helper::pagination($this->db->sql_numrows($result),'?action=accounts&C='.$pagechar.'&page=',$total,5,$page);
		
		$this->tpl->assign('pagination',$pagination);
		if (isset($_GET['ajax'])) exit($this->tpl->fetch('accounts_list.tpl'));
		$return.=$this->tpl->fetch('accounts_list.tpl');
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
                    $this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server);
                    $result=$this->db->sql_query("SELECT * FROM account_data WHERE name='$name'");
                    if ($this->db->sql_numrows($result) == 0) {
                        $this->db->sql_query("UPDATE account_data SET name = '$name' WHERE id=$char LIMIT 1;");
                        include(CONF);
                        $db_gs	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
                        $db_gs->sql_query("UPDATE players SET account_name = '$name' WHERE account_id=$char;");
                        unset($db_gs);
                        $message[]=$L['login_ch'];
                    } else $message[]='Account alredy exits';

					
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
            $this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server);
            
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
  		$LANG=$_SESSION['lang'];

  		$this->title=$L['stat_title'];
        $cacheat="<div class='toolTip tpBlue clearfix'>
  			<p><img src='".TPL_URL."img/icons/light-bulb-off.png' />{$L['cachedin']} ".date('Y.m.d H:i')."</p>
  			<a class='close' title='Close'></a>
  		</div>";
  
  		if($this->connect_db!=='ls'){
			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server); 
			$this->connect_db='ls';
		} 	
			$tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" class="uiTable">',
                    'row_start'           => '<tr style="background:#E9E9E9">',
                    'row_alt_start'       => '<tr style="background:#F8F8F8">',
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

        // Cache stat lang and get types
        if($statistic=$this->cache->get($LANG . $t,1))
                return $statistic;


  			if($t=='online'){
  				include(CONF);
	  			// показать всех кто онлайн
                if(isset($_GET['show_all']) && $_GET['show_all']=='y') $show=TRUE; else $show=FALSE;

                // cache lang type shows
                if($statistic=$this->cache->get($LANG . $t . intval($show),1))
                return $statistic;

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

                $graph=$this->table->generate();
                $this->table->clear();
                

                $tmpl = array (
                        'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" class="uiTable">',
                        'row_start'           => '<tr style="background:#E9E9E9">',
                        'row_alt_start'       => '<tr style="background:#F8F8F8">',
                  );
                $this->table->set_template($tmpl);
                $this->table->set_heading('#',$L['name'],$L['account']);
                 // если онлайн больше 30 персонажей
                if($count_online > 30 && $show==FALSE){
                    $result=$this->db->sql_query("SELECT id,name,account_name,account_id FROM  `players` WHERE  online='1' LIMIT 30");
                    $count=1;
                    while (list($id,$name,$account_name,$account_id)=$this->db->sql_fetchrow($result)){
                        $this->table->add_row($count,"<a href='?action=char&char_id=$id'>$name</a>","<a href='?action=info&char=$account_id'>$account_name</a>");
                        $count++;

                    }
                } else{
                    $result=$this->db->sql_query("SELECT id,name,account_name,account_id FROM  `players` WHERE  online='1'");
                    $count=1;
                    while (list($id,$name,$account_name,$account_id)=$this->db->sql_fetchrow($result)){
                        $this->table->add_row($count,"<a href='?action=char&char_id=$id'>$name</a>","<a href='$account_id'>$account_name</a>");
                        $count++;
                    }
                }
                $graph.=$this->table->generate();
                if($count_online > 30 && $show==FALSE){
                    $graph.="<a href='?action=statistic&type=online&show_all=y'>[show all {$count_online}]</a>";

                }
                $this->cache->set(array($LANG . $t . intval($show)=>$cacheat.$graph), array('statistic',$t), 3600);
                return $graph;
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
  				$CMP=round(($CountAllPlayers-$CountMalePlayers)/100);
  				$CFP=round(($CountAllPlayers-$CountFemalePlayers)/100);
	  			$gapi2=$this->chart("$CMP,$CFP",sprintf($L['sexchart'],$CountMalePlayers,$CountFemalePlayers),$L['sex']);
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

        $this->cache->set(array($LANG . $t=>$cacheat.$this->table->generate()), array('statistic',$t), 3600);
        
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
			// update title
			if (isset($_POST['title_id'])) {
				
				$title_id=intval($_POST['title_id']);
				
				$tre=$this->db->sql_query(sprintf("SELECT null FROM player_titles WHERE player_id = %d",$char_id));
				
	 			if ($this->db->sql_numrows($tre) > 0 && isset($char_id) && $char_id > 0) {  
	 				$this->db->sql_query("UPDATE player_titles SET title_id=$title_id WHERE player_id=".$char_id);
	 						
	 			} else $this->db->sql_query("INSERT INTO player_titles (title_id,player_id) VALUES($title_id,$char_id)");
	 			 
					
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

                // char_name get fix
                @$_GET['char_id']=$row['id'];

				if($this->is_online($row['id'])){
					$this->tpl->assign('online',TRUE);
		 		} else{
		 			$this->tpl->assign('online',FALSE);
		 		}
		 		
		 		$result=$this->db->sql_query("SELECT * FROM player_titles WHERE player_id=".$row['id']);	
		 			if ($this->db->sql_numrows($result) > 0) {  
		 				$row2=$this->db->sql_fetchrow($result);
		 				$this->tpl->assign('player_title',helper::GetTitle($row2['title_id']));		
		 			} else $this->tpl->assign('player_title','');
		 		
				$this->tpl->assign('ajax',(bool)isset($_GET['ajax']));
				
				if (isset($_GET['ajax'])) 
					exit($content.$this->tpl->fetch('character_info.tpl'));
				

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
		 	if(file_exists(CACHE_PATH.'level.cache')){
		 		$ll=file_get_contents(CACHE_PATH.'level.cache');	
		 	} else {
		 		$ll='&rarr; <select class="levels">'; // Level List
			 	$level=$this->exp_list();
			 	foreach ($level as $key => $value)
			 	{
			 		$value=$value-1;
			 		$ll.="<option value='$value'>$key</option>";
			 	}
			 	$ll.="</select>";
			 	file_put_contents(CACHE_PATH.'level.cache',$ll);
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
  		$count_row=0;
		$L = & $this->lang;
		$tooltip='<div class="toolTip tpWhite clearfix"><p><img src="'.TPL_URL.'img/icons/light-bulb-off.png" alt="Tip!" />'.$L['finded'].' %d</p></div>';

		
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
				
				$result=$this->db->sql_query(aion::search_account($account));
				$this->table->set_heading($L['account'],$L['last_ip']);
				
				if ($this->db->sql_numrows($result) > 0) {
					
					while (list($id,$name,$last_ip)=$this->db->sql_fetchrow($result)) {
						$count_row++;
						$this->table->add_row("<a href='?action=info&char=$id'>$name</a>",$last_ip);
						if($count_row > 500) break;
					}
				} else exit($this->b($L['no_result']));
				print(sprintf($tooltip,$this->db->sql_numrows($result)).$this->table->generate());	
				if($count_row > 500) echo "<div class='toolTip tpBlue clearfix'>
  			<p><img src='".TPL_URL."img/icons/light-bulb-off.png' />".$this->lang['securereturned']."</p>
  			<a class='close' title='Close'></a></div>";		
  				exit();								
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
				$this->table->set_heading($L['name'],$L['account']);
				
				if ($this->db->sql_numrows($result) > 0) {
					while (list($id,$name,$account_name)=$this->db->sql_fetchrow($result)) {
						$count_row++;
						$this->table->add_row("<a href='?action=char&char_id=$id'>$name</a>",$account_name);
						if($count_row > 500) break;
					}
				} else exit($this->b($L['no_result']));
				print(sprintf($tooltip,$this->db->sql_numrows($result)).$this->table->generate());
				if($count_row > 500) echo "<div class='toolTip tpBlue clearfix'>
  			<p><img src='".TPL_URL."img/icons/light-bulb-off.png' />".$this->lang['securereturned']."</p>
  			<a class='close' title='Close'></a></div>";		
  				exit();										
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
				$this->table->set_heading('Login','Email');
				if ($this->db->sql_numrows($result) > 0) {
					while (list($id,$name,$email)=$this->db->sql_fetchrow($result)) {
						$count_row++;
						$this->table->add_row("<a href='?action=info&char=$id'>$name</a>",$email);
						if($count_row > 500) break;
					}
				} else exit($this->b($L['no_result']));
				
				print(sprintf($tooltip,$this->db->sql_numrows($result)).$this->table->generate());
				
				if($count_row > 500) echo "<div class='toolTip tpBlue clearfix'>
  			<p><img src='".TPL_URL."img/icons/light-bulb-off.png' />".$this->lang['securereturned']."</p>
  			<a class='close' title='Close'></a></div>";		
  				exit();							
			}
 /*------------------------------------------------
	ip email
------------------------------------------------*/
			if ($ACT=='ip_search') {

				if($this->connect_db!=='ls'){
					include(CONF);
					$this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server);
					$this->connect_db='ls';
				}
				$email=$this->secure($_GET['ip_search']);
				if ($email=='') {
					exit($this->b($L['no_result']));
				}
				
				$result=$this->db->sql_query(aion::ip_email($email));
				
				$this->table->set_heading($L['account'],'IP');
				
				if ($this->db->sql_numrows($result) > 0) {
					
					
					while (list($id,$name,$ip)=$this->db->sql_fetchrow($result)) {
						$count_row++;
						$this->table->add_row("<a href='?action=info&char=$id'>$name</a>",$ip);
						if($count_row > 500) break;
					}
					
				} else exit($this->b($L['no_result']));
				print(sprintf($tooltip,$this->db->sql_numrows($result)).$this->table->generate());
				if($count_row > 500) echo "<div class='toolTip tpBlue clearfix'>
  			<p><img src='".TPL_URL."img/icons/light-bulb-off.png' />".$this->lang['securereturned']."</p>
  			<a class='close' title='Close'></a></div>";
				exit();
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
  			return $this->lang['no_bookm'];
  		}
  		if(!function_exists('sqlite_query')) return $this->lang['liberror'];
  		
  		$login=$_SESSION['login'];
  		//@TODO need cache this 
  		
  		if($list=$this->cache->get("bookmark_$login",1))
  			return $list;
  			
  		$db     =   $this->init_favdb();
  		$result=$db->query("SELECT * FROM bookmarks WHERE login='$login' AND type='char'");
  		
  		if($result->numRows() > 0) {
  			 foreach ($result as $key => $value){
  			 	$list.="<li><a href='?action=info&char=$value[serial]'>$value[name]</a></li>";
  			 }

			$this->cache->set(array("bookmark_$login"=>$list), array('list',$login), 3600);
  			return $list;
  		}
  		
  		return $this->lang['no_bookm'];
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
        if(!isset($_SESSION['login'])) return;
  		$login	=	$_SESSION['login'];
		
		
  		if(isset($_GET['id']))      $id		=	intval($_GET['id']);
  		if(isset($_GET['name']))    $name	=	$this->secure($_GET['name']);
  		if(isset($_GET['delid']))   $delid  =	intval($_GET['delid']);

        // add char
        if(isset($id)  && $id > 0){
            
            $db     =   $this->init_favdb();
            $result=$db->query("SELECT * FROM bookmarks WHERE serial=$id AND name='$name'");
            if($result->numRows() > 0){
            	echo "\$('.addfav').fadeOut('slow').fadeIn('slow');";
            } else {
            	$res    =   $db->query("INSERT INTO bookmarks (serial,type,login,name) VALUES($id,'char','$login','$name')");
            	echo "\$('.addfav').fadeOut('slow');";
            }
            
        }
        // delete char
        if(isset($delid) && $delid > 0){
            $db     =   $this->init_favdb();
            $db->query("DELETE FROM bookmarks WHERE id=$delid");
            echo "\$('#row$delid').hide();";
            

        }
         $this->cache->delete_tag(array('list'));
  		exit(0);
  	} 
  	
  	
/*------------------------------------------------
  		Управление закладками
------------------------------------------------*/  	
	function favarites(){
	
  		if (!isset($_SESSION['login'])) {
  			return $this->lang['no_bookm'];
  		}
  		if(!function_exists('sqlite_query')) return $this->lang['liberror'];
  		
  		$this->title=$this->lang['bookmarks'];

  		$login  =   $_SESSION['login'];
  		$db     =   $this->init_favdb();

        $result=$db->query("SELECT * FROM bookmarks WHERE login='$login' AND type='char'");

        if($result->numRows() > 0) {
            
            $this->tpl->assign('rows',$result);
            
            return $this->tpl->fetch('favarites.tpl');

        } else return $this->lang['no_bookm'];

	}
    function init_favdb(){
        if(!function_exists('sqlite_query')) return;

        if(!file_exists(CONF_PATH.'profile.db')){
            $db=new SQLiteDatabase(CONF_PATH.'profile.db',0666,$error) or die($error);

            $query="CREATE TABLE bookmarks(
            id INTEGER PRIMARY KEY,
            name,
            serial INTEGER,
            type,
            login
        );";
            $db->query($query);


        } else {
            $db=new SQLiteDatabase(CONF_PATH.'profile.db',0666,$error) or die($error);
        }
            return $db;
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
			$message=array();
			
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
					
					
					$message[]=$L['itemadded']; 
				} catch (Exception $e) {
					$message[]=$e->getMessage(); 
				}
      // end try  
		}// end isset 
			
			$this->tpl->assign('message',$message);
         	return $this->tpl->fetch('additems.tpl');
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
		$total=50; // per page
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
		
		//------------- QUERY BUILD----------------//
		if (isset($_GET['C'])) {
			$char=$this->secure($_GET['C']);
			$pagechar=$this->secure($_GET['C']);
			$char="WHERE name LIKE '$char%'";
			
			//pagination
			if(isset($_GET['page'])){
				$page_offset=(intval($_GET['page'])*$total);
				$page_offset_q=" LIMIT $page_offset,$total";
				
			} else $page_offset_q="LIMIT 0 , $total";
			
		}  else {
			$char='';
			$pagechar='';
			$page_offset_q="LIMIT 0 , $total";
		}
			$result=$this->db->sql_query("SELECT exp,name,account_name,account_id FROM `players` $char $page_offset_q");
			
					
		// check num rows
		if ($this->db->sql_numrows($result) > 0) {
			$this->tpl->assign('rows',$this->db->sql_fetchrowset($result));
		} else $this->tpl->assign('rows',FALSE);
		
		
		
		// pagination
		$page=(isset($_GET['page']))?intval($_GET['page']):1;
		// get total rows
		$result=$this->db->sql_query("SELECT null FROM `players` $char");
		$pagination=helper::pagination($this->db->sql_numrows($result),'?action=charlist&C='.$pagechar.'&page=',$total,5,$page);
		
		$this->tpl->assign('pagination',$pagination);
		if (isset($_GET['ajax'])) exit($this->tpl->fetch('charlist.tpl'));
		$return.=$this->tpl->fetch('charlist.tpl');
		return $return;		
	}
/*------------------------------------------------------------------------
		получение уровня няко няк 	 
*------------------------------------------------------------------------*/ 
	function get_level($EXP='') 
	{
	   return helper::get_level($EXP);
	}
/*------------------------------------------------------------------------
	Преобразование exp.  	 
*------------------------------------------------------------------------*/		
	function exp_list() 
	{
        return helper::exp_list();
	}
	
/*------------------------------------------------------------------------
 	 просмотр и изменение предметов
*------------------------------------------------------------------------*/		
	private function items(){
	
		include(CONF);
		$return="<div class='popup hideme boxshadow'>
		<div class='popup_close'><a href='".VOID."' onclick=\"\$('.popup').fadeOut('slow');\"><img src='".TPL_URL."i/dialog_close.png'></a></div><div id='popupajax'></div></div>";
			
		$this->js.="function invenload(qitems){
			\$('#loader').fadeIn('fast');
			\$('#popupajax').load('?action=edititem&item='+qitems+'&ajax=1',function(){\$('#loader').hide('slow');\$(target).slideDown('slow')});
			\$('#loader').fadeOut('slow');
			\$('.popup').fadeIn('slow');
		} 
		$(function() {
				\$('.popup').draggable();
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
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" class="uiTable">',
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
			$_where='';
			
			if(isset($_GET['order'])){
				if(isset($_GET['sort']) && $_GET['sort']=='DESC'){
					$_sort='DESC';
				} else $_sort='ASC';
				
				if($_GET['order']=='count') $_order='itemCount'; else  $_order='isEquiped';
			}
			
			if(isset($_GET['loc'])){
				
				if (is_numeric($_GET['loc'])) {
					$_where.="AND itemLocation=".intval($_GET['loc']);
				}
				
			}
			$result=$this->db->sql_query("SELECT itemUniqueId,itemId,itemCount,isEquiped,slot FROM inventory WHERE itemOwner=$char_id $_where ORDER BY $_order $_sort");
			
			$this->table->set_heading(
			'#',
				$L['item_name'],
				"<a href='{$CURRENT_LINK}count&sort=$SORT'>".$L['count']."</a>",
				"<a href='{$CURRENT_LINK}eqip&sort=$SORT'>".$L['eqiped']."</a>",
				$L['action']
			);
			
			while (list($itemUniqueId,$itemId,$itemCount,$isEquiped,$slot)=$this->db->sql_fetchrow($result))
			{
				$action="<a href='".VOID."' name='$itemUniqueId' onclick=\"invenload('$itemUniqueId')\"><img src='".TPL_URL."i/edit.png'></a>
				<a href='?action=items&char_id=$char_id&delete=$itemUniqueId' 
					onclick=\"if (!confirm('".$L['confimdelitem']."')) return false;\" title='Delete $itemUniqueId'><img title='Delete $itemUniqueId' src='".TPL_URL."i/delete.png'></a>
                <a href='?action=items&do=showall&item=$itemId' target='_blank' title='Find all $itemId'><img title='Find all $itemId' src='".TPL_URL."i/showcharitems.png'></a>";

				$this->table->add_row(
                        "<a class='aion-recipe-icon-medium' href='".$L['aiondatabase']."item/$itemId'></a>",
                        $this->get_item_name($itemId),$itemCount,($isEquiped)?$L['y']:$L['n'],$action);
			}
			
			$result=$this->db->sql_query("SELECT DISTINCT itemLocation FROM inventory");
			$_loc='Размещение предмета: ';
			$_loc.="<a href='?action=items&char_id=$char_id' class='butPage'>Все</a>&nbsp;&nbsp;";
			while (list($itemLocation)=$this->db->sql_fetchrow($result)){
				$_loc.="<a href='?action=items&char_id=$char_id&loc=$itemLocation' class='butPage'>$itemLocation</a>&nbsp;&nbsp;";
			}
			return $return.$_loc.$this->table->generate();
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
		$this->title=$L['itemwork'];
        
		$tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" class="uiTable">',
                    'row_start'           => '<tr style="background:#E9E9E9">',
                    'row_alt_start'       => '<tr style="background:#F8F8F8">',
         );
        $this->table->set_template($tmpl);
        
		if(isset($_POST['item'])){
			$itemid=intval($_POST['item']);
            if($itemid!==0){
                include(CONF);
                $this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
                $result=$this->db->sql_query("SELECT i.slot,i.itemOwner, p.name, i.itemUniqueId FROM inventory as i, players as p WHERE i.itemId = $itemid AND i.itemOwner=p.id");
                $this->tpl->assign('total',$this->db->sql_numrows($result));
                $this->tpl->assign('itemlink',"<a class='aion-recipe-full-large' href='".$L['aiondatabase']."/item/$itemid'></a>");
           }
		}

        if(isset($_GET['do'])){

            // показ списка персонажей с данным предметом
            if($_GET['do']=='showall'){
                $itemid=intval($_GET['item']);
                if($itemid!==0){
                    include(CONF);
                    $this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
                    $result=$this->db->sql_query("SELECT i.slot,i.itemOwner, p.name, i.itemUniqueId FROM inventory as i, players as p WHERE i.itemId = $itemid AND i.itemOwner=p.id");

                   
                    if($this->db->sql_numrows($result) >0){
                        // думаю 1000 персов слишком много
                       if($this->db->sql_numrows($result) < 1000){
                         // данные для отображения
                         $this->tpl->assign('total',$this->db->sql_numrows($result));
                         $this->tpl->assign('itemlink',"<a class='aion-recipe-full-large' href='".$L['aiondatabase']."/item/$itemid'></a>");
                        while (list($slot,$itemOwner,$name,$itemUniqueId)=$this->db->sql_fetchrow($result))
                        {

                            $this->table->add_row("<a href='index.php?action=char&char_id=$itemOwner' target='_blank'>$name</a>","<a href='index.php?action=items&char_id=$itemOwner#$itemUniqueId' target='_blank'>".$L['gotoinven']."</a>");
                        }
                        // готовый результат
                        $this->tpl->assign('result',$this->table->generate());
                      } else $this->tpl->assign('message',$L['toobig']);
                    } else $this->tpl->assign('message',$L['itemsnotfound']);

                } else $this->tpl->assign('message',$L['itemsnotfound']);

            }//showall

            // удаление предмета у всех
            if($_GET['do']=='delall'){
                $itemid=intval($_GET['item']);
                if($itemid!==0){
                    $this->db->sql_query("DELETE FROM inventory WHERE itemId = $itemid");
                    $this->tpl->assign('message',$L['itemsdeleted']);
                }
                
            }//dellall
        } // do
        
        return $this->tpl->fetch('itemfinder.tpl');
		return "<form method='post'>".$L['itemsearch']."
        <input type='text' name='item' value='$itemid'>
        <input type='submit' value='".$L['search']."'></form>
		<hr>".$content."</div>";	
	}
	
/*------------------------------------------------
	Конструктор данных
------------------------------------------------*/
private function construct(){
	$this->title=$this->lang['construct'];
    $L = & $this->lang;

    if(!file_exists(USER_PATH."constructor.db")){
    $this->const_db= new SQLiteDatabase(USER_PATH."constructor.db",0666,$error) or dir("error: $error");

    $this->const_db->query("CREATE TABLE constr (
        id INTEGER PRIMARY KEY,
        name TEXT NOT NULL,
        type TEXT NOT NULL,
        db TEXT NOT NULL,
        vars TEXT,
        query TEXT NOT NULL
    );");
    } else $this->const_db = new SQLiteDatabase(USER_PATH."constructor.db",0666,$error) or dir("error: $error");

        $this->speedbar="<a href='?action=construct'>".$this->lang['construct']."</a>";


        // route bar link
        if(isset($_GET['show'])){
            if($_GET['show']=='create')
                    $this->speedbar.="&rarr; <a href='?action=construct&show=create'>".$L['constr_query']."</a>";
            if($_GET['show']=='list')
                    $this->speedbar.="&rarr; <a href='?action=construct&show=list'>".$L['query_list']."</a>";
        }
    // действия
    if(isset($_GET['do'])){
        // запуск скрипта
        if($_GET['do']=='run') {
            $id=intval($_GET['id']); // номер запроса

            $qu=$this->const_db->arrayQuery("SELECT * FROM constr WHERE id=$id"); // получаем данные
            $q=$qu[0];// 1 запись
            //
            // есть ли вообще записи?
            if(count($q) >0 ){
                // тип выборка данных
    
                // тип или изменения или обновления
                    $this->tpl->assign('name',$q['name']);
                    // массив переменных
                    $vars=unserialize($q['vars']);
                    
                    // форма передана
                    if(isset($_POST['val']) || isset($_GET['q'])){
                        $query=stripslashes(base64_decode($q['query']));
                        //todo check array $v
						
						if(isset($_POST['val'])){
	                        $v=$_POST['val'];
	                        // заменяем теги
	                        foreach ($v as $key => $value) {
	                            $query=str_replace('{'.$key.'}', $value, $query);
	                        }						
						
						} else {
							if(isset($_GET['q'])){
								// backup original query
								$query=base64_decode($_GET['q']);
								$_query=$query;
								
								if(!strstr($query,'LIMIT') && $q['type']=='select'){
									if(isset($_GET['page'])) {
										
										$query=sprintf($query.' LIMIT %d, 50',($_GET['page']*50));
										
									} else $query=$query.' LIMIT 0, 50';
								}
							}
						}
						
						if(!strstr($query,'LIMIT') && $q['type']=='select') {
							$_query=$query;
							$query=$query.' LIMIT 0, 50';
						}
								
                        // подключаемся к бд
                        include(CONF);

                         if($q['db']=='game'){
                            $this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
                        } else $this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server);

                        // выполняем запрос
                        $result=$this->db->sql_query($query);
                        $this->tpl->assign('query',$query);
                        
                        if($q['type']!=='select'){
                        	$affected = $this->db->sql_affectedrows();
                        	$this->tpl->assign('message',sprintf($L['execquery'],$affected));
                        } else {
	                        // выполняем запрос
	                        if($this->db->sql_numrows($result) > 0) {

		
		                        $this->table->clear();
		                        $tmpl = array (
		                                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" class="uiTable">',
		                                    'row_start'           => '<tr style="background:#E9E9E9">',
		                                    'row_alt_start'       => '<tr style="background:#F8F8F8">',
		                         );
		                        $this->table->set_template($tmpl);
		                        
								// вывод данных
								if($this->db->sql_numrows($result) == 1){
								// once row
									$row = mysql_fetch_assoc($result);
									
									foreach($row as $field=>$val){
										$this->table->add_row($field,$val);
									}
								} else {
								
								 // many rows
			                        $field  = $this->db->sql_numfields($result);
			                        $fields=array();
									$q='';
									
			                        for($i=0; $i < $field; $i++)
			                        {
			                        	// get once field name
			                        	$fn=$this->db->sql_fieldname($i,$result);
			                        	/*
			                        		SELECT * 
			                        		FROM account_data
			                        		WHERE access_level='3' 
			                        		ORDER BY membership ASC 
			                        		LIMIT 0, 50
			                        		
			                        	*/
			                        	if(strstr($_query,'ORDER') && $q==''){

											// order sorting
			                        		if(strstr($_query,'ASC')) 
			                        				$order='DESC';
			                        			else 
			                        				$order='ASC';

			                        		// remove order string
			                        		$q=preg_replace("|(ORDER BY [a-zA-Z]+.*[A-Z]{3,4}+)|i", 'ORDER BY %s '.$order, $_query);
			                        		
			                        		//var_dump($q);
			                        	} 
			                        	
			                        	if(!strstr($_query,'ORDER')) $q=$_query." ORDER BY %s ASC";
			                        	
			                        	//echo sprintf($q,$fn)."  - $q - $fn".'<br>'; // debug
			                        	// create links
			                            $fields[]=sprintf(
			                            	'<a href="?action=construct&do=run&id=%d&q=%s">%s</a>',
			                            	$id,
			                            	base64_encode(sprintf($q,$fn)),$fn);
			
			                        }
			                        // head field names
									$this->table->set_heading($fields);
									// while all row
			                        while ($row = mysql_fetch_assoc($result)) {
			                            $this->table->add_row($row);
			                        }
		                       }
		                        
		                        if(isset($_query)) $qb=base64_encode($_query); else $qb=base64_encode($query);
		                        if(isset($_query)) $result=$this->db->sql_query($_query);
		                        
		                        // current page  
		                        if(isset($_GET['page'])) {
		                        	$page=intval($_GET['page']);
		                        }  else $page=1;
		                                             
								$pagination=helper::pagination(
									$this->db->sql_numrows($result),
									sprintf('?action=construct&do=run&id=%d&q=%s&page=',$id,$qb),50,5,$page);
 
								$this->tpl->assign('result',$this->table->generate().$pagination); 
								                     
	                        }  else $this->tpl->assign('result',$L['no_result']); 
	                        
                       
                        }
                        
                    } else {
                    // если есть переменные
                    if(count($vars) > 0){
                        foreach ($vars as $key => $value) {
                            $this->table->add_row($value,"<input type='text' class='sText' name=\"val[$key]\" \>");
                        }
                        $this->table->add_row('',"<input type='submit' value='".$q['type']."' class='editbtn1 butDef' \>");
                        $this->tpl->assign('result',$this->table->generate());
                    } else {
                        // если нет переменных (тупо запрос)
                        include(CONF);
                        
                        if($q['db']=='game'){
                            $this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
                        } else $this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server);

                        $query=stripslashes(base64_decode($q['query']));
                        $ststus=$this->db->sql_query($query);
                        $affected = $this->db->sql_affectedrows();
                        $this->tpl->assign('message', sprintf($L['insertquery'],$affected));
                    }
				}
            } else {

                $this->tpl->assign('message',$L['querynf']);
            }
        }

        // delete q
        if($_GET['do']=='delete') {
            $id=intval($_GET['id']); // номер запроса
            $this->const_db->query("DELETE FROM constr WHERE id=$id"); // удаляем данные
            $this->tpl->assign('message' , $L['querydelete']);
            // синхронизация
            $this->_synh();
        }

        if($_GET['do']=='edit'){
            $this->speedbar.="&rarr; " . $L['editquery'];
            $id=intval($_GET['id']); // номер запроса
            if(isset($_POST['edname'])){

                $name	=	addslashes($_POST['edname']);
                $type	=	$this->secure($_POST['type']);
                $key	=	$_POST['key'];
                $value	=	$_POST['value'];
                $query	=	base64_encode(stripslashes($_POST['query']));
                $db		=	$this->secure($_POST['db']);
                $vars	=	array();



            for($i=0; $i < count($key); $i++){
                $vars[$this->secure($key[$i])]=addslashes($value[$i]);
            }
            $vars=serialize($vars);
            $this->const_db->query("UPDATE constr SET name='$name' ,type='$type',db='$db',vars='$vars',query='$query' WHERE id=$id");
            // синхронизация
                $this->_synh();
             $this->tpl->assign('message', $L['querysaved']);
            }// posted


            $qu=$this->const_db->arrayQuery("SELECT * FROM constr WHERE id=$id"); // получаем данные
            $q=$qu[0];// 1 запись
            $vars=unserialize($q['vars']);
            $array=array(
             'id' => $q['id'],
             'name' => $q['name'],
             'type'  => $q['type'],
             'db' => $q['db'],
             'vars'  => $vars,
             'query' =>stripslashes(base64_decode($q['query']))
            );


            $this->tpl->assign('edit',$array);
        }
    }

    // создание нового запроса
	if(isset($_POST['name'])){
		$name	=	addslashes($_POST['name']);
		$type	=	$this->secure($_POST['type']);
		$key	=	$_POST['key'];
		$value	=	$_POST['value'];
		$query	=	base64_encode($_POST['query']);
		$db		=	$this->secure($_POST['db']);
		$vars	=	array();
		
		for($i=0; $i < count($key); $i++){
			$vars[$this->secure($key[$i])]=addslashes($value[$i]);
		}
		$vars=serialize($vars);
		$this->const_db->query("INSERT INTO constr (name,type,db,vars,query) VALUES('$name','$type','$db','$vars','$query')");
        $this->tpl->assign('message',$L['querycreated']);
		// синхронизация
        $this->_synh();
	}// end post


	$list=$this->const_db->arrayQuery("SELECT * FROM constr ORDER BY id ASC");
    if(count($list) >0 ){
        $this->table->clear();
		$tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" class="uiTable">',
                    'row_start'           => '<tr style="background:#E9E9E9">',
                    'row_alt_start'       => '<tr style="background:#F8F8F8">',
         );
        $this->table->set_template($tmpl);
        $this->table->set_heading('#',$L['name'],$L['querytype'],$L['action']);
        foreach($list as $id => $row){
            $action="
                <a href='?action=construct&do=edit&id=".$row['id']."'><img src='".TPL_URL."i/edit.png' alt='edit' title='Edit' /></a>
                <a href='?action=construct&do=delete&id=".$row['id']."'><img src='".TPL_URL."i/delitem.png' alt='delete' title='Delete' /></a>
                <a href='?action=construct&do=run&id=".$row['id']."'><img src='".TPL_URL."i/launch.png' alt='run' title='Run!' /></a>";
            $this->table->add_row($row['id'],stripslashes($row['name']), $row['type'],$action);

        }

        $this->tpl->assign('query_list',$this->table->generate());
    } else{
        $this->tpl->assign('query_list','no query :(');

    }
    //
	return $this->tpl->fetch('const.tpl');
}
/*-----------------------------------------
	Изменение предмета
	@todo use template
-----------------------------------------*/		
	function edititem(){
	
		include(CONF);
		$L = & $this->lang;
		$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server);
		$tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" class="uiTable">',
                    'row_start'           => '<tr style="background:#E9E9E9">',
                    'row_alt_start'       => '<tr style="background:#F8F8F8">',
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
    static function GetInstance(){

        if(self::$instance == NULL){
            self::$instance = new aioncp;
        }

        return self::$instance ;
    }

// получение название предмета


	public function get_item_name($id){
	
	if (isset($_SESSION['lang'])) {
		$file_name=LANG_PATH.$_SESSION['lang'].DIRECTORY_SEPARATOR.$_SESSION['lang']."_items";
	} else $file_name=LANG_PATH.DEFAULT_LANG.DIRECTORY_SEPARATOR.DEFAULT_LANG."_items";
	
	$L = & $this->lang; // link
	
	// check db file
	if(!isset($this->itemsdb)){
	
	if(!file_exists("$file_name.db")){
	// create database
		$this->itemsdb= new SQLiteDatabase("$file_name.db",0666,$error) or dir("Ошибка: $error");
		$this->itemsdb->query("CREATE TABLE items ( serial INT NOT NULL PRIMARY KEY , id INT NOT NULL , name TEXT NOT NULL );");
		if(file_exists("{$file_name}.xml"))
        {
            $xml=simplexml_load_file("{$file_name}.xml");

		
		// создаём массив предметов	
		$this->items=array();
		$i=0;
		foreach ($xml->aionitem as $key => $value)
		{
			$i++;
			$this->itemsdb->query("INSERT INTO items (serial,id,name) VALUES($i,".intval($value['id']).",'".sqlite_escape_string($value['name'][0])."');");
		}
       }
	} else{
		$this->itemsdb= new SQLiteDatabase("$file_name.db",0666,$error) or dir("Error: $error");
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
		return helper::world($id);
	}
	
	function config(){
	
		$lang	='ru';
		$acl	='1';
		$debug	='false';
		$effect	='false';
		$title	='AionCP 1.0';
		if(count($_POST) ==0) return $this->lang['errorgetdate'];
		
		if(isset($_POST['title'])) $title=addslashes($_POST['title']);
		if(isset($_POST['lang']))  $lang=$this->secure($_POST['lang']);
		if(isset($_POST['debug'])) $debug='true';
		if(isset($_POST['effect']))	$effect='true';
		if(isset($_POST['acl']) && $_POST['acl'] >0) $acl=intval($_POST['acl']);
		$ENCRYPT=ENCRYPT;
		$ENCRYPT_KEY=ENCRYPT_KEY;
		
$file=<<<FILE
<?php
/* ------------------------------------------------------------------------
	Free CP for Aoin
	Developer www.fdcore.ru
	http://code.google.com/p/aioncp/
------------------------------------------------------------------------ */
// DEBUG MODE (bool)
define('DEBUG', $debug);
// Default lang in cp (ru \ en)
define('DEFAULT_LANG','$lang');
// jquery effect
define('JS_EFFECT',$effect);
// main title postfix
define('TITLE','$title');
// work driver !
define('DRIVER', 'mysql');
// Access level for login
define('ALLOW_ACL', $acl);
define('ENCRYPT', '$ENCRYPT');
define('ENCRYPT_KEY', '$ENCRYPT_KEY');
FILE;
		if(is_writable(CORE)){
			file_put_contents(CORE,$file);
			unset($file);
			return $this->lang['config_saved'];
		}
		return $this->lang['config_premission'];
	}

    function _synh(){
        if(isset($this->const_db)){
        $list=$this->const_db->arrayQuery("SELECT * FROM constr ORDER BY id ASC");
        if(count($list) >0 ){
        $htmlist='';

            foreach($list as $id => $row){
                $htmlist.="<li><a href='?action=construct&do=run&id=".$row['id']."'>".$row['name']."</a></li>";
            }

            @file_put_contents(USER_PATH.'constr_list.html', $htmlist);
        }
       }
    }

/*
 * create account
 */
    function create_account(){
        $L = & $this->lang;
		$this->title=$L['create_account'];

        if(isset($_POST['name'],$_POST['password'],$_POST['email'])){
			if($this->connect_db!=='ls'){
				include(CONF);
				$this->db	=new sql_db($db_host, $db_login, $db_password, $db_login_server);
				$this->connect_db='ls';
			}

            $name       = $this->secure($_POST['name']);
            $password   =  base64_encode(sha1($_POST['password'],true));
            $email      = $this->secure($_POST['email']);
            $access_level   = intval($_POST['access_level']);

  		$result=$this->db->sql_query("SELECT name FROM account_data WHERE name='$name' LIMIT 1");

		if ($this->db->sql_numrows($result) > 0) {

			$this->tpl->assign('msg' , $L['login_exist']);

		} else {
            $this->tpl->assign('msg' , $L['account_created']);
			$this->db->sql_query("INSERT INTO account_data (name,password,activated,access_level,email)
                    VALUES('$name','$password',1,'$access_level','$email')");
		}
        }
        return $this->tpl->fetch('create_account.tpl');
    }

    function note(){
    
        if(isset($_POST['note'])){
            file_put_contents(CONF_PATH.'note.txt', stripslashes($_POST['note']));
            exit($this->lang['noticesaved']);
        }
        if(isset($_GET['show'])){
            include CLASS_PATH."markdown.php";
            if(file_exists(CONF_PATH.'note.txt')){
             $note=file_get_contents(CONF_PATH.'note.txt');
           	 if($_GET['show']==1) echo markdown($note);
           	 if($_GET['show']==2) echo $note;
             exit();           
            }

        }
        
        exit();

    }
    
    function friends(){
    
    	if(isset($_GET['char_id']) && $_GET['char_id'] > 0){
    		$char_id=intval($_GET['char_id']);
 			include(CONF);
			$this->db	=new sql_db($db_host, $db_login, $db_password, $db_game_server); 
			  
			$result=$this->db->sql_query("SELECT name,account_name,account_id FROM players WHERE id='$char_id' LIMIT 1"); 
			if ($this->db->sql_numrows($result) > 0) {
					 list($name,$account_name,$account_id)=$this->db->sql_fetchrow($result);
					 $this->speedbar="<p><a href='?action=info&char=$account_id'>$account_name</a> &rarr; <a href='?action=char&char_name=$name'>$name</a> &rarr; $char_id &rarr; ".$this->lang['friendslist']."</p>";
			}  else {
				return FALSE;
			} 
			$this->tpl->assign('name',$$name);
								
    		$result	=	$this->db->sql_query("SELECT p.id,p.name,p.account_id,p.account_name FROM friends f,players p WHERE f.player=$char_id AND f.friend=p.id");
    		
    		if ($this->db->sql_numrows($result) > 0) {
    			$row=$this->db->sql_fetchrowset($result);
    			$this->tpl->assign('rows',$row);
    			
    		} else $this->tpl->assign('rows',false);
    		
    		return $this->tpl->fetch('friends.tpl');
    	} else return 'char_id not found :(';
    
    }

	function title()
	{
		if(isset($_GET['char_id'])){
			$char_id=intval($_GET['char_id']);
			
			if ($char_id==0) {
				return $this->lang['invalidchar'];
			}
			
			include(CONF);
			$this->db		= new sql_db($db_host, $db_login, $db_password, $db_game_server);
			$title_list		= array();
			$title_list[0]	= $this->lang['notitlechar'];
			
			for ($i=1; $i <= 106; $i++) { 
				$title_list[$i]=helper::GetTitle($i);
			}
			
			$result=$this->db->sql_query("SELECT * FROM player_titles WHERE player_id=".$char_id);
			
			// update title
			if (isset($_POST['title_id'])) {
				
				$title_id=intval($_POST['title_id']);
				$this->tpl->assign('player_title',$title_id);
				
	 			if ($this->db->sql_numrows($result) > 0) {  
	 				$this->db->sql_query("UPDATE player_titles SET title_id=$title_id WHERE player_id=".$char_id);
	 						
	 			} else $this->db->sql_query("INSERT INTO player_titles (title_id,player_id) VALUES($title_id,$char_id)");
					
			} else {
		 		
	 			if ($this->db->sql_numrows($result) > 0) {  
		
	 				$row=$this->db->sql_fetchrow($result);
	 				$this->tpl->assign('player_title',$row['title_id']);
			
	 			} else $this->tpl->assign('player_title',0);
			}
			

	
			$this->tpl->assign('title_list',$title_list);
			$this->tpl->assign('char_id',$char_id);
			
			if(isset($_GET['ajax']))
				exit($this->tpl->display('title_char.tpl'));
			else
				return $this->tpl->fetch('title_char.tpl');
		}//end if
	}
	
	
	function itemlist(){
		if (isset($_SESSION['lang'])) {
			$file_name=LANG_PATH.$_SESSION['lang'].DIRECTORY_SEPARATOR.$_SESSION['lang']."_items";
		} else $file_name=LANG_PATH.DEFAULT_LANG.DIRECTORY_SEPARATOR.DEFAULT_LANG."_items";
		
		$L = & $this->lang; // link
		
		// check db file
		if(!isset($this->itemsdb)) $this->itemsdb= new SQLiteDatabase("$file_name.db",0666,$error) or dir("Error: $error");
		
		if(isset($_GET['page']) && is_numeric($_GET['page'])) $result=$this->itemsdb->query("SELECT * FROM items LIMIT ".($_GET['page']*50).",50");
		
			else {
				if(isset($_POST['searchname']) && strlen($_POST['searchname']) > 2){
					
					//todo need secure
					$searchname=$_POST['searchname'];
					$result=$this->itemsdb->query("SELECT * FROM items WHERE name LIKE '%$searchname%' OR name LIKE '$searchname%' OR name LIKE '%$searchname'");
					$b64q=base64_encode($searchname);
					
				} else $result=$this->itemsdb->query("SELECT * FROM items LIMIT 0,50");
			}
		
		//CREATE TABLE items ( serial INT NOT NULL PRIMARY KEY , id INT NOT NULL , name TEXT NOT NULL );
		$tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="5" class="uiTable">',
                    'row_start'           => '<tr style="background:#E9E9E9">',
                    'row_alt_start'       => '<tr style="background:#F8F8F8">',
         );
        $this->table->set_template($tmpl);
        $this->table->set_heading('id','Имя');
        		
		if($result->numRows() > 0 ){
			while($row=$result->fetch()){
				$this->table->add_row($row['id'],$row['name']);
			}
		}
		
		// pagination
		$page=(isset($_GET['page']))?intval($_GET['page']):1;
		// get total rows
		$result=$this->itemsdb->query("SELECT null FROM items");
		
		if(isset($b64q)) 
			$pagination=helper::pagination($result->numRows(),"?action=itemlist&q=$b64q&page=",50,5,$page);
		else
			$pagination=helper::pagination($result->numRows(),'?action=itemlist&page=',50,5,$page);
						
		$this->tpl->assign('table',$this->table->generate());
		$this->tpl->assign('pagination',$pagination);
		
		if(isset($_POST['searchname'])) exit($this->table->generate());
		else return $this->tpl->fetch('itemlist.tpl');
		

	}
// ------------------------------------------------------------------------
  	/*
  		is the end
  	*/  	
}

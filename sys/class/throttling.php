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
/*
	FDCore Studio
	
	@author NetSoul
	@link http://fdcore.ru
	@license http://fdcore.ru/license.html
	@descr Класс для снижения нагрузки на базу, за основу взят скрипт из ядра ExpressionEngine
*/

/*------------------------------------------------
	Настройки
------------------------------------------------*/
$_PARAMS['max_page_loads']		= 10; // страниц за time_interval
$_PARAMS['time_interval']		= 1; // интервал за станицу
$_PARAMS['lockout_time']		= 2; // время блокировки 
$_PARAMS['enable_throttling']	= 'y'; // включить Throttling
$_PARAMS['banishment_type']		= 'message'; // redirect - переадресовать, message - вывести сообщение
$_PARAMS['banishment_message']	= 'To fast, wait '.$_PARAMS['lockout_time'].' seconds.';  // текст блокировки
$_PARAMS['banishment_url']		= 'http://google.ru'; // ссылка для редиректа
$_PARAMS['throttle_db']			= CACHE_PATH.'throttling.db'; // имя базы данных

if(!is_dir(CACHE_PATH)){
	$_PARAMS['enable_throttling']	= 'n';
}
/*------------------------------------------------
	Класс
------------------------------------------------*/
$THTT= new Throttling;
//$THTT->throttle_ip_check();
$THTT->throttle_check();
$THTT->throttle_update();
//уничтожаем
unset($THTT);

class Throttling {

	var $max_page_loads = 10;
	var $time_interval	= 5;
	var $lockout_time	= 30;
	var $current_data	= FALSE;
	var $ip_address		= FALSE;
	
	private $db;
	
    function Throttling()
    {
		global $_PARAMS;
		
		if ($_PARAMS['enable_throttling'] != 'y')
			return FALSE;
			
		if ( ! is_numeric($_PARAMS['max_page_loads']))
		{
			$_PARAMS['enable_throttling'] = 'n';
			return;
		}
		else
		{
			$this->max_page_loads = $_PARAMS['max_page_loads'];
		}

		if (is_numeric($_PARAMS['time_interval']))
		{
			$this->time_interval = $_PARAMS['time_interval'];
		}

		if (is_numeric($_PARAMS['lockout_time']))
		{
			$this->lockout_time = $_PARAMS['lockout_time'];
		}
		
		if(!file_exists($_PARAMS['throttle_db'])){
			$this->db = new SQLiteDatabase($_PARAMS['throttle_db'],0666, $error) or die($error);
		
			$query="
			CREATE TABLE throttle(
				ip_address,
				last_activity INTEGER,
				hits INTEGER,
				locked_out
			);";
			$this->db->query($query);
		
		
		} else {
		    $this->db = new SQLiteDatabase($_PARAMS['throttle_db'],0666,$error) or die($error);
		}		
		
    }
    /* END */
    
    /** ----------------------------------------------
    /**  Is there a valid IP for this user?
    /** ----------------------------------------------*/
 
 	function throttle_ip_check()
 	{
 		global $_PARAMS;

		if ($_PARAMS['enable_throttling'] != 'y')
			return FALSE;

	
		if ( $this->ip_address() == '0.0.0.0' OR $this->ip_address() == '')
		{
			$this->banish();
		}
  	}
  	/* END */
  	

    /** ----------------------------------------------
    /**  Throttle Check
    /** ----------------------------------------------*/
        
    function throttle_check()
    {    
        global $_PARAMS;
                        
		if ($_PARAMS['enable_throttling'] != 'y')
			return FALSE;
                        
		$expire = time() - $this->time_interval;
		
		$query = $this->db->arrayQuery("SELECT hits, locked_out, last_activity FROM throttle WHERE ip_address= '".$this->ip_address()."'",SQLITE_ASSOC);
							 
		if (count($query) == 0) $this->current_data = array();
  
  		
  		if (count($query) == 1)
  		{
  			
  			$query=$query[0];
  			
  			$this->current_data = $query;
			
			
			$lockout = time() - $this->lockout_time;
			
			
			if ($query['locked_out'] == 'y' AND $query['last_activity'] > $lockout)
			{
				$this->banish();
				exit;
			}

  			if ($query['last_activity'] > $expire)
  			{
  				if ($query['hits'] == $this->max_page_loads)
  				{
  					// Lock them out and banish them...
					$this->db->query("UPDATE throttle SET locked_out = 'y', last_activity = '".time()."' WHERE ip_address= '".$this->ip_address()."'");
					$this->banish();
					exit;
  				}
  			}
  		}
    }
    /* END */
  	
    /** ----------------------------------------------
    /**  Throttle Update
    /** ----------------------------------------------*/

    function throttle_update()
    {
    	 global $_PARAMS;
    	
		if ($_PARAMS['enable_throttling'] != 'y')
			return FALSE;
    	
    	if ($this->current_data == FALSE)
    	{
			$query = $this->db->arrayQuery("SELECT hits, last_activity FROM throttle WHERE ip_address= '".$this->ip_address()."' LIMIT 1",SQLITE_ASSOC);

			$this->current_data = (count($query) == 1) ? $query : array();
		}
		
		if (sizeof($this->current_data) > 0)
		{
			$expire = time() - $this->time_interval;
			
			if ($this->current_data['last_activity'] > $expire) 
			{
				$hits = $this->current_data['hits'] + 1;
			}
			else
			{
				$hits = 1;
			}
							
			$this->db->query("UPDATE throttle SET hits = '{$hits}', last_activity = '".time()."', locked_out = 'n' WHERE ip_address= '".$this->ip_address()."'");
		}
		else
		{
			$this->db->query("INSERT INTO throttle (ip_address, last_activity, hits) VALUES ('".$this->ip_address()."', '".time()."', '1')");
		}
    }
    /* END */
    
  
    /** ----------------------------------------------
    /**  Banish User
    /** ----------------------------------------------*/
        
	function banish()
	{
		global $_PARAMS;
	
		$type = ((
			$_PARAMS['banishment_type'] == 'redirect' 
				AND $_PARAMS['banishment_url'] == '')  OR 
				
			($_PARAMS['banishment_type'] == 'message' 
				AND $_PARAMS['banishment_message'] == '')) ?  '404' : $_PARAMS['banishment_type'];
		
		switch ($type)
		{
			case 'redirect' :	$loc = ( ! preg_match("#^http://#i", $_PARAMS['banishment_url'])) ? 'http://'.$_PARAMS['banishment_url'] : $_PARAMS['banishment_url'];
								header("Location: {$loc}");
				break;
			case 'message'	:	echo stripslashes($_PARAMS['banishment_message']);
				break;
			default			:	header("Status: 404 Not Found"); echo "Status: 404 Not Found";
				break;
		}
		
		exit;	
	}
	/* END */
	// --------------------------------------------------------------------

	/**
	* Fetch the IP Address
	*
	* @access	public
	* @return	string
	*/
	function ip_address()
	{
		if ($this->ip_address !== FALSE)
		{
			return $this->ip_address;
		}
		//var_dump($_SERVER);
		if (isset($_SERVER['REMOTE_ADDR']) AND isset($_SERVER['HTTP_CLIENT_IP']))
		{
			$this->ip_address = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (isset($_SERVER['REMOTE_ADDR']))
		{
			$this->ip_address = $_SERVER['REMOTE_ADDR'];
		}
		elseif (isset($_SERVER['HTTP_CLIENT_IP']))
		{
			$this->ip_address = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$this->ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}

		if ($this->ip_address === FALSE)
		{
			$this->ip_address = '0.0.0.0';
			return $this->ip_address;
		}

		if (strstr($this->ip_address, ','))
		{
			$x = explode(',', $this->ip_address);
			$this->ip_address = trim(end($x));
		}

		if ( ! $this->valid_ip($this->ip_address))
		{
			$this->ip_address = '0.0.0.0';
		}

		return $this->ip_address;
	}   
	// --------------------------------------------------------------------

	/**
	* Validate IP Address
	*
	* Updated version suggested by Geert De Deckere
	* 
	* @access	public
	* @param	string
	* @return	string
	*/
	function valid_ip($ip)
	{
		$ip_segments = explode('.', $ip);

		// Always 4 segments needed
		if (count($ip_segments) != 4)
		{
			return FALSE;
		}
		// IP can not start with 0
		if ($ip_segments[0][0] == '0')
		{
			return FALSE;
		}
		// Check each segment
		foreach ($ip_segments as $segment)
		{
			// IP segments must be digits and can not be 
			// longer than 3 digits or greater then 255
			if ($segment == '' OR preg_match("/[^0-9]/", $segment) OR $segment > 255 OR strlen($segment) > 3)
			{
				return FALSE;
			}
		}

		return TRUE;
	}   
}
// END CLASS
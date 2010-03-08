<?php

/**
 * Light Telplater
 *
 * class description
 * 
 * @author NetSoul
 */
 define('LD', '{');
 define('RD', '}');
 define('SLASH','&#47;');
class Lightpl
{
	private $var_single      	= array();		// "Single" variables
	private $var_pair      		= array();		// "Pair" variables
	public $source; 
	
	/*------------------------------------------
		Constructor
	------------------------------------------*/
	function Lightpl($file=''){
	
		if($file!=='')
			$this->source=file_get_contents($file);
	}
	/*------------------------------------------
		php5 function: auto set in object
	------------------------------------------*/	
	function __set($name,$value=''){
	
		$this->var_single[$name]=$value;
		
	}
	/*------------------------------------------
		standart function:  set in vars
	------------------------------------------*/	
	function set($name,$value=''){
	
		$this->var_single[$name]=$value;
		
	}	
	/*------------------------------------------
		php5 function: echo object
		return: string!
	------------------------------------------*/	
	function __tostring(){
	
		return $this->compile();
		
	}
   /*------------------------------------------
      Swap variable pairs with final value
    ------------------------------------------*/

    function swap_var_pairs($open, $close, $source)
    {
        return preg_replace("/".LD.preg_quote($open).RD."(.*?)".LD.SLASH.$close.RD."/s", "\\1", $source); 
    }
    
    function add_block($name,$value=''){
    	$this->var_pair[$name]=$value;
    }	
    
	function compile($return=TRUE){
	
		$source=$this->source;
		
		if (count($this->var_pair)) {
			foreach ($this->var_pair as $key => $value)
			{
				$source = $this->swap_var_pairs($key, $key, $source);
			}		
		}
	
		foreach ($this->var_single as $key => $value)
		{
			$source = str_replace('{'.$key.'}', $value, $source);
		}
				
		if($return) return $source; else echo $source;
	}
	
}
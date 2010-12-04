<?php
/* ------------------------------------------------------------------------

 * Aion Control Panel
 *
 * @version 1.2
 * @author NetSoul (FDCore main Developer)
 * @link http://www.fdcore.ru
 *
 * http://code.google.com/p/aioncp/
 *
 * @license http://fdcore.ru/license.html

------------------------------------------------------------------------ */

class Cache{

	public function __construct()
	{
		if(!defined('CACHE_PATH')) return false;
	}



	public function set($items, $tags = NULL, $lifetime = NULL)
	{
		if(!is_dir(CACHE_PATH) || !is_writable(CACHE_PATH)) return false;
		
		if ($lifetime !== 0)
		{
			// File driver expects unix timestamp
			$lifetime += time();
		}

		if ( ! is_null($tags) AND ! empty($tags))
		{
			// Convert the tags into a string list
			$tags = implode('+', (array) $tags);
		}

		$success = TRUE;

		foreach ($items as $key => $value)
		{
			if (is_resource($value))
				exit('Caching of resources is impossible, because resources cannot be serialised.');

			// Remove old cache file
			$this->delete($key);
			$hashname=md5($key);
			$container=array('content'=>$value, 'lifetime'=>$lifetime);
			
			if ( ! (bool) file_put_contents(CACHE_PATH.$hashname, serialize($container)))
			{
				$success = FALSE;
			}
		}

		return $success;
	}

	public function get($key, $single = FALSE)
	{
		
		if(!is_dir(CACHE_PATH)) return false;
		
		$items = array();

		if(file_exists(CACHE_PATH.md5($key))){
			$file=file_get_contents(CACHE_PATH.md5($key));
			$container=unserialize($file);
			
			if($container['lifetime'] > time()){
				
				return $container['content'];
				
			} else {
				
				$this->delete($key);
				return false;
			}
			
		}
		
	}

	
	/**
	 * Delete cache items by keys or tags
	 */
	public function delete($key, $tag = FALSE)
	{
		if(file_exists(CACHE_PATH.md5($key))){
			@unlink(CACHE_PATH.md5($key));
			return true;
		} else return false;
		
	}

	
} // End Cache Memcache Driver

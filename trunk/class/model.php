<?php
/**
 * className
 *
 * class description
 * 
 * @author your name
 */
class aion
{
	static function login($login,$password){
		return sprintf("SELECT id FROM account_data WHERE name='%s' AND password='%s' AND access_level > 0",$login,$password);
	}
}
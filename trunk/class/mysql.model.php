<?php
/* ------------------------------------------------------------------------

	Free CP for Aoin
	beta version
	Developer www.fdcore.ru
	
	http://code.google.com/p/aioncp/
------------------------------------------------------------------------ */
class aion
{
	static function login($login,$password){
		return sprintf("SELECT id FROM account_data WHERE name='%s' AND password='%s' AND access_level > 0",$login,$password);
	}
	
	static function search_email($email){
		$pattern="SELECT id,name,email FROM `account_data` 
				WHERE email LIKE '{email}%' 
				OR email='{email}' 
				OR email LIKE '%{email}%'
				OR email LIKE '%{email}'
				";
		return str_replace("{email}",$email,$pattern);
	}
}
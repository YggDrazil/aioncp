<?php
/**
 * Aion Model Class
 *
 * SQL Query for Aion Java Emu
 * 
 * @NetSoul by FDCore Studio
 */
class aion
{
	static function login($login,$password){
		return sprintf("SELECT access_level FROM account_data WHERE name='%s' AND password='%s'",$login,$password);
	}
	
	static function search_email($email){
		$pattern='SELECT id,name,email FROM `account_data` 
				WHERE email LIKE \'{email}%\' 
				OR email=\'{email}\' 
				OR email LIKE \'%{email}%\'
				OR email LIKE \'%{email}\'';
		return str_replace("{email}",$email,$pattern);
	}
	
	 static function players_update($upname,$gender,$race,$player_class,$WHERE){
		return "UPDATE players 
		 			SET name='$upname', 
		 			gender	='$gender', 
		 			race	='$race', 
					player_class='$player_class'
		 			WHERE $WHERE LIMIT 1";
	
	}
	
	static function players_id($char_id){
		return "SELECT * FROM players WHERE id='$char_id' LIMIT 1";
	}
	
	static function players_name($char_name){
		return "SELECT * FROM players WHERE name='$char_name' LIMIT 1";
	}
	
	static function stat_abyss($limit=100){
		return "SELECT p.name, a.ap, a.player_id FROM abyss_rank as a, players as p WHERE a.player_id=p.id ORDER BY a.ap DESC LIMIT $limit";
	}
	
	static function search_account($account){
		$pattern='SELECT id,name,last_ip FROM `account_data` WHERE name LIKE \'{account}%\' OR name=\'{account}\'';
		return str_replace("{account}",$account,$pattern);
	}
	
	static function search_chars($char){
		$pattern='SELECT id,name,account_name FROM `players` WHERE name LIKE \'{char}%\' OR name=\'{char}\'';
		return str_replace("{char}",$char,$pattern);		
	}
}
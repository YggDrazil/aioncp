<?php
if(!class_exists('SQLiteDatabase')){

	class SQLiteDatabase{
		
		var	$error;
		 
		// Database connection handle  
		var $conn = NULL; 
	
		// Query result  
		var $result = false; 
	
			function __construct($db,$chmod=0666,&$error=false,$persistent=false){
				
			// Choose the appropriate connect function
		    if ($persistent) { 
			$func = 'sqlite_popen'; 
		    } else { 
			$func = 'sqlite_open'; 
		    } 
	
		    // Connect to the sqlite server  
		    $this->conn = $func($db,$chmod,$error); 
		    
		    if (!$this->conn) { 
			return false; 
		    } 
		    
		    return true; 			
			
			}
	
		function close() 
		{ 
		    return (@sqlite_close($this->conn)); 
		} 
	
		function error() 
		{ 
		    return (sqlite_error_string(sqlite_last_error())); 
		} 
	
		function query($sql = '') 
		{ 
		    $this->result = sqlite_query($sql, $this->conn); 
		    return ($this->result != false); 
		} 
	
		function affectedRows() 
		{ 
		    return (@sqlite_changes($this->conn)); 
		} 
	
		function numRows() 
		{ 
		    return (@sqlite_num_rows($this->result)); 
		} 
		function fieldName($field) 
		{ 
		   return (@sqlite_field_name($this->result,$field)); 
		} 
		function insertID() 
		{ 
		    return (@sqlite_last_insert_rowid($this->conn)); 
		} 
		 
		function fetchObject() 
		{ 
		    $object=new stdClass; 
		    $tmp_arr=sqlite_fetch_array($this->result,SQLITE_NUM); 
		    if($tmp_arr!=false) 
		    { 
			$i=0; 
			foreach($tmp_arr as $value) 
			{ 
			    $fieldName=sqlite_field_name($this->result,$i); 
			    $object->$fieldName=$value; 
			    $i++; 
			} 
		    } 
		    else 
			return false; 
		    return $object; 
		} 
	
		function fetchArray() 
		{ 
		    return (@sqlite_fetch_array($this->result)); 
		} 
	
		function fetchAssoc() 
		{ 
		    return (@sqlite_fetch_array($this->result,SQLITE_ASSOC)); 
		} 
		
		function lastInsertRowId(){
			return sqlite_last_insert_rowid($this->conn);
		}
		
		function singleQuery($query='',$first_row_only=true,$decode_binary=false){
			return sqlite_single_query($this->conn,$query,$first_row_only,$decode_binary);
		}
		
		function arrayQuery($sql){
		     $this->result = sqlite_array_query($sql, $this->conn); 
		    return ($this->result != false);        
		
			}
		
			function __destruct(){
				return (@sqlite_close($this->conn)); 
			}
	}

}
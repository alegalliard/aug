<?php

	class DBConnectionManager{
		
		private static $connections = array();
		
		public static function get_connection($host, $user, $password, $dbname){
			$key = md5($host.$user.$pass.$dbname);
			
			if(! array_key_exists($key, self::$connections)){
				$conn = mysqli_connect($host, $user, $password);
				if(! $conn) throw new PhxException("Could not connect to the database.");
				
				$dbsel = mysqli_select_db($conn, $dbname);
				if(! $dbsel) throw new PhxException("Could not select the database.");
				
				self::$connections[$key] = $conn;
			}
			
			return self::$connections[$key];
		}
		
	}
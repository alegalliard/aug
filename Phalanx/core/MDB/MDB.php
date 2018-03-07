<?php 

require(dirname(__file__).'/core/driver.interface.php');
require(dirname(__file__).'/drivers/'.DATABASE_ENGINE.'.php');

	class MDB{
			
		private static $instances = array();
		
		private function __construct(){}
		
		static function cursor($conn, $tablename){
			if(! self::$instances[$tablename]){
				self::$instances[$tablename] = self::getInstance($conn);
				self::$instances[$tablename]->from($tablename);
			}
			self::$instances[$tablename]->clear();
			return self::$instances[$tablename];
		}
		
		private function getInstance($conn){
			$driver = DATABASE_ENGINE;
			return new $driver($conn);
		}
	}
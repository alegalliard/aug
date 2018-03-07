<?php 
	class Language{
		private static	$_sintaxe,
						$_instance,
						$count=0;
		
		public function __get($k){
			return $_sintaxe[$k];
		}
		
		public function __set($k, $v){
			throw new PhxException('HADOUKEN BITCH');
		}
		
		public function __construct(){
			$file_lang = LANGUAGES_PATH.DEFAULT_LANGUAGE.'.ini';
			if(file_exists($file_lang))
				self::$_sintaxe = parse_ini_file($file_lang);
		}
	
		public static function text($k){
			if(empty(self::$_instance))
				self::$_instance = new self();
			return (! isset(self::$_sintaxe[$k])) ? $k:self::$_sintaxe[$k];
		}
		
	}
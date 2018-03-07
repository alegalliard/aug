<?php
class IniParser{

	private $_data = array();
    public function __construct($filename, $sections=true){
			
		if(! file_exists($filename))
			throw new PhxException("File '{$filename}' not found.");
		
		$_itens = parse_ini_file($filename, $sections);
		foreach($_itens as $key=>$val){
			if(is_array($val)){
				$stdClass = new StdClass();
				
				foreach($val as $k=>$v)
					$stdClass->$k = $v;
					
				$this->_data[$key] = $stdClass;
				continue;
			}
			$this->_data[$key] = $val;
		}
	}
	
	public function __get($k){
		return isSet($this->_data[$k]) ? $this->_data[$k] : null;
	}
	
	public function __set($k, $v){
		throw new PhxException('Who do you think you are? You cannot set data to this ini from ' . __CLASS__ . '::' . __METHOD__);
	}

	
}

<?php
define('NOT_NULL'		,'not_null');
define('ONLY_EMAIL'		,'email');
define('ONLY_NUMERIC'	,'digits');
define('ONLY_STRING'	,'caracter');
define('ONLY_URL'		,'url');

class Validate{
	private static $_instance;
	private $_fields = array();
	private $_patterns = array('not_null'		=>'#([^\0|\s])#i',
								'email'			=>'#^([a-z0-9\-\_\.]+)@([a-z0-9\-\_]+).([a-z0-9\-\_]{1,3}).([a-z\-\_\.]{1,3})$#i',
								'digits'		=>'#^([0-9]+?)$#',
								'caracter'		=>'#^([a-zá-ù\-\_\.\?\!\%\&\*\(\)\[\]\}\{]+?)$#',
								'url'			=>'^(ht|f)tp(s?)\:\/\/[a-zA-Z0-9\-\._]+(\.[a-zA-Z0-9\-\._]+){2,}(\/?)([a-zA-Z0-9\-\.\?\,\'\/\\\+&amp;%\$#_]*)?$');
	private $_errorMsg = array();
	private $_returns = true;
	
	private function __construct(){}
	
	static function getInstance(){
		if(empty(self::$_instance))
			self::$_instance = new self();
		return self::$_instance;
	}
		
	public function filters($data,$params=array(),$msg=array()){
		$this->_fields[] = array('value'=>$data,'params'=>$params,'msg'=>$msg);
	}
	
	private function type(&$fields){
		if(!preg_match($this->_patterns[$fields['params']['type']],$fields['value'])){
			if(isSet($fields['msg']['type']))
				$this->_errorMsg[]['type'] 	= $fields['msg']['type'];
			$this->_returns 	= false;
		}
	}
	
	private function maxLength(&$fields){
		if(strlen($fields['value'])>$fields['params']['maxLenght']){
			if(isSet( $fields['msg']['maxLenght']))
				$this->_errorMsg[]['maxLenght']	= $fields['msg']['maxLenght'];
			$this->_returns = false;
		}
	}
	
	private function minLength(&$fields){	
		if(strlen($fields['value'])<$fields['params']['minLenght']){
			if(isSet($fields['msg']['minLenght']))
				$this->_errorMsg[]['minLenght'] = $fields['msg']['minLenght'];
			$this->_returns = false;
		}
	}
	
	public function validated(){
		// pega todos os campos para validação
		foreach($this->_fields as $fields){
			if(isSet($fields)){
				// verifica se foi passado o tipo de validação
				if(isSet($fields['params']['type'])) 
					$this->type($fields);
				
				// validação por tamanho maximo
				if(isSet($fields['params']['maxLenght'])) 
					$this->maxLength($fields);
					
				// validação por tamanho minimo
				if(isSet($fields['params']['minLenght'])) 
					$this->minLength($fields);
			}
			continue;
		}
		return $this->_returns;	
	}
	
	public function getErrorMsg(){
		return (count($this->_errorMsg)>0) ? $this->_errorMsg : NULL;
	}
}
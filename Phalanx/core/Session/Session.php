<?php

class Session{

	private $id;
	private $data;
	
	
	public function __construct(){
		$session_id = session_id(); 
		if(empty($session_id))
			session_start();
			
		$this->id = session_id();
	
		foreach($_SESSION as $k => $v)
			$this->data[$k] = $v;
	}

	
	public function id(){
		return $this->id;
	}
	
	function __set($k, $v){
		$_SESSION[$k] = $this->data[$k] = $v;
	}
	
	function __get($k){
		return $this->data[$k];
	}
	
	function destroy($k=null){
		if(!is_null($k)){
			unset($_SESSION[$k]);
			unset($this->data[$k]);
		}else{	
			session_unset();
			session_destroy();
			unset($_SESSION);
			unset($this);
		}
	}
	
	public function __toString(){
		return '<pre>'.print_r($this->data).'</pre>';
	}
	
	public function is($k){
		return isset($this->data[$k]);
	}

	public function __destruct(){
		unset($this);
	}

}
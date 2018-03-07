<?php
class HTMLElements{
		protected $_name;
		protected $_proprieties		=	array();
		public $_tag_unique			=	false; // tipo  fechamento da tag unico ou casal
		protected $_childrens		=	array();
		
		
	function __construct($name='html'){
		$this->_name = $name;
	}
	
	function __set($k,$v){
		$this->_proprieties[$k] = $v;
	}
	
	function setName($name)
	{
		$this->_name = $name;
	}
	
	function add($child){
			$this->_childrens[] = $child;
	}
	
	function start_tag(){
		return  "<{$this->_name}";	
	}

	function render(){
			$element = self::start_tag(); 
			foreach($this->_proprieties as $k=>$v)
				$element .= " {$k}='{$v}'";
			$element .= self::start_close(); 
			return $element; 
	}
	
	function start_close(){
		if($this->_tag_unique){
			$element =  " />\n";	
		}
		else{
			$element = ">";
			foreach($this->_childrens as $k)
				if($k instanceOf HTMLElements)
					$element .= trim($k->render())."\n";
				else
					$element .= "{$k}\n";
			$element .=  "</{$this->_name}>\n";
		}
		return trim($element);	
	}
	
	function __toString(){
		return (string)$this->_name;
	}
	
	function __destruct(){
			unset($this);
	}
}

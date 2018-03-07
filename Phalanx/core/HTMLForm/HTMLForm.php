<?php
class HTMLForm extends HTMLElements
{
	
	private $_fields = array();
	
	function __construct($action=null)
	{
			parent::__construct('form');
			$this->method 	= 'post';
			$this->enctype 	= 'multipart/form-data';
			if(!is_null($action))
				$this->action =$action; 
	}
	
	function entry($nameStr=null)
	{
		$o  			=  new HTMLElements('input');
		$o->type 		= 'text';
		$o->class 		= "phx-entry";
		$o->id 			= "id_{$nameStr}";
		$o->size 		= 55;
		$o->_tag_unique	= true;
		if(!is_null($nameStr)) $o->name = $nameStr;
		return $o;
	}
	
	function password($nameStr=null)
	{
		$o  		=  new HTMLElements('input');
		$o->type 	= 'password';
		$o->class 	= "phx-password";
		$o->size 	= 25;
		$o->_tag_unique = true;
		//
		if(!is_null($nameStr)) $o->name = $nameStr;

		return $o;
	}
	
	public function text($PnameStr=null)
	{
		$o 			=  new HTMLElements('textarea');
		$o->cols 	= 50;
		$o->class 	= "phx-textarea";
		if(!is_null($PnameStr))
			$o->name = $PnameStr;

		return $o;
	}
	
	function file($nameStr=null){
		$o  		=  new HTMLElements('input');
		$o->type 	= 'file';
		$o->class ="phx-file";
		$o->size 	= 40;
		return $o;
		if(!is_null($PnameStr)) $o->name = $PnameStr;
	}
	
	function submit($PnameStr=null,$value=null)
	{
		$o  			=  new HTMLElements('button');
		$o->type 		= 'submit';
		$o->class 		= "phx-button-submit";
		if(!is_null($value)) $o->add($value);
		
		if(!is_null($PnameStr)) $o->name = $PnameStr;
		return $o;
	}
	
	function reset($PnameStr=null,$value=null)
	{
		$o  			=  new HTMLElements('button');
		$o->type 		= 'reset';
		$o->class 		= "phx-button-reset";
		if(!is_null($value)) $o->add($value);
		
		if(!is_null($PnameStr)) $o->name = $PnameStr;
		return $o;
	}
	
	function button($PnameStr=null,$value=null)
	{
		$o  			=  new HTMLElements('button');
		$o->class 		= "phx-button";
		if(!is_null($value)) $o->add($value);
		
		if(!is_null($PnameStr)) $o->name = $PnameStr;
		return $o;
	}
	
	function radiobox($nameStr=null){
		$o  			=  new HTMLElements('input');
		$o->type 		= 'radio';
		$o->_tag_unique = true;
		$o->class ="phx-radio";
		if(!is_null($nameStr)) $o->name = $nameStr;
		
		return $o;
	}
	
	function checkbox(){
		$o  			=  new HTMLElements('input');
		$o->type 		= 'checkbox';
		$o->_tag_unique = true;
		$o->class ="phx-checkbox";
		return $o;
	}
	
	function hidden(){
		$o  			=  new HTMLElements('input');
		$o->type 		= 'hidden';
		$o->_tag_unique = true;
		return $o;
	}
	
	function select($nameStr=null){
		$o 	=  new HTMLElements('select');
		$o->class ="phx-selectbox";
		if(!is_null($nameStr)) $o->name = $nameStr;
		return $o;
	}
	
	function option($PnameStr=null,$PvalueStr=null)
	{	
		$o = new HTMLElements('option');
		$o->class 		= "phx-select-item";
		if(!is_null($PnameStr)) $o->add($PnameStr);
		if(!is_null($PvalueStr)) $o->value = $PvalueStr;
		
		return $o;
	}
	
	function fieldset($legend)
	{
		$o  =  new HTMLElements('fieldset');
		if(!is_null($legend)){
			$oLegend  =  new HTMLElements('legend');
			$oLegend->add($legend);
			$o->add($oLegend);
			unset($oLegend);
		}
		unset($legend);
		$o->class="phx-fieldset fieldset";
		return $o;
	}
	
	function fieldgroup()
	{
			$o  		=  new HTMLElements('div');
			$o->class	= "phx-form div";
			return $o;
	}
	
	function label()
	{
		$o  =  new HTMLElements('label');
		$o->class ="phx-label";
		return $o;
	}
		
	function __destruct()
	{
		parent::__destruct();
		unset($this);
	}
	
}

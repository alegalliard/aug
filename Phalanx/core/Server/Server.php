<?php

class Server
{

	function __construct()
	{
		foreach($_SERVER as $k=>$v)
		{
			$k = strtolower($k);
			$this->$k = $v;
		}
	}

	
	function __toString(){
		echo '<pre>'.print_r($this,true).'</pre>';
	}

	
}
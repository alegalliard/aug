<?php

abstract class Controller{
	public function __construct(){	
		$this->init();
	}
        
        public function closeUnclosedTags($unclosedString){ 
		preg_match_all("/<([^\/]\w*)>/", $closedString = $unclosedString, $tags); 
		for ($i=count($tags[1])-1;$i>=0;$i--){ 
			$tag = $tags[1][$i]; 
			if (substr_count($closedString, "</$tag>") < substr_count($closedString, "<$tag>"))
				$closedString .= "</$tag>"; 
		} 
		return $closedString; 
	}
	
	abstract function init();	
}

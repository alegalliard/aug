<?php

class Item{

	private $title = "Rss",
			$description = "Feed",
			$link = null,
			$author =null,
			$pubDate =null,
			$guid =null;
			
	function __construct(){
	
	}

	public function setTitle($str){
		$this->title = $str;
	}
	
	public function setDescription($str){
		$this->description = $str;
	}
	
	public function setLink($str){
		$this->link = $str;
	}
	
	public function setAuthor($str){
		$this->author = $str;
	}
	
	public function setPubDate($str){
		$this->pubDate = $str;
	}
	
	public function setGuid($str){
		$this->guid = $str;
	}
	
	public function render()
	{
		
		return 	'<item>'."\n".
            		"<title><![CDATA[{$this->title}]]></title>\n".
            		"<link>{$this->link}</link>\n".
            		"<description><![CDATA[{$this->description}]]></description>\n".
            		"<author>{$this->author}</author>\n".
            		"<pubDate>{$this->pubDate}</pubDate>\n".
            		"<guid>{$this->guid}</guid>\n".
        		'</item>'."\n";
	
	}
	
	function __destruct(){
		unset($this);
	}
	
}
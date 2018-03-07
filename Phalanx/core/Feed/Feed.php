<?php
class Feed
{
	
	public $cache			=	false;
	
	private $title 			= 	null,
			$description 	= 	null,
			$link 			= 	null,
			$lastBuildDate 	=	null;
			
	private $itemArray 		= array();
			
	function __construct()
	{
		require(dirname(__file__).'/core/Item.php');
	}
	
	/**/
	public function setTitle($str)
	{
		$this->title 		= $str;
	}
	
	public function setDescription($str)
	{
		$this->description 	= $str;
	}
	
	public function setLink($str)
	{
		$this->link 		= $str;
	}
	
	public function setLastBuildDate($str)
	{
		$this->lastBuildDate = $str;
	}
	
	private function header(){
		header('Content-Type: text/xml;charset:'.DEFAULT_CHARSET);
	} 
	
	public function append(Item $item)
	{
		array_push($this->itemArray,$item);
	}
	
	
	public function Item(){ return new Item(); }
	
	public function render()
	{
		$rss ='<?xml version="1.0" encoding="'.DEFAULT_CHARSET.'" ?>'.
				'<?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2full.xsl"?><?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>'."\n".'<rss version="2.0">'."\n".
	   		 	'<channel>'."\n".
	        	"<title>{$this->title}</title>"."\n".
	        	"<description>{$this->description}</description>"."\n".
	        	"<link>{$this->link}</link>"."\n".
	        	"<lastBuildDate>{$this->lastBuildDate}</lastBuildDate>"."\n".
	        	"<generator>Phalanx RSS Generator 1.0</generator>"."\n".
	        	'<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="self" type="application/rss+xml" href="http://feeds.feedburner.com/imasters" /><feedburner:info xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0" uri="imasters" /><atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />'."\n";  
					
			foreach($this->itemArray as $item)
				$rss .= $item->render();
				
		$rss .= '</channel>'."\n";
		return $rss;
	}
	
	function display()
	{
		$this->header();
		die($this->render());
	}
	
	function __destruct(){
		unset($this);
	}
	
}


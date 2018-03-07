<?php
class String{
		
	public static function escape($var){
		if(!isSet($var) || is_null($var))
			echo '';
		else
			echo trim($var);
	}
	
	
	public static function truncate($string, $maxchar=140, $delimiter='...'){
		if(strlen($string) > $maxchar)
			return (String) substr($string, 0, $maxchar) . $delimiter;
		
		return (String) $string;
	}	

	public static function toURL($str){
		$p =  explode(',','À,Á,Â,Ã,Ä,Å,Æ,Ç,È,É,Ê,Ë,Ì,Í,Î,Ï,Ð,Ñ,Ò,Ó,Ô,Õ,Ö,Ø,Ù,Ú,Û,Ü,Ý,Þ,ß,à,á,â,ã,ä,å,æ,ç,è,é,ê,ë,ì,í,î,ï,ð,ñ,ò,ó,ô,õ,ö,ø,ù,ú,û,ý,ý,þ,ÿ');
		$m =  explode(',','a,a,a,a,a,a,a,c,e,e,e,e,i,i,i,i,d,n,o,o,o,o,o,o,u,u,u,u,y,b,s,a,a,a,a,a,a,a,c,e,e,e,e,i,i,i,i,d,n,o,o,o,o,o,o,u,u,u,y,y,b,y');
		return trim(strtolower(str_replace(array(" ","-","?",".","!",","),array("-","-","","","","-"),str_replace($p,$m,$str))));
	}
	
}

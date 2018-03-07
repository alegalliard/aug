<?php
/*
	Cria o formulário e fica responsável pela validação e pela formatação dos dados;
*/
abstract class Forms
{

	# Variáveis de instancia -  Objetos 
	protected $_post_data=Null; 	#Array dos valores dos campos
	
	#--
	protected $_vars=Array(); # Array dos html dos campos
	
	function __construct($post_data=Null){
		if(!is_null($post_data)) $this->_post_data = $post_data;
	}	
	
	# retorna os objetos no formato de HTML
	function html(){}
	
	# verifica se os dados dos formulários são valido
	function is_valid(){}
	
	#pega os valotes relacionados aos campos
	function cleaned_data(){
		return $this->_post_data;
	}
	
	function __destruct(){
		unset($this);
	}

}
<?php
class DGrid{
		public $width				= '99%', 
				$cellpadding		= 	1,
				$cellspacing		= 	1,
				$border				= 	1;
		
		function __construct()
		{
				$this->_table 				= new  HTMLElements('table');
				$this->_table->width		= $this->width;	
				$this->_table->cellpadding	= $this->cellpadding;
				$this->_table->cellspacing	= $this->cellspacing;
				$this->_table->border 		= $this->border;

		}
		
		function proprieties($k,$v)
		{
				return $this->_table->$k = $v;
		}
		
		function caption($str){
			$o = new  HTMLElements('caption');
			$o->add($str);
			return $o;
		}
		
		function thead(){
			$o = new  HTMLElements('thead');
			return $o;
		}
		
		function tbody(){
			$o = new  HTMLElements('tbody');
			return $o;
		}
		
		function tfoot(){
			$o = new  HTMLElements('tfoot');
			return $o;
		}
		
		function row()
		{
			$o = new  HTMLElements('tr');
			return $o;
		}
		
		function cell($e){
			$o = new  HTMLElements('td');
			$o->add($e);
			return $o;
		}
		
		function add(HTMLElements $e)
		{
			return $this->_table->add($e);
		}
		
		function render(){
			return $this->_table->render();
		}
	
}


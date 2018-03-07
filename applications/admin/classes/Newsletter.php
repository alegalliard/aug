<?php

	final class Newsletter {
		
		private function __construct(){}
		
		public static function get($page=FALSE){
			$mdl = Model::Factory('newsletter');
			
			if($page !== false){
				$offset = ($page-1) * 25;
				$mdl->limit("{$offset}, 25");	
			}
			
			$mdl->order("id DESC");
			return $mdl->all();
		}
		
		public static function get_total_pages(){
			$m = Model::Factory('newsletter');
			$m->fields('COUNT(*) AS qtd');
			$data = $m->get();
			
			return ceil($data->qtd/25);
		}
		
	}

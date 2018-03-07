<?php

	class BillBoard {
		
		private function __construct(){}
		
		public static function get($id = null){
			
			$mdl = Model::Factory('billboard');
			$mdl->fields('*');
			$mdl->order('RAND()');
			$mdl->limit('0, 100');
			if(isset($id)){
				$mdl->where("id='{$id}'");
				return $mdl->get();
			}
			return $mdl->all();
			
		}
		
	}

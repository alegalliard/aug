<?php

	class BillBoard {
		
		private function __construct(){}
		
		public static function get($id = null){
			
			$mdl = Model::Factory('billboard');
			if(isset($id)){
				$mdl->where("id='{$id}'");
				return $mdl->get();
			}
			return $mdl->all();
			
		}
		
	}

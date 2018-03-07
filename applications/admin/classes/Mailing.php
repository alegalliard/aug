<?php

	class Mailing {
		
		private function __construct(){}
		
		public static function get($id = null){
			
			$mdl = Model::Factory('mailing');
			if(isset($id)){
				$mdl->where("id='{$id}'");
				return $mdl->get();
			}
			return $mdl->all();
			
			
		}
		
	}

<?php

	class PressReleases {
		
		private function __construct(){}
		
		public static function get($id = null){
			
			$mdl = Model::Factory('pressreleases');
			if(isset($id)){
				$mdl->where("id='{$id}'");
				return $mdl->get();
			}
			$mdl->order('id DESC');
			return $mdl->all('ORDER BY id ASC');
			
			
		}
		
	}

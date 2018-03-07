<?php

	class Testimonials {
		
		private function __construct(){}
		
		public static function get($id = null){
			
			$mdl = Model::Factory('testimonials');
			if(isset($id)){
				$mdl->where("id='{$id}'");
				return $mdl->get();
			}
			return $mdl->all();
			
			
		}
		
	}

<?php

	class WantToAdoptController extends Controller {
		
		private $views;
		private $get;
		
		public function init(){
			$this->get = Request::get();
			define("PERMISSIONS", $this->session->user->level);
			$this->views = new Views(new Template("admin"));
		}
		
		public function show(){
			$m = Model::Factory('want_to_adopt wta');
			$m->innerJoin('cats c', 'c.id = wta.cats_id');
			$m->fields('wta.*', 'c.picture AS image', 'c.name AS cat_name');
			
			$this->views->data = $m->all();
			$this->views->display('want_to_adopt_list.phtml');
		}
		
		public function delete(){
			$m = Model::Factory('want_to_adopt');
			$m->where("id=" . $this->get->id);
			$m->delete();
			
			Request::redirect(HOST . 'adm/querem-adotar/');
		}
		
	}

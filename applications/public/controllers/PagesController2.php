<?php

	class PagesController2 extends Controller {
		
		private $views;
		private $get;

		public function init(){
			$this->get = Request::get();
		}

		public function display_page(){
			$mdl = Model::Factory('pages');
			$mdl->where("slug='{$this->get->page_slug}'");
            
			$data = $mdl->get();
			
			if(! $data){
				throw new PhxException('404');
			}
				
			
			$template = new Template("public");
			$template->og = new stdClass;
			$template->og->img = HOST.'templates/public/css/images/logo.png';
			$template->og->title = $data->name;
			$template->og->description = substr(strip_tags($data->content), 0, 150);
			
			$this->views = new Views($template);
			$this->views->data = $data;
            if(isset($_GET['version']) || !empty($_GET['version'])){
                $this->views->display("novo/generic_page.phtml");
            } else {
                $this->views->display("generic_page.phtml");
            }
			
		}
		
		
	}

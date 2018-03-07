<?php

	class PagesController extends Controller {

		private $views;
		private $post;
		private $get;
		private $session;

		public function init(){
			$this->get = Request::get();
			$this->post = Request::post(false);
			$this->session = new Session;
			if($this->session->logged_in !== true)
				Request::redirect(HOST.'adm/login');
            define("PERMISSIONS", $this->session->user->level);
		}

		public function show(){
			$this->views = new Views(new Template("admin"));
			Phalanx::loadClasses('Pages');
			$this->views->data = Pages::get();
			$this->views->display('pages_list.phtml');
		}

		public function form(){
			$this->views = new Views(new Template("admin"));
			Phalanx::loadClasses('Pages');
			$this->views->data = Pages::get($this->get->page_id);
			$this->views->display('pages_form.phtml');
		}

		public function save(){
			$mdl = Model::Factory('pages');
			$mdl->name = $this->post->name;
			$mdl->slug = $this->post->slug;
			$mdl->content = $this->post->content;
			$mdl->alias = $this->post->alias;
			//$mdl->inactive = $this->post->inactive;

			if(isset($this->post->page_id)){
				$mdl->where("id='{$this->post->page_id}'");
				$mdl->update();
				$id = $this->post->page_id;
			} else {
				$id = $mdl->insert();
			}

			Request::redirect(HOST . 'adm/paginas/editar/' . $id);

		}

		public function delete(){
			$m = Model::Factory('pages');

			$m->inactive = 1;
                        $m->where("id=".$this->get->page_id);
                        $m->update();

			Request::redirect(HOST . 'adm/paginas/');
		}
	}

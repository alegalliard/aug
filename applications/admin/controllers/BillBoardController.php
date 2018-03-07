<?php

	class BillBoardController extends Controller {
		
		private $views;
		private $post;
		private $files;
		private $session;
		private $get;
		
		public function init(){
			$this->get = Request::get();
			$this->files = Request::files();
			$this->post = Request::post();
			$this->session = new Session;
			if($this->session->logged_in !== true)
				Request::redirect(HOST.'adm/login');
            
            define("PERMISSIONS", $this->session->user->level);
		}
		
		public function show(){
			$this->views = new Views(new Template("admin"));
			Phalanx::loadClasses('BillBoard');
			$this->views->data = BillBoard::get();
			$this->views->display('billboard_list.phtml');
		}
		
		public function form(){
			$this->views = new Views(new Template("admin"));
			$this->views->title = "Adicionar destaque";
			$this->views->display('billboard_form.phtml');
		}
		
		public function save(){
			$mdl = Model::Factory('billboard');
			if(isset($this->files->picture->name) and $this->files->picture->name != ''){
				$dirname = UPLOAD_DIR . 'billboards' . SEPD;
				$filename = date('YmdHis').md5($this->files->picture->name).'.'.end(explode('.', $this->files->picture->name));
				if(! is_dir($dirname))
					mkdir($dirname, 0777, true);
					
				move_uploaded_file($this->files->picture->tmp_name, $dirname.$filename);	
			}
			
			$mdl->image = $filename;
			$mdl->link = $this->post->link;
			$status = $mdl->insert();
			
			Request::redirect(HOST . 'adm/destaques/');
		}
		
		public function delete(){
			$m = Model::Factory('billboard');
			$m->where("id={$this->get->id}");
			$m->delete();
			
			Request::redirect(HOST . 'adm/destaques/');
		}
		
	}

<?php

	class NewsController extends Controller {
		
		private $views;
		private $post;
		private $files;
		private $get;
		private $session;
		
		public function init(){
			$this->get = Request::get();
			$this->post = Request::post(false);
			$this->files = Request::files();
			$this->session = new Session;
			if($this->session->logged_in !== true)
				Request::redirect(HOST.'adm/login');
            
            define("PERMISSIONS", $this->session->user->level);
		}
		
		public function show(){
			$this->views = new Views(new Template("admin"));
			Phalanx::loadClasses('News');
			$this->views->data = News::get();
			$this->views->display('news_list.phtml');
		}
		
		public function form(){
			$this->views = new Views(new Template("admin"));
			Phalanx::loadClasses('News');
			$this->views->data = News::get($this->get->id);
			$this->views->display('news_form.phtml');
		}
		
		public function save(){
			$mdl = Model::Factory('news');
			$mdl->title = $this->post->title;
			$mdl->heading = $this->post->heading;
			$mdl->content = $this->post->content;
			
			if(isset($this->files->picture->name) and $this->files->picture->name != ''){
				$dirname = UPLOAD_DIR . 'news' . SEPD;
				$filename = date('YmdHis').md5($this->files->picture->name).'.'.end(explode('.', $this->files->picture->name));
				if(! is_dir($dirname))
					mkdir($dirname, 0777, true);
					
				move_uploaded_file($this->files->picture->tmp_name, $dirname.$filename);
				$mdl->picture = $filename;	
			}
			
			if(isset($this->post->id)){
				$mdl->where("id='{$this->post->id}'");
				$mdl->update();
				$id = $this->post->id;
			} else {
				$id = $mdl->insert();
			}
			
			Request::redirect(HOST . 'adm/materias/editar/' . $id);
			
		}
		
		public function delete(){
			$m = Model::Factory('news');
			$m->where('id=' . $this->get->id);
			$m->delete();
			Request::redirect(HOST . 'adm/materias/');
		}
	}

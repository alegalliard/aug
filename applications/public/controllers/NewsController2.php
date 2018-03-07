<?php

	class NewsController2 extends Controller {
		
		private $views,
				$get;
		
		public function init(){
			$this->get = Request::get();
		}
		
		public function show_all(){
			$template = new Template("public", "novo/default.phtml");
			$template->og = new stdClass;
			$template->og->title = "Adote um Gatinho - Matérias";
			$template->og->description = 'Algumas matérias da equipe de Adote um Gatinho';
			$template->og->img = HOST.'templates/public/css/images/logo.png';
			
			$this->views = new Views($template);
			
			$m = Model::Factory('news');
			$m->order("id DESC");
			$this->views->data = $m->all();
			
			$this->views->display("novo/news_list.phtml");
		}
		
		public function show_specific(){
			$m = Model::Factory('news');
			$m->where('id=' . $this->get->id);
			$data = $m->get();

			if(! $data)
				Request::redirect(HOST . 'materias');
			
			$template = new Template("public", "novo/default.phtml");
			$template->og = new stdClass;
			$template->og->title = $data->title;
			$template->og->description = $data->heading;
			$template->og->img =  MEDIA_DIR.'uploads/news/'.$data->picture;
			
			$this->views = new Views($template);
			$this->views->data = $data;
			$this->views->display('novo/news_reading.phtml');
		}
		
	}

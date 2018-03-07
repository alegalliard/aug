<?php

	class MailingController extends Controller {
		
		private $views,
				$get;
		
		public function init(){
			$this->get = Request::get();
		}
		
		public function show_all(){
			$template = new Template("public", "default.phtml");
			$template->og = new stdClass;
			$template->og->title = "Boletins - Adote um Gatinho";
			$template->og->description = 'Algumas matérias da equipe de Adote um Gatinho';
			$template->og->img = HOST.'templates/public/css/images/logo.png';
			
			$this->views = new Views($template);
			
			$m = Model::Factory('mailing');
			$m->order("id DESC");
			$this->views->data = $m->all();
			
			$this->views->display("mailing_list.phtml");
		}
		
		public function show_specific(){
			$m = Model::Factory('mailing');
			$m->where('id=' . $this->get->id);
			$data = ($m->get());

			if(! $data)
				Request::redirect(HOST . 'boletins');
			
			$template = new Template("public", "default.phtml");
			$template->og = new stdClass;
			$template->og->title = $data->title;
			$template->og->description = $data->heading;
			$template->og->img =  MEDIA_DIR.'uploads/mailing/'.$data->picture;
			$this->views = new Views($template);
			$this->views->data = ($data);
			$this->views->display('mailing_reading.phtml');
		}
		
	}

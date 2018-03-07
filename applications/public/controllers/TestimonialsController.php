<?php

	class TestimonialsController extends Controller {
		
		private $views,
				$get;
		
		public function init(){
			$this->get = Request::get();
		}
		
		public function show_all(){
			$template = new Template("public", "default.phtml");
			$template->og = new stdClass;
			$template->og->title = "Depoimentos - Adote um Gatinho";
			$template->og->description = 'Depoimentos das pessoas que adotaram um gatinho conosco';
			$template->og->img = HOST.'templates/public/css/images/logo.png';
			
			$this->views = new Views($template);
			
			$m = Model::Factory('testimonials');
			$m->order("id DESC");
			$this->views->data = $m->all();
			
			$this->views->display("testimonials_list.phtml");
		}
		
		public function show_specific(){
			$m = Model::Factory('testimonials');
			$m->where('id=' . $this->get->id);
			$data = $m->get();

			if(! $data)
				Request::redirect(HOST . 'depoimentos');
			
			$template = new Template("public", "default.phtml");
			$template->og = new stdClass;
			$template->og->title = $data->title;
			$template->og->description = $data->heading;
			$template->og->img =  MEDIA_DIR.'uploads/testimonials/'.$data->picture;
			$this->views = new Views($template);
			$this->views->data = $data;
			$this->views->display('testimonials_reading.phtml');
		}
		
	}

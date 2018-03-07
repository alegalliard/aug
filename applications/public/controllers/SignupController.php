<?php
	
	class SignupController extends Controller {
		
		private $views,
				$post;
		
		public function init(){
			$this->post = Request::post();
		}
		
		public function form(){
			$template = new Template('public', 'default.phtml');
			$template->og = new stdClass;
			$template->og->img = HOST.'templates/public/css/images/logo.png';
			$template->og->title = 'Adote um Gatinho';
			$template->og->description = 'Inscreva-se na nossa newsletter';
			
			$this->views = new Views($template);
			$this->views->display('newsletter_form.phtml');
		}
		
		public function proccess(){
			$m = Model::Factory('newsletter');
			$m->name = $this->post->name;
			$m->email = $this->post->email;
			$m->opt_in_date = date('Y-m-d H:i:s');
			$insertion_status = $m->insert();
			
			if($insertion_status)
				Request::redirect(HOST . 'cadastre-se/cadastro-finalizado-com-sucesso');
			else
				Request::redirect(HOST . 'cadastre-se/erro-ao-finalizar-cadastro');
		}
		
		public function success(){
			$this->views = new Views(new Template('public', 'default.phtml'));
			$this->views->display('newsletter_success.phtml');
		}
		
		public function error(){
			$this->views = new Views(new Template('public', 'default.phtml'));
			$this->views->display('newsletter_error.phtml');
		}
		
	}

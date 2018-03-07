<?php

	class AccountingController extends Controller {
		
		private $views;
		private $session;
		private $post;
		private $get;
		
		public function init(){
			$this->session = new Session;
			
			if($this->session->logged_in !== true)
				Request::redirect(HOST.'adm/login');
			
			$this->get = Request::get();
			$this->post = Request::post();
			
            define("PERMISSIONS", $this->session->user->level);
			$this->views = new Views(new Template("admin"));
        
		}
		
		
		public function ShowAll(){
			Phalanx::loadClasses('Accounting');	
				
			$current_year = ($this->get->year) ? $this->get->year : date('Y');
            
            
			
			$this->views->data = Accounting::getByYear($current_year);
			$this->views->current_year = $current_year;
			$this->views->display('accounting_list.phtml');
		}
		
		
		public function Add(){
            
			$this->views->display('accounting_add.phtml');
		}
		
		public function Save(){
            
			$amount = $this->post->value;
			$amount = str_replace('R$', '', $amount);
			$amount = str_replace('.', '', $amount);
			$amount = str_replace(',', '.', $amount);
			$amount = str_replace(' ', '', $amount);
			
			$m = Model::Factory('accounting');
			$m->date = preg_replace('/^(\d{2})\/(\d{2})\/(\d{4})$/i', '$3-$2-$1', $this->post->date);
			$m->description = $this->post->description;
			$m->amount = $amount;
			$m->insert();
			
			Request::redirect(HOST . 'adm/prestacao-de-contas');
		}
                
                public function Delete()
                {
                    
                    $m = Model::Factory('accounting');

                    $m->inactive = 1;
                    $m->where("id=".$this->get->id);
                    $m->update();

                    Request::redirect(HOST . 'adm/prestacao-de-contas');
                }
		
	}

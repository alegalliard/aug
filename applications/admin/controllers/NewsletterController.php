<?php

	class NewsletterController extends Controller {
		
		private $views;
		private $session;
		private $get;
		private $post;
		
		public function init(){
			$this->session = new Session;
			if($this->session->logged_in !== true)
				Request::redirect(HOST.'adm/login');
			
			
			$this->get = Request::get();
			$this->post = Request::post();
            define("PERMISSIONS", $this->session->user->level);

				
			Phalanx::loadClasses('Newsletter');
		}
		
		public function show(){
			$this->views = new Views(new Template("admin"));
			
			if(! empty($this->post->field)){
				$this->views->show_page_selector = false;
				
				$m = Model::Factory("newsletter");
				$m->where("name LIKE '%{$this->post->field}%' OR email LIKE '%{$this->post->field}%'");
				$this->views->data = $m->all();
				
				$this->views->search_params = $this->post->field;
				
			} else {
				$this->views->show_page_selector = true;
				
				if($this->get->page) $current_page = $this->get->page;
				else $current_page = 1;
				
				$this->views->data = Newsletter::get($current_page);
				
				if($this->session->newsletter_pages != null) $total_pages = $this->session->newsletter_pages;
				else $total_pages =  Newsletter::get_total_pages();
				
				$this->session->newsletter_pages = $this->views->total_pages = $total_pages;
				
				$this->views->current_page = $current_page;	
			}
			
			$this->views->display('newsletter_report.phtml');
		}
		
		public function report(){
			$data = Newsletter::get(FALSE);
			$html = '<table>
						<tr>
							<th>nome</th>
							<th>email</th>
							
						</tr>';
			foreach($data as $row){
				$html .= "<tr>
							<td>{$row->name}</td>
							<td>{$row->email}</td>
						</tr>";
			}
			$html .= '</table><script type="text/javascript"><!--window.close()--></script>';
			
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment;Filename=relatorio_newsletter".date('Y_m_d_-_H_i_s').".xls");
			echo $html;
		}
		
		public function add(){
			$this->views = new Views(new Template("admin"));
			$this->views->display("newsletter_form.phtml");
		}
		
		public function save(){
			$m = Model::Factory('newsletter');
			$m->email = $this->post->email;
			$m->name = $this->post->user;
			$m->insert();
			
			Request::redirect(HOST . 'adm/newsletter');
			
		}
		
		public function delete(){
			$m = Model::Factory('newsletter');
			$m->where("id='{$this->get->id}'");
			$m->delete();
			
			Request::redirect(HOST . 'adm/newsletter');
		}
		
	}

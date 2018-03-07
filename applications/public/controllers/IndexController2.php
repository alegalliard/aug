<?php
/*NOVO*/
class IndexController2 extends Controller {
                
    
    private $get;
    private $session;

    public function init()
    {
        $this->get = Request::get();
        $this->session = new Session();	
        
    }

    public function index()
    {
        
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Adoção de gatinhos para São Paulo e ABC';
        $template->og->title = 'Adote um Gatinho';

        $this->views = new Views($template);
        $this->views->display("novo/index.phtml");
    }
    
    public function how()
    {
        
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Instruções para adotar um gatinho na ONG';
        $template->og->title = 'Como adotar um gatinho';

        
        
        $template = new Template("public", "novo/default.phtml");
		$this->views = new Views($template);
        $this->views->display('novo/adopt_how.phtml');
        
    }
    
    public function one_two()
    {
        
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Vale a pena adotar um ou dois gatos';
        $template->og->title = 'Um ou dois gatinhos';

        
        
        $template = new Template("public", "novo/default.phtml");
		$this->views = new Views($template);
        $this->views->display('novo/adopt_one_or_two.phtml');
        
    }
    
    public function felv()
    {
        
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Saiba mais sobre o FeLV, leucemia felina';
        $template->og->title = 'FELV - Leucemia felina';
        
        $template = new Template("public", "novo/default.phtml");
		$this->views = new Views($template);
        $this->views->display('novo/felv.phtml');
        
    }
    public function fiv()
    {
        
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Saiba mais sobre FIV, a AIDS felina';
        $template->og->title = 'FIV - AIDS felina';
        
        $template = new Template("public", "novo/default.phtml");
		$this->views = new Views($template);
        $this->views->display('novo/fiv.phtml');
        
    }
    
    public function about()
    {
        
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Quem somos';
        $template->og->title = 'Quem somos';
        
        $template = new Template("public", "novo/default.phtml");
		$this->views = new Views($template);
        $this->views->display('novo/about.phtml');
        
    } 
    
    public function help()
    {
        
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'O que faço para ajudar a AUG';
        $template->og->title = 'Quero ajudar';
        
        $template = new Template("public", "novo/default.phtml");
		$this->views = new Views($template);
        $this->views->display('novo/wanna_help.phtml');
        
    }
    public function rescue()
    {
        
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Resgate';
        $template->og->title = 'Resgate de gatinhos';
        
        $template = new Template("public", "novo/default.phtml");
		$this->views = new Views($template);
        $this->views->display('novo/rescue.phtml');
        
    }
    
    
    
    

    public function cats_load()
    {
        Phalanx::loadClasses('Cats');

        $template = new Template("public", "novo/cats_full_page.phtml");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Adoção de gatinhos para São Paulo e ABC';
        $template->og->title = 'Adote um Gatinho';

        $page = (isset($this->get->page)) ? $this->get->page : 0;

        $this->views = new Views($template);
        
        $this->views->display("novo/cats.phtml");
    }

    public function cats()
    {
        Phalanx::loadClasses('Cats');

        $template = new Template("public", "novo/index.phtml");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Adoção de gatinhos para São Paulo e ABC';
        $template->og->title = 'Adote um Gatinho';

        $page = (isset($this->get->page)) ? $this->get->page : 0;

        $this->views = new Views($template);
        
        $this->views->display("novo/cats.phtml");
    }
    

    public function special_cats()
    {
        Phalanx::loadClasses('Cats');

        $template = new Template("public", "novo/default.phtml");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Adoção de gatinhos para São Paulo e ABC';
        $template->og->title = 'Adote um Gatinho';

        $page = (isset($this->get->page)) ? $this->get->page : 0;

        $this->views = new Views($template);

        $this->views->display("novo/cats_special.phtml");
    }

    public function adopted_cats()
    {
        Phalanx::loadClasses('Cats');

        $template = new Template("public", "novo/cats_full_page.phtml");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Adoção de gatinhos para São Paulo e ABC';
        $template->og->title = 'Adote um Gatinho';

        $this->views = new Views($template);

        $this->views->display("novo/adopted_cats.phtml");
    }

    private function get_total_pages()
    {
        $m = Model::Factory('cats');
        $m->fields("COUNT(id) AS qtde");
        $m->where("status=0 AND special=0 AND section=1 AND inactive=0");
        $total = $m->get()->qtde;
        $total_pages = ceil($total/30);

        $this->session->total_pages = $total_pages;

        return $total_pages;
    }

    private function get_total_adopted_pages()
    {
        $m = Model::Factory('cats');
        $m->fields("COUNT(id) AS qtde");
        $m->where("status!=0 AND special=0 AND inactive=0");
        $total = $m->get()->qtde;
        $total_pages = ceil($total/30);

        $this->session->total_adopted_pages = $total_pages;

        return $total_pages;
    }
    
    private function get_total_special_pages()
    {
        $m = Model::Factory('cats');
        $m->fields("COUNT(id) AS qtde");
        $m->where("special=1 AND inactive=0");
        $total = $m->get()->qtde;
        $total_pages = ceil($total/30);

        $this->session->total_adopted_pages = $total_pages;

        return $total_pages;
    }
    
}
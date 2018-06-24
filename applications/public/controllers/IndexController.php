<?php
/*NOVO*/
class IndexController extends Controller {


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
        $this->views->display("index.phtml");
    }

    public function how()
    {

        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Instruções para adotar um gatinho na ONG';
        $template->og->title = 'Como adotar um gatinho';


        $template = new Template("public", "default.phtml");
		    $this->views = new Views($template);
        $this->views->display('adopt_how.phtml');

    }

    public function one_two()
    {

        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Vale a pena adotar um ou dois gatos';
        $template->og->title = 'Um ou dois gatinhos';
        $template = new Template("public", "default.phtml");
		    $this->views = new Views($template);
        $this->views->display('adopt_one_or_two.phtml');

    }

    public function esporotricose()
    {
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Esporotricose - doença causada por um fungo';
        $template->og->title = 'Esporotricose';

        $template = new Template("public", "default.phtml");
		    $this->views = new Views($template);
        $this->views->display('esporotricose.phtml');
    }

    public function mitos()
    {
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Mitos sobre os gatos ferais';
        $template->og->title = 'Mitos e verdades sobre gatos';

        $template = new Template("public", "default.phtml");
		    $this->views = new Views($template);
        $this->views->display('mitos-verdades-gatos-ferais.phtml');
    }

    public function mamadeiras()
    {
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Cuidados com bebês gatinhos';
        $template->og->title = 'Mamadeira para gatos';

        $template = new Template("public", "default.phtml");
		    $this->views = new Views($template);
        $this->views->display('mamadeiras.phtml');
    }

    public function felv()
    {
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Saiba mais sobre o FeLV, leucemia felina';
        $template->og->title = 'FELV - Leucemia felina';

        $template = new Template("public", "default.phtml");
		    $this->views = new Views($template);
        $this->views->display('felv.phtml');
    }

    public function fiv()
    {
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Saiba mais sobre FIV, a AIDS felina';
        $template->og->title = 'FIV - AIDS felina';

        $template = new Template("public", "default.phtml");
		    $this->views = new Views($template);
        $this->views->display('fiv.phtml');
    }

    public function pif()
    {
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Saiba mais sobre PIF';
        $template->og->title = 'PIF - Peritonite Infecciosa Felina';

        $template = new Template("public", "default.phtml");
		    $this->views = new Views($template);
        $this->views->display('pif.phtml');
    }

    public function about()
    {
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Quem somos';
        $template->og->title = 'Quem somos';

        $template = new Template("public", "default.phtml");
		    $this->views = new Views($template);
        $this->views->display('about.phtml');
    }

    public function ready()
    {
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Preparado para adotar';
        $template->og->title = 'Preparado para adotar';

        $template = new Template("public", "default.phtml");
		    $this->views = new Views($template);
        $this->views->display('ready.phtml');
    }

    public function policy()
    {
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Política de adoção de gatinhos';
        $template->og->title = 'Política de adoção';

        $template = new Template("public", "default.phtml");
		    $this->views = new Views($template);
        $this->views->display('policy.phtml');
    }

    public function help()
    {
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'O que faço para ajudar a AUG';
        $template->og->title = 'Quero ajudar';

        $template = new Template("public", "default.phtml");
		    $this->views = new Views($template);
        $this->views->display('wanna_help.phtml');
    }

    public function rescue()
    {
        $template = new Template("public");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Resgate';
        $template->og->title = 'Resgate de gatinhos';
        $template = new Template("public", "default.phtml");
		    $this->views = new Views($template);
        $this->views->display('rescue.phtml');
    }

    public function cats_load()
    {
        Phalanx::loadClasses('Cats');
        $template = new Template("public", "cats_full_page.phtml");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Adoção de gatinhos para São Paulo e ABC';
        $template->og->title = 'Adote um Gatinho';
        $page = (isset($this->get->page)) ? $this->get->page : 0;
        $this->views = new Views($template);

        $this->views->display("cats.phtml");
    }

    public function cats_petz()
    {
        Phalanx::loadClasses('Cats');
        $template = new Template("public", "cats_full_page.phtml");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Adoção de gatinhos para São Paulo e ABC';
        $template->og->title = 'Adote um Gatinho';
        $page = (isset($this->get->page)) ? $this->get->page : 0;
        $this->views = new Views($template);
        $this->views->display("petz.phtml");
    }


    public function cats()
    {
        Phalanx::loadClasses('Cats');
        $template = new Template("public", "index.phtml");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Adoção de gatinhos para São Paulo e ABC';
        $template->og->title = 'Adote um Gatinho';
        $page = (isset($this->get->page)) ? $this->get->page : 0;
        $this->views = new Views($template);

        $this->views->display("cats.phtml");
    }

    public function special_cats()
    {
        Phalanx::loadClasses('Cats');
        $template = new Template("public", "default.phtml");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Adoção de gatinhos para São Paulo e ABC';
        $template->og->title = 'Adote um Gatinho';
        $page = (isset($this->get->page)) ? $this->get->page : 0;
        $this->views = new Views($template);
        $this->views->display("cats_special.phtml");
    }
    public function adopted_cats()
    {
        Phalanx::loadClasses('Cats');
        $template = new Template("public", "cats_full_page.phtml");
        $template->og = new stdClass;
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Adoção de gatinhos para São Paulo e ABC';
        $template->og->title = 'Adote um Gatinho';
        $this->views = new Views($template);
        $this->views->display("adopted_cats.phtml");
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

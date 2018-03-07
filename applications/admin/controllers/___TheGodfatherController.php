<?php

class TheGodfatherController extends Controller {

    private $get,
            $post,
            $views,
            $session;

    public function init()
    {
        $this->get = Request::get();
        $this->post = Request::post();
        $this->files = Request::files();
        $this->session = new Session;
        
        if($this->session->logged_in !== true) Request::redirect(HOST.'adm/login');	

        Phalanx::loadClasses('Godfather');
    }

    public function show()
    {
        if (!$this->get->page) Request::redirect(HOST . 'adm/padrinhos/all/1');
        
        $this->views = new Views(new Template("admin"));
        $this->views->total_pages  = Godfather::get_pages("godfather", "inactive=0");
        $this->views->current_page = isset($this->get->page) ? $this->get->page : 1;
        $this->views->title  = "Padrinhos (Todos)";
        $this->views->search = $this->post->search;
        $this->views->order  = $this->post->order;
        
        $parameters = "inactive=0 AND (nome LIKE '%{$this->post->search}%' OR id LIKE '%{$this->post->search}%')";
        
        $this->views->data = Godfather::get($parameters, $this->views->current_page, $this->post->order);
  
        $this->views->display('godfather_list.phtml');
    }

    public function form()
    {
        $this->views = new Views(new Template("admin"));
        
        if(isset($this->get->id)){
            $this->views->title = "Editar padrinho";
            $this->views->data = Godfather::get($this->get->id);
        } else {
            $this->views->title = "Adicionar padrinho";
        }
        
        $this->views->display('godfather_form.phtml');
    }


    public function save()
    {
        $m = Model::Factory('godfather');

        $this->post->data_inicio = preg_replace('/^(\d{2]})\/(\d{2])\/(\d{4])$/i', "$3-$2-$1", $this->post->data_inicio);

        foreach($this->post as $k => $v)
            $m->{$k} = $v;

        if(isset($this->post->id)){
            $m->where("id='{$this->post->id}'");
            $m->update();
        } else {
            $m->insert();
        }
        
        Request::redirect(HOST . 'adm/padrinhos');
    }
    
    public function delete()
    {
        $m = Model::Factory('godfather');
        
        $m->inactive = 1;
        $m->where("id=".$this->get->id);
        $m->update();

        Request::redirect(HOST . 'adm/padrinhos');
    }

}

<?php

class SpecialCatsController extends Controller {

    private $views;
    private $post;
    private $get;
    private $files;
    private $session;

    public function init(){
        $this->get = Request::get();
        $this->post = Request::post();
        $this->files = Request::files();
        $this->session = new Session;

        if($this->session->logged_in !== true)
                Request::redirect(HOST.'adm/login');
        
        define("PERMISSIONS", $this->session->user->level);
    }

    public function show(){
        $this->views = new Views(new Template("admin"));

        Phalanx::loadClasses('Cats');
        $this->views->data = Cats::get_specials($this->session->user->id, $this->post->search, $this->post->order);
        $this->views->search = $this->post->search;
        $this->views->special = true;

        $this->views->display('cats_list.phtml');
    }

    public function form(){
        $this->views = new Views(new Template("admin"));

        if(isset($this->get->cat_id)){
                Phalanx::loadClasses('Cats');
                $this->views->data = Cats::get($this->get->cat_id, $this->session->user->id);
                $this->views->title = "Editar gato";	
        } else {
                $this->views->title = "Adicionar gato";
        }

        $this->views->special = true;
        $this->views->display('cats_form.phtml');
    }

    public function save(){
        if(isset($this->files->cat_picture['name']) and $this->files->cat_picture['name'] != ''){
                $dirname = UPLOAD_DIR . 'cats' . SEPD;
                $filename = date('YmdHis').md5($this->files->cat_picture['name']).'.'.end(explode('.', $this->files->cat_picture['name']));
                if(! is_dir($dirname))
                        mkdir($dirname, 0777, true);

                move_uploaded_file($this->files->cat_picture['tmp_name'], $dirname.$filename);	
        }


        $mdl = Model::Factory('cats');
        $mdl->name = $this->post->cat_name;
        $mdl->description = $this->post->cat_desc;
        $mdl->full_description = $this->post->cat_full_desc;
        $mdl->social = $this->post->social;
        $mdl->playful = $this->post->playful;
        $mdl->lovely = $this->post->lovely;
        $mdl->special = 1;

        if(isset($filename))
                $mdl->picture = $filename;

        if(isset($this->post->id)){
                $mdl->where("id='{$this->post->id}'");
                $mdl->update();
        } else {
                $mdl->insert();	
        }
        Request::redirect(HOST.'adm/gatos-especiais/');
    }

    public function reserved(){
        Phalanx::loadClasses('Cats');

        $this->views = new Views(new Template("admin"));
        $this->views->special = 1;
        $this->views->data = Cats::get_reserved(1, $this->session->user->id);
        $this->views->display('reserved_cats_list.phtml');
    }

    public function adopted(){
        Phalanx::loadClasses('Cats');

        $this->views = new Views(new Template("admin"));
        $this->views->special = 1;
        $this->views->data = Cats::get_adopted(1, $this->session->user->id);
        $this->views->display('adopted_cat_list.phtml');
    }


}

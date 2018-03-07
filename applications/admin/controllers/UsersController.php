<?php

class UsersController extends Controller {

    private $views;
    private $post;
    private $get;
    private $session;

    public function init()
    {
        Phalanx::loadClasses('Users');

        $this->get = Request::get();
        $this->post = Request::post();
        $this->session = new Session;
        
        if($this->session->logged_in !== true) Request::redirect(HOST.'adm/login');	
        
        
        define("PERMISSIONS", $this->session->user->level);
        
    }

    public function show()
    {
        $this->views = new Views(new Template("admin"));

        $this->views->data = Users::get();
        $this->views->display('users_list.phtml');
    }

    public function form()
    {
        $this->views = new Views(new Template("admin"));

        $this->views->title = "Adicionar voluntário";

        if(isset($this->get->uid))
        {
            $this->views->title = "Editar voluntário";
            $this->views->data = Users::get($this->get->uid);
        }

        $this->views->display('users_form.phtml');
    }
    
    public function detect_level()
    {
        $mdl = Model::Factory('users');
        $mdl->level = $this->post->level;
    }

    public function save()
    {
        $mdl = Model::Factory('users');

        $mdl->login = $this->post->login;
        $mdl->email = $this->post->email;
        $mdl->level = $this->post->level;

        if($this->post->new_password != "" && $this->post->new_password == $this->post->new_password_confirm){
            $mdl->password = md5($this->post->new_password);
        }

        if(isset($this->post->id))
        {
            $mdl->where("id='{$this->post->id}'");
            $status = $mdl->update();
        } else {
            $status = $mdl->insert();
        }

        Request::redirect(HOST . 'adm/usuarios/');
    }

    public function delete()
    {
        $m = Model::Factory('users');

        $m->inactive = 1;
        $m->where("id=".$this->get->uid);
        $m->update();

        Request::redirect(HOST . 'adm/usuarios/');
    }
    public function change_permission()
    {
        $m = Model::Factory('users');

        $m->level = 1;
        $m->where("id=".$this->get->uid);
        $m->update();

        Request::redirect(HOST . 'adm/usuarios/');
    }

}

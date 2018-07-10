<?php

class CatsWaitController extends Controller {

    private $views;
    private $post;
    private $get;
    private $files;
    private $session;

    public function init()
    {
        $this->get = Request::get();
        $this->post = Request::post(false);
        $this->files = Request::files();
        $this->session = new Session;

        if($this->session->logged_in !== true) Request::redirect(HOST.'adm/login');

        define("PERMISSIONS", $this->session->user->level);

        Phalanx::loadClasses('Queue');

    }

    public function show()
    {
        if (!$this->get->page) Request::redirect(HOST . 'adm/gatos/fila-de-espera/1');

        $this->views = new Views(new Template("admin"));
        $this->views->total_pages  = Queue::get_pages("queue", "company=1");
        $this->views->current_page = isset($this->get->page) ? $this->get->page : 1;
        $this->views->title  = "Candidatos Petz";
        $this->views->search = $this->post->search;
        $this->views->order  = $this->post->order;
        //
        $parameters = "company=1 AND (name LIKE '%{$this->post->search}%' OR id LIKE '%{$this->post->search}%')";

        $this->views->data = Queue::get($parameters, $this->views->current_page, $this->post->order);

        $this->views->display('queue_list.php');
    }

    public function profile(){
      $this->views = new Views(new Template("admin"));
      $this->views->data  = Queue::get_details($this->get->cat_id);
      $this->views->title  = "Edição de fila Petz";

      $this->views->display('queue_edit.phtml');
    }


    public function save()
    {
        // $godfathers = array();
        //
        // if(is_object($this->post->godfathers))
        // {
        //     foreach($this->post->godfathers as $gf)
        //     {
        //         $godfathers[] = $gf;
        //     }
        // }
        //
        // $mdl = Model::Factory('cats');
        //
        // $mdl->name                  = $this->post->cat_name;
        // $mdl->gender                = $this->post->cat_gender;
        // $mdl->description           = $this->post->cat_desc;
        // $mdl->full_description      = $this->post->cat_full_desc;
        // $mdl->godfather_description = $this->post->godfather_description;
        // $mdl->quantity              = $this->post->quantity;
        // $mdl->age                   = $this->post->cat_age;
        // $mdl->company               = $this->post->cat_company;
        // $mdl->social                = $this->post->social;
        // $mdl->playful               = $this->post->playful;
        // $mdl->lovely                = $this->post->lovely;
        // $mdl->special               = $this->post->special;
        // $mdl->godfathers_list       = serialize($godfathers);
        // $mdl->video_embed_code      = $this->post->video;
        // //$mdl->inactive              = 0;
        // $mdl->responsible_user_id   = $this->post->responsible_user_id;
        //
        // if($this->post->section) $mdl->section = $this->post->section;
        // if($this->post->adoption_date) $mdl->adoption_date = $this->post->adoption_date;
        // //if($this->post->registry_date) $mdl->registry_date = $this->post->registry_date;
        //
        // if(isset($filename)) $mdl->picture = $filename;
        // if(isset($filename2)) $mdl->picture_2 = $filename2;
        // if(isset($filename3)) $mdl->picture_3 = $filename3;
        // if(isset($filename4)) $mdl->picture_4 = $filename4;
        //
        // if($this->post->id)
        // {
        //     $mdl->where("id='{$this->post->id}'");
        //     $mdl->update();
        //
        //     $cat_id = $this->post->id;
        // }
        // else
        // {
        //     $mdl->registry_date = date('Y-m-d H:i:s');
        //
        //     $cat_id = $mdl->insert();
        //
        //     if ($this->post->section==1) $this->promote($cat_id);
        //     if ($this->post->section==2) $this->promote_godfathered($cat_id);
        // }
        //
        // Request::redirect(HOST.'adm/gatos/editar/' . $cat_id);
    }


    public function activate()
    {

        // $m = Model::Factory('cats');
        //
        // $m->inactive = 0;
        // $m->where("id=".$this->get->cat_id);
        // $m->update();
        //
        // Request::redirect(HOST . 'adm/gatos/desativados');
    }
}

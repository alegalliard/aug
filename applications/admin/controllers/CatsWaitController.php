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
        // $this->views->search = $this->post->search;
        // $this->views->order  = $this->post->order;
        //
        $parameters = "company=1 AND (name LIKE '%{$this->post->search}%' OR id LIKE '%{$this->post->search}%')";

        $this->views->data = Queue::get($parameters, $this->views->current_page, $this->post->order);

        $this->views->display('queue_list.php');
    }

    public function form()
    {
        // Phalanx::loadClasses('Users');
        // Phalanx::loadClasses('Godfather');
        //
        // $this->views = new Views(new Template("admin"));
        //
        //
        //
        // if(isset($this->get->cat_id))
        // {
        //     $this->views->data  = Cats::get_details($this->get->cat_id);
        //     $this->views->title = "Gatos (Editando Registro)";
        // } else {
        //     $this->views->title = "Gatos (Adicionar)";
        //
        // }
        //
        // $this->views->godfathers = Godfather::get_all(NULL, NULL, "nome ASC");
        // $this->views->data->godfathers_list = unserialize($this->views->data->godfathers_list);
        //
        // $this->views->users = Users::get();
        //
        // $this->views->display('cats_form.phtml');
    }

    public function save()
    {

        // if(isset($this->files->cat_picture->name) and $this->files->cat_picture->name != '')
        // {
        //     $dirname  = UPLOAD_DIR . 'cats' . SEPW;
        //     $filename = md5(uniqid(rand(), TRUE)).'.'.end(explode('.', $this->files->cat_picture->name));
        //
        //     //if(! is_dir($dirname)) mkdir($dirname, 0777, true);
        //
        //     move_uploaded_file($this->files->cat_picture->tmp_name, $dirname.$filename);
        // }
        //
        // if(isset($this->files->cat_picture_2->name) and $this->files->cat_picture_2->name != '')
        // {
        //     $dirname   = UPLOAD_DIR . 'cats' . SEPW;
        //     $filename2 = md5(uniqid(rand(), TRUE)).'.'.end(explode('.', $this->files->cat_picture_2->name));
        //
        //     //if(! is_dir($dirname)) mkdir($dirname, 0777, true);
        //
        //     move_uploaded_file($this->files->cat_picture_2->tmp_name, $dirname.$filename2);
        // }
        //
        // if(isset($this->files->cat_picture_3->name) and $this->files->cat_picture_3->name != '')
        // {
        //     $dirname   = UPLOAD_DIR . 'cats' . SEPW;
        //     $filename3 = md5(uniqid(rand(), TRUE)).'.'.end(explode('.', $this->files->cat_picture_3->name));
        //
        //     //if(! is_dir($dirname)) mkdir($dirname, 0777, true);
        //
        //     move_uploaded_file($this->files->cat_picture_3->tmp_name, $dirname.$filename3);
        // }
        //
        // if(isset($this->files->cat_picture_4->name) and $this->files->cat_picture_4->name != '')
        // {
        //     $dirname   = UPLOAD_DIR . 'cats' . SEPW;
        //     $filename4 = md5(uniqid(rand(), TRUE)).'.'.end(explode('.', $this->files->cat_picture_4->name));
        //
        //     //if(! is_dir($dirname)) mkdir($dirname, 0777, true);
        //
        //     move_uploaded_file($this->files->cat_picture_4->tmp_name, $dirname.$filename4);
        // }
        //
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

    public function reserved()
    {

        // if (!$this->get->page) Request::redirect(HOST . 'adm/gatos/reservas/1');
        //
        // $this->views = new Views(new Template("admin"));
        // $this->views->total_pages  = Cats::get_pages("cats", "inactive=0 AND status=1");
        // $this->views->current_page = isset($this->get->page) ? $this->get->page : 1;
        // $this->views->title  = "Gatos (Reservados)";
        // $this->views->search = $this->post->search;
        // $this->views->order  = $this->post->order;
        //
        // $parameters = "inactive=0 AND status=1 AND (name LIKE '%{$this->post->search}%' OR id LIKE '%{$this->post->search}%')";
        //
        // $this->views->data = Cats::get($parameters, $this->views->current_page, $this->post->order);
        //
        // if($this->post->search) $this->views->total_pages = ceil(count($this->views->data)/100);
        //
        // $this->views->display('cats_list_reserved.phtml');
    }

    public function adopted()
    {

        // if (!$this->get->page) Request::redirect(HOST . 'adm/gatos/adotados/1');
        //
        // $this->views = new Views(new Template("admin"));
        // $this->views->total_pages  = Cats::get_pages("cats", "status=2 AND inactive=0");
        // $this->views->current_page = isset($this->get->page) ? $this->get->page : 1;
        // $this->views->title  = "Gatos (Adotados)";
        // $this->views->search = $this->post->search;
        // $this->views->order  = $this->post->order;
        //
        // $parameters = "status=2 AND inactive=0 AND (name LIKE '%{$this->post->search}%' OR id LIKE '%{$this->post->search}%')";
        //
        // $this->views->data = Cats::get($parameters, $this->views->current_page, $this->post->order);
        //
        // if($this->post->search) $this->views->total_pages = ceil(count($this->views->data)/100);
        //
        // $this->views->display('cats_list_adopted.phtml');
    }

    public function godfathered()
    {

        // if (!$this->get->page) Request::redirect(HOST . 'adm/gatos/apadrinhados/1');
        //
        // $this->views = new Views(new Template("admin"));
        // $this->views->total_pages  = Cats::get_pages("cats", "inactive=0 AND section=2 AND godfathers_list IS NOT NULL AND godfathers_list <> 'a:0:{}'");
        // $this->views->current_page = isset($this->get->page) ? $this->get->page : 1;
        // $this->views->title  = "Gatos (Para Apadrinhamento)";
        // $this->views->search = $this->post->search;
        // $this->views->order  = $this->post->order;
        //
        // $parameters = "inactive=0 AND section=2 AND godfathers_list IS NOT NULL AND godfathers_list <> 'a:0:{}' AND (name LIKE '%{$this->post->search}%' OR id LIKE '%{$this->post->search}%')";
        //
        // $this->views->data = Cats::get($parameters, $this->views->current_page, $this->post->order);
        //
        // if($this->post->search) $this->views->total_pages = ceil(count($this->views->data)/100);
        //
        // $this->views->display('cats_list_godfathering.phtml');
    }

    public function available_adoption()
    {

        // if (!$this->get->page) Request::redirect(HOST . 'adm/gatos/para-adocao/1');
        //
        // $this->views = new Views(new Template("admin"));
        // $this->views->total_pages  = Cats::get_pages("cats", "inactive=0 AND status!=2 AND section=1");
        // $this->views->current_page = isset($this->get->page) ? $this->get->page : 1;
        // $this->views->title  = "Gatos (Para Adoção)";
        // $this->views->search = $this->post->search;
        // $this->views->order  = $this->post->order;
        //
        // $parameters = "inactive=0 AND status!=2 AND section=1 AND (name LIKE '%{$this->post->search}%' OR id LIKE '%{$this->post->search}%')";
        //
        // $this->views->data = Cats::get($parameters, $this->views->current_page, $this->post->order);
        //
        // if($this->post->search) $this->views->total_pages = ceil(count($this->views->data)/100);
        //
        // $this->views->display('cats_list_for_adoption.phtml');
    }

    public function available_godfathering()
    {

        // if (!$this->get->page) Request::redirect(HOST . 'adm/gatos/para-apadrinhamento/1');
        //
        // $this->views = new Views(new Template("admin"));
        // $this->views->total_pages  = Cats::get_pages("cats", "inactive=0 AND section=2");
        // $this->views->current_page = isset($this->get->page) ? $this->get->page : 1;
        // $this->views->title  = "Gatos (Para Apadrinhamento)";
        // $this->views->search = $this->post->search;
        // $this->views->order  = $this->post->order;
        //
        // $parameters = "inactive=0 AND section=2 AND (name LIKE '%{$this->post->search}%' OR id LIKE '%{$this->post->search}%')";
        //
        // $this->views->data = Cats::get($parameters, $this->views->current_page, $this->post->order);
        //
        // if($this->post->search) $this->views->total_pages = ceil(count($this->views->data)/100);
        //
        // $this->views->display('cats_list_godfathering.phtml');
    }

    public function deactivated()
    {

        // if (!$this->get->page) Request::redirect(HOST . 'adm/gatos/desativados/1');
        //
        // $this->views = new Views(new Template("admin"));
        // $this->views->total_pages  = Cats::get_pages("cats", "inactive=1");
        // $this->views->current_page = isset($this->get->page) ? $this->get->page : 1;
        // $this->views->title  = "Gatos (Desativados)";
        // $this->views->search = $this->post->search;
        // $this->views->order  = $this->post->order;
        //
        // $parameters = "inactive=1 AND (name LIKE '%{$this->post->search}%' OR id LIKE '%{$this->post->search}%')";
        //
        // $this->views->data = Cats::get($parameters, $this->views->current_page, $this->post->order);
        //
        // if($this->post->search) $this->views->total_pages = ceil(count($this->views->data)/100);
        //
        // $this->views->display("cats_list_deactivated.phtml");
    }

    public function reservation()
    {

        /* muda o estado da reserva */
        // $m = Model::Factory('cats');
        //
        // $m->status = $this->get->status;
        // $m->where("id='{$this->get->cat_id}'");
        // $status = $m->update();
        //
        // if ($status) Request::redirect(HOST . 'adm/gatos/all');
    }



    public function undo_adoption()
    {
        // $m = Model::Factory("cats");
        //
        // $m->status = "0";
        // $m->adoption_date = '0000-00-00 00:00:00';
        // $m->where("id='{$this->get->cat_id}'");
        // $m->update();
        //
        // $a = Model::Factory("cats_adopted");
        // $a->where("cat_id={$this->get->cat_id}");
        // $a->delete();
        //
        // $b = Model::Factory("cats_adopted");
        // $b->fields("id");
        // $b->order("id DESC");
        //
        // $increment = ($b->get()->id)+1;
        //
        // $c = Model::ExecuteQuery("ALTER TABLE cats_adopted AUTO_INCREMENT = {$increment};");
        //
        // Request::redirect(HOST.'adm/gatos/adotados');
    }

    public function make_adoption()
    {

        // $a = Model::Factory("cats_adopted");
        // $a->fields("id");
        // $a->order("id DESC");
        //
        // $increment = ($a->get()->id)+1;
        //
        // $b = Model::ExecuteQuery("ALTER TABLE cats_adopted AUTO_INCREMENT = {$increment};");
        //
        // $m = Model::Factory("cats");
        // $m->status = "2";
        // $m->adoption_date = date("Y-m-d H:i:s");
        // $m->where("id='{$this->get->cat_id}'");
        // $m->update();
        //
        // $q = Model::Factory("cats");
        // $q->fields("quantity");
        // $q->where("id='{$this->get->cat_id}'");
        //
        // $cats = $q->get()->quantity;
        //
        // $a = Model::Factory("cats_adopted");
        //
        // $a->cat_id = $this->get->cat_id;
        // $a->insert();
        //
        // if($cats > 1) $a->insert();
        //
        // Request::redirect(HOST.'adm/gatos/adotados');
    }

    //    public function confirm()
    //    {
    //        $m = Model::Factory("cats");
    //        $m->status = 1;
    //        $m->adoption_date = date('Y-m-d H:i:s');
    //        $m->where("id='{$this->post->cat_id}'");
    //        $status = $m->update();
    //
    //        //Move os outros interessados para a outra tabela
    //        $m = Model::Factory('cat_interests');
    //        $m->where("cats_id=" . $this->post->cat_id . " AND id<>" . $this->post->person_id);
    //        $data = $m->all();
    //        foreach($data as $interested){
    //            $mdl = Model::Factory('want_to_adopt');
    //            foreach($interested as $k => $v)
    //                $mdl->{$k} = $v;
    //
    //            $mdl->insert();
    //        }
    //
    //        //Agora apaga os que sobraram
    //        $m = Model::Factory('cat_interests');
    //        $m->where("cats_id=" . $this->post->cat_id . " AND id<>" . $this->post->person_id);
    //        $m->delete();
    //
    //        if($status)
    //        {
    //            Request::redirect(HOST.'adm/adocao-finalizada-com-sucesso');
    //        } else {
    //            Request::redirect(HOST.'adm/adocao-nao-finalizada');
    //        }
    //    }



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

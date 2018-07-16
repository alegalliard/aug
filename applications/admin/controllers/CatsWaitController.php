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


    public function change()
    {
      Phalanx::loadClasses('Queue');
      $mdl = Model::Factory('adoption_queue');
      $mdl->status = $this->post->status;
      $mdl->where("id='{$this->post->id}'");
      $status = $mdl->update();

      if(isset($this->post->send_email) && $this->post->send_email === 1) {
        Phalanx::loadExtension('phpmailer');
        $mail = new PHPMailer(true);

        $mail->IsSMTP();
        

        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';

        $mail->SetFrom("contato@adoteumgatinho.com.br", "Adote um Gatinho");
        $mail->AddReplyTo("contato@adoteumgatinho.com.br", "Adote um Gatinho");
        $mail->AddAddress($this->post->email);

        $mail->Subject = "Aprovação - Adote um Gatinho e Petz";
        $mail->MsgHTML(nl2br($this->post->message));

        $mail->SMTPDebug = 0;

        if(!$mail->Send()) {
            echo 'Mailer error: ' . $mail->ErrorInfo;
        }
      }
    }
}

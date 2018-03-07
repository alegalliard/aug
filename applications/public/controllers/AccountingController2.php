<?php

class AccountingController2 extends Controller {

    private $get;
    private $post;
    private $views;

    public function init()
    {
            $this->get = Request::get();
            $this->post = Request::post();
    }

    public function index()
    {
        
        //$this->views = new Views(new Template("public"));
        $template = new Template("public", "novo/default.phtml");
		$this->views = new Views($template);
        $this->views->display('novo/accounting.phtml');
    }

    public function ShowCredit()
    {
        $year = ($this->get->year) ? $this->get->year : date('Y');

        Phalanx::loadClasses('public.Accounting');
        
//        $this->views = new Views(new Template("public"));
        $template = new Template("public", "novo/default.phtml");
		$this->views = new Views($template);
        
        
        $this->views->current_year = $year;
        $this->views->data = Accounting::getAccounting($year, ">");
        
        $this->views->display('novo/accounting_c.phtml');
    }
    
    public function ShowDebit()
    {
        $year = ($this->get->year) ? $this->get->year : date('Y');

        Phalanx::loadClasses('public.Accounting');
        
//        $this->views = new Views(new Template("public"));
        $template = new Template("public", "novo/default.phtml");
		$this->views = new Views($template);
        
        
        $this->views->current_year = $year;
        $this->views->data = Accounting::getAccounting($year, "<");
        
        $this->views->display('novo/accounting_d.phtml');
    }
}
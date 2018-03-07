<?php

class Cats {

    private function __construct(){}

    public static function get($parameters, $page, $order)
    {
        $offset = (100*$page)-100; 
    
        $mdl = Model::Factory('cats');
        $mdl->where($parameters);
        ($order != NULL) ? $mdl->order("{$order} LIMIT 100 OFFSET {$offset}") : $mdl->order("registry_date DESC LIMIT 100 OFFSET {$offset}");

        return $mdl->all();
    }

    public static function get_total($table)
    {
        $m = Model::Factory($table);
        $m->fields("COUNT(id) AS qtde");

        return $m->get()->qtde;
    }

    public static function get_pages($table, $argument)
    {
        $m = Model::Factory($table);

        $m->fields("COUNT(id) AS qtde");
        if ($argument != NULL) $m->where($argument);

        $total = $m->get()->qtde;
        $pages = ceil($total/100);

        return $pages;
    }

    public static function get_featured_all(){
        $m = Model::Factory('cats c');
        $m->where("featured=1 AND inactive=0 AND status=0 AND section=1");
        $m->order("position DESC");
        return $m->all();
    }
    
    public static function get_featured_godfathered(){
        $m = Model::Factory('cats c');
        $m->where("featured=1 AND inactive=0 AND status=0 AND section=2");
        $m->order("position_godfathered DESC");
        return $m->all();
    }

    public static function get_details($id=NULL)
    {
        $mdl = Model::Factory('cats');
        
        if(isset($id))
        {
            $mdl->where("id='{$id}'");
            return $mdl->get();
        }
    }
}
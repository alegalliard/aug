<?php

class Godfather {

    private function __construct(){}

    public static function get($parameters, $page, $order)
    {
	$offset = (100*$page)-100; 
    
        $mdl = Model::Factory('godfather');
	if(is_numeric($parameters)){
            $mdl->where("id='{$parameters}'");
            return $mdl->get();
        }
	else {
	    $mdl->where($parameters);
	    ($order != NULL) ? $mdl->order("{$order} LIMIT 100 OFFSET {$offset}") : $mdl->order("data_inicio DESC LIMIT 100 OFFSET {$offset}");

	    return $mdl->all();
	}
    }
    
    public static function get_all($parameters, $page = 0, $order)
    {
	$str = "";
        
        if ($like != NULL) $str = " AND nome LIKE '%{$like}%'";
        
        $mdl = Model::Factory('godfather');
        if(isset($id)){
            $mdl->where("id='{$id}'");
            return $mdl->get();
        }
        
        $mdl->where("inactive=0 {$str}");
        ($order != NULL) ? $mdl->order($order) : $mdl->order("nome ASC");
        
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
}

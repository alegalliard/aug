<?php

class Godfather {

    private function __construct(){}

    public static function get($id=NULL, $like=NULL, $order=NULL)
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
    
	
}

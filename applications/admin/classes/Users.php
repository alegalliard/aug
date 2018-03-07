<?php

class Users {

    private function __construct(){}

    public static function get($id = null)
    {
        $mdl = Model::Factory('users u');
        if(isset($id)){
            $mdl->where("id='{$id}'");
            return $mdl->get();
        }
        
        $mdl->fields('u.*', 'count(c.id) as cat_qtty');
        $mdl->group('u.id');
        $mdl->leftJoin('cats c', 'c.responsible_user_id = u.id');        
        $mdl->where("u.inactive=0 AND u.id<>0");
        $mdl->order("u.login ASC");
		
        return $mdl->all();
    }

}

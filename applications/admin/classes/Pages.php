<?php

class Pages {

    private function __construct(){}

    public static function get($id = null)
    {
        $mdl = Model::Factory('pages');
        if(isset($id)){
            $mdl->where("id='{$id}'");
            return $mdl->get();
        }
        $mdl->order('name ASC');
        $mdl->where("inactive=0");

        return $mdl->all();
    }

}

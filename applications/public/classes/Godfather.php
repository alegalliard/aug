<?php

class Godfather {

    private function __construct(){}

    public static function get_detailed()
    {
        $m = Model::Factory('cats');
        $m->where("section=2 AND inactive=0");
        $m->order("position_godfathered DESC");
        
        return $m->all();
    }

    public static function get_names(Array $ids)
    {
        $m = Model::Factory('godfather');
        $m->fields('id', 'nome');
        $m->where("id IN (". implode(', ', $ids) .")");
        $m->order("nome ASC");
        
        return $m->all();
    }

}
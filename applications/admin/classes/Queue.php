<?php
class Queue {

  private function __construct(){}

  public static function get($parameters, $page, $order)
  {
      $offset = (100*$page)-100;

      $mdl = Model::Factory('adoption_queue');
      $mdl->where($parameters);
      ($order != NULL) ? $mdl->order("{$order} LIMIT 100 OFFSET {$offset}") : $mdl->order("register_date DESC LIMIT 50 OFFSET {$offset}");

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

  public static function get_details($id=NULL)
  {
      $mdl = Model::Factory('adoption_queue');

      if(isset($id))
      {
          $mdl->where("id='{$id}'");
          return $mdl->get();
      }
  }
}

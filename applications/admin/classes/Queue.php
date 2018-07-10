<?php
class Queue {

  private function __construct(){}

  public static function get($parameters, $page, $order)
  {
      $offset = (100*$page)-100;

      $mdl = Model::ExecuteQuery("SELECT COUNT(a.user_id) as users,
                                  c.id AS cat_id,
                                  c.name AS cat_name
                                  FROM adoption_queue a
                                  JOIN cats c ON a.cat_id = c.id
                                  WHERE a.company = 1
                                  GROUP BY c.id");

      return $mdl;

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
      // $mdl = Model::Factory('adoption_queue');
      //
      // if(isset($id))
      // {
      //     $mdl->where("id='{$id}'");
      //     return $mdl->get();
      // }

      $mdl = Model::ExecuteQuery("SELECT
                                  a.id AS queue_id,
                                  a.status,
                                  a.register_date,
                                  c.id AS cat_id,
                                  c.name AS cat_name,
                                  c.picture AS cat_picture,
                                  u.id AS user_id,
                                  u.name AS user_name,
                                  u.telephone AS user_tel,
                                  u.email AS user_email
                                  FROM adoption_queue a
                                  INNER JOIN cats c ON a.cat_id = c.id
                                  INNER JOIN cats_interests u ON a.user_id = u.id
                                  WHERE a.cat_id = '$id'
                                  ORDER BY a.register_date DESC");

      return $mdl;
  }
}

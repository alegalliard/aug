<?php

class Cats {

    private function __construct(){}

    public static function get($id = null)
    {
        $mdl = Model::Factory('cats');

        if(isset($id))
        {
            $mdl->where("id='{$id}'");
            return $mdl->get();
        }

        $mdl->where("status=0 AND section=1 AND ( inactive=0 OR company=1 )");
        $mdl->order("position DESC");

        return $mdl->all();
    }

    public static function get_specials($page=0)
    {
        $mdl = Model::Factory('cats');

        $mdl->where("special=1 AND inactive=0 AND status=0 AND section=1");
        $mdl->order("registry_date DESC");

        $range = $page * 30;

        $mdl->limit("{$range}, 30");

        return $mdl->all();
    }

    public static function counting(){
//    ORIGINAL
//      $mdl_count = Model::ExecuteQuery("SELECT sql_cache count(c.id) as total FROM cats c LEFT JOIN cats_adopted a ON c.id = a.cat_id WHERE c.status!=0 AND c.inactive=0");
//        $total = Model::ExecuteQuery("SELECT sql_cache count(c.id) as total FROM cats c LEFT JOIN cats_adopted a ON c.id = a.cat_id WHERE c.status!=0");


        $total = Model::ExecuteQuery("SELECT count(c.id) as total FROM cats c LEFT JOIN cats_adopted a ON c.id = a.cat_id WHERE c.status = 2");
        $two_cats = Model::ExecuteQuery("SELECT count(c.id) as total FROM cats c LEFT JOIN cats_adopted a ON c.id = a.cat_id WHERE c.quantity = 2");

        $count = intval($total[0]->total + $two_cats[0]->total);
        return $count;
    }

    public static function get_adopted($page=0)
    {
        $range = $page * 30;
        //$mdl = Model::ExecuteQuery("SELECT sql_cache c.name, c.quantity, c.status, c.picture, a.id AS adopted_id FROM cats c RIGHT JOIN cats_adopted a ON c.id = a.cat_id WHERE c.status!=0 AND c.inactive=0 group by c.id ORDER BY c.status desc, adopted_id asc limit $range, 30");
	//$mdl = Model::ExecuteQuery("SELECT c.*, a.id AS adopted_id FROM cats c LEFT JOIN cats_adopted a ON c.id = a.cat_id WHERE c.status!=0 AND c.inactive=0 ORDER BY adopted_id desc, c.status asc  limit $range, 30");
	//$mdl = Model::ExecuteQuery("SELECT sql_cache c.name, c.quantity, c.status, c.picture, a.id AS adopted_id FROM cats c right JOIN cats_adopted a ON c.id = a.cat_id WHERE c.status!=0 AND c.inactive=0 ORDER BY adopted_id desc, c.status asc  limit $range, 30");

	$mdl = Model::ExecuteQuery("SELECT sql_cache c.name, c.quantity, c.status as status, c.picture, a.id AS adopted_id FROM cats c LEFT JOIN cats_adopted a ON c.id = a.cat_id WHERE c.status!=0 AND c.inactive=0 group by c.id ORDER BY status asc, adopted_id desc, c.id desc  limit $range, 30");
        $mdl_count = Model::ExecuteQuery("SELECT sql_cache count(c.id) as total FROM cats c LEFT JOIN cats_adopted a ON c.id = a.cat_id WHERE c.status!=0 AND c.inactive=0");

	//$mdl = Model::ExecuteQuery("SELECT sql_cache c.name, c.quantity, c.status as status, c.picture, a.id AS adopted_id FROM cats c right outer JOIN cats_adopted a ON c.id = a.cat_id WHERE c.status!=0 AND c.inactive=0 group by c.id ORDER BY c.status desc, adopted_id desc limit $range, 30");

        $result = $mdl;
	$result_count = $mdl_count;

	$response = array();

	$a = 0;
	$b = $result_count[0]->total - ($range);
        for ($i=0; $i<count($result); $i++)
        {
            $response[$i] = $result[$i];

            $response[$i]->cod = $b;

            if ($result[$i]->quantity == "2" && $result[$i]->status == "2")
            {
                $response[$i+1] = null;
                $response[$i]->cod = ($b)." / ".($b-1);

		$b--;
		$a++;
            }

            if ($response[$i]->name == $response[$i-1]->name)
            {
                //unset($response[$i]);
            }

	    $b--;
	    $a++;
        }

        //krsort($response);

        //$response = array_slice($response, $range, 30);

        return $response;
    }

    public static function get_paginated($page=0)
    {
        $mdl = Model::Factory('cats');
        $mdl->where("status=0 AND section=1 AND inactive=0");
        $mdl->order("position DESC");
       //$mdl->order("registry_date DESC");
        $range = $page * 30;
        $mdl->limit("{$range}, 30");
        return $mdl->all();
    }

    public static function get_paginated_petz($page=0)
    {
      $mdl = Model::Factory('cats');

      $mdl->where("section=1 AND company=1");
      $mdl->order("registry_date DESC");

      $range = $page * 30;

      $mdl->limit("{$range}, 30");

      return $mdl->all();
    }

    public static function get_responsible($cat)
    {
        $mdl = Model::Factory('cats');
        $mdl->fields('responsible_user_id');
        $mdl->where("id={$cat}");
        $user_id = $mdl->get('responsible_user_id');
        $mdl = Model::Factory('users');
        $mdl->fields('email');
        $mdl->where("id={$user_id->responsible_user_id}");

        return $mdl->all();
    }

    public static function get_interests()
    {
        $mdl = Model::Factory('cats_interests1');
        $mdl->order("id DESC");
        return $mdl->all();
    }

}

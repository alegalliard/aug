<?php
class Queue {

    private function __construct(){}

    public static function get($id = null)
    {
      /*
      status
        APPROVED
        WAIT
        REJECTED
      */
        $mdl = Model::Factory('adoption_queue');

        if(isset($id))
        {
            $mdl->where("id='{$id}'");
            return $mdl->get();
        }
        //
        // $mdl->where("status=0 AND section=1 AND inactive=0");
        // $mdl->order("position DESC");

        return $mdl->all();
    }
  }

?>

<?php

class Accounting {

    public static function getByYear($year)
    {
        $m = Model::Factory('accounting');
        $m->where("inactive = 0 AND date BETWEEN '{$year}-01-01' AND '{$year}-12-31'");
        $m->order("date DESC");
        $data = $m->all();

        $r = array();
        if($data)
            foreach($data as $each){
                $month = date('m', strtotime($each->date));
                $r[$month][] = $each;
            }

        return $r;
    }
    
}
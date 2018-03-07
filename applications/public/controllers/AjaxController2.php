<?php
/* controller do site novo em AjaxController2 */
class AjaxController2 extends Controller {
    private $get;
    private $session;
    public function init()
    {
        $this->get = Request::get();
        $this->session = new Session();			
    }
    
    public function parserInterests()
    {
        Phalanx::loadClasses('Cats');
        
        $response = Cats::get_interests();
        
        $result = array();
        foreach($response as $item)
        {
            $cats = Cats::get($item->cats_id);
            $mdl = Model::Factory('cats_interests1');
        
            $mdl->cat_name = $cats->name;
            
            $mdl->where("id='{$item->id}'");
            $mdl->update();
            
            echo "1";
        }
    }
    public function paginated()
    {
        $page = $this->get->page;
        
        Phalanx::loadClasses('Cats');
        
        $response = Cats::get_paginated($page);
        
        $result = array();
                
            echo '<section id="gatinhos-para-adocao"><ul class="mural">';
            // echo '<h1 class="aug_purple bold upper h1 hide-on-large-only">Gatinhos para adoção</h1>';
     
        foreach($response as $item)
        {
            
            $gender = $item->gender;
            switch($item->gender){
                case 'M':
                    $gender = ' ic-male ';
                break;
                case 'F':
                    $gender = ' ic-female ';
                break;
                case 'B':
                    $gender = ' ic-male-female ';
                break;
            }
        $html = '<div class="col s12 m6 box-gatos p-0">
                    <li class="col s6 m6 l3 p-0">
                    <a href="'.HOST.'detalhes-gato2/'.$item->id.'/'.strtolower(str_replace(' ', '-', htmlentities($item->name))). '" style="background-image: url('.MEDIA_DIR.'uploads/cats/'.$item->picture.');">
                    <div class="hide-on-large-only" style="    position: absolute;
    bottom: 10px;
    left: 10px;">
                               <i class="icon-purple hide-on-med-and-down '. $gender. '"></i>
                           </div>
                    
                    
                    ';
            
            
            if ($item->special == 1) { 
                $html .= '<div class="special-cat hide-on-med-and-down" style="right:0"><span class="upper bold" style="margin-right: 13px;">Especial</span><i class="icon-white ic-star"></i></div>
                     <div class="special-cat hide-on-large-only"><i class="icon-white ic-star"></i><span class="upper bold">Especial</span></div>';
                                      }
            //reservado
            if ($item->status == 1) { 
                $html .= '<div class="special-cat hide-on-med-and-down" style="left:0"><i class="icon-white c-locked"></i></div>
                     <div class="special-cat hide-on-large-only"><i class="icon-white c-locked"></i></div>';
                }
             $html .= ' <div class="texto hide-on-med-and-down">
                       <h1 class="text_13 bold upper m-t-0">'.$item->name.'</h1>
                       <p class="desc text_10">';
                        $desc = strip_tags($item->description);
                                if(strlen($desc) > 100) {
                                        $html .=  substr($desc, 0, 100) . '...';
                                    } else {
                                        $html .=  htmlentities($desc);
                                    }
                $html .= '</p>
                        <div class="col s6 characteristics m-t-10">
                          <div class="happines">';
                            for ($i = 0; $i < $item->playful; $i++) {
                                $html .= '<i class="sociavel icon-white ic-happy"></i>';
                            }
                            
                $html .= '</div>
                          <div class="funny">';
                            for ($i = 0; $i < $item->social; $i++) {
                                $html .= '<i class="sociavel icon-white ic-hank"></i>';
                            } 
                            
                $html .= '</div>
                          <div class="loving">';
                            for ($i = 0; $i < $item->lovely; $i++) {
                                $html .= '<i class="sociavel icon-white ic-heart"></i>';
                            } 
                $html .= '</div>
                        </div>
                        <div class="col s4 gender text-right" style="margin-top:80px;">
                               <i class="icon-white hide-on-med-and-down '. $gender. '"></i>
                           </div>
                   </div>
                    <div class="more upper bold text_15 hide-on-large-only aug_purple_bg white">+</div>
                </a>
               </li>
               <li class="col s6 m6 l3 hide-on-large-only text-small-complete p-0">
                    <div class="col s12 texto-mobile">
                        <h1 class="flow-text bold upper aug_purple m-t-10 m-b-10 truncate">'.$item->name.'</h1><i class="icon-purple '. $gender. 'text"></i>
                            <div class="text_10">
                            <p>';
                            $desc = strip_tags($item->description);
                                if(strlen($desc) > 400) {
                                        $html .=  substr($desc, 0, 400) . '...';
                                    } else {
                                        $html .=  htmlentities($desc);
                                    }
                                
                                $html .= '</p>
                            <div class="row col s12 characteristics m-t-10 m-b-0">
                                <div align="center" class="col s4 happines">
                                    <i class="sociavel icon-purple ic-happy"></i>
                                    <p style="display: inline;"> x'.$item->playful .'</p>
                                </div>
                                <div align="center" class="col s4 funny">
                                    <i class="sociavel icon-purple ic-hank"></i>
                                    <p style="display: inline;"> x'.$item->social.'</p>
                                </div>
                                <div align="center" class="col s4 loving">
                                    <i class="sociavel icon-purple ic-heart"></i>
                                    <p style="display: inline;"> x'.$item->lovely.'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
             </div>';
            
            
            
            
           
             
            echo $html;
        }
        echo '</ul></section>';
    }
    
    public function special()
    {
        $page = $this->get->page;
        
        Phalanx::loadClasses('Cats');
        
        $response = Cats::get_specials($page);
        
        $result = array();
                
            echo '<section id="gatinhos-para-adocao">
            <ul class="mural">';
     
        foreach($response as $item)
        {
            $gender = $item->gender;
            switch($item->gender){
                case 'M':
                    $gender = ' ic-male';
                break;
                case 'F':
                    $gender = ' ic-female';
                break;
                case 'B':
                    $gender = ' ic-male-female';
                break;
            }
            
            
            $html = '<div class="col s12 m6 box-gatos p-0">
                
                    <li class="col s6 m6 l3 p-0 relative">
                    <a href="'.HOST.'detalhes-gato2/'.$item->id.'/'.strtolower(str_replace(' ', '-', htmlentities($item->name))). '" style="background-image: url('.MEDIA_DIR.'uploads/cats/'.$item->picture.');">
                    <div class="hide-on-large-only" style="    position: absolute;
    bottom: 10px;
    left: 10px;">
                               <i class="icon-purple hide-on-med-and-down '. $gender. '"></i>
                           </div>
                    
                     <div class="special-cat hide-on-med-and-down" style="right:0"><span class="upper bold" style="margin-right: 13px;">Especial</span><i class="icon-white ic-star"></i></div>
                     <div class="special-cat hide-on-large-only"><i class="icon-white ic-star"></i><span class="upper bold">Especial</span></div>';
                         
            //reservado
            if ($item->status == 1) { 
                $html .= '<div class="special-cat hide-on-med-and-down" style="left:0"><i class="icon-white c-locked"></i></div>
                     <div class="special-cat hide-on-large-only"><i class="icon-white c-locked"></i></div>';
                }
                     
            $html .= ' <div class="texto hide-on-med-and-down">
                       <h1 class="text_13 bold upper m-t-0">'.$item->name.'</h1>
                       <p class="desc text_10">';
                        $desc = strip_tags($item->description);
                                if(strlen($desc) > 100) {
                                        $html .=  substr($desc, 0, 100) . '...';
                                    } else {
                                        $html .=  htmlentities($desc);
                                    }
                $html .= '</p>
                        <div class="col s6 characteristics m-t-10">
                          <div class="happines">';
                            for ($i = 0; $i < $item->playful; $i++) {
                                $html .= '<i class="sociavel icon-white ic-happy"></i>';
                            }
                            
                $html .= '</div>
                          <div class="funny">';
                            for ($i = 0; $i < $item->social; $i++) {
                                $html .= '<i class="sociavel icon-white ic-hank"></i>';
                            } 
                            
                $html .= '</div>
                          <div class="loving">';
                            for ($i = 0; $i < $item->lovely; $i++) {
                                $html .= '<i class="sociavel icon-white ic-heart"></i>';
                            } 
                $html .= '</div>
                        </div>
                        <div class="col s4 gender text-right" style="margin-top:80px;">
                               <i class="icon-purple '. $gender. '"></i>
                           </div>
                   </div>
                    <div class="more upper bold text_15 hide-on-large-only aug_purple_bg white">+</div>
                </a>
               </li>
               <li class="col s6 m6 l3 hide-on-large-only text-small-complete p-0">
                    <div class="col s12 texto-mobile">
                        <h1 class="flow-text bold upper aug_purple m-t-10 m-b-10 truncate">'.$item->name.'</h1>
                            <div class="text_10">
                            <p>';
                            $desc = strip_tags($item->description);
                                if(strlen($desc) > 400) {
                                        $html .=  substr($desc, 0, 400) . '...';
                                    } else {
                                        $html .=  htmlentities($desc);
                                    }
                                
                                $html .= '</p>
                            <div class="row col s12 characteristics m-t-10 m-b-0">
                                <div align="center" class="col s4 happines">
                                    <i class="sociavel icon-purple ic-happy"></i>
                                    <p style="display: inline;"> x'.$item->playful .'</p>
                                </div>
                                <div align="center" class="col s4 funny">
                                    <i class="sociavel icon-purple ic-hank"></i>
                                    <p style="display: inline;"> x'.$item->social.'</p>
                                </div>
                                <div align="center" class="col s4 loving">
                                    <i class="sociavel icon-purple ic-heart"></i>
                                    <p style="display: inline;"> x'.$item->lovely.'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
             </div>';
             
            echo $html;
        }
        echo '</ul></section>';
    }
    
    public function adopted()
    {
        $page = $this->get->page;
        
        Phalanx::loadClasses('Cats');
        
        $response = Cats::get_adopted($page);
        
        $result = array();
        
        echo '<section id="gatinhos-para-adocao">
            
        <ul class="mural">';
        
        foreach($response as $item)
        {           
            
            /* header */
            $html = '<div class="col s12 m6 box-gatos p-0"><li class="col s6 m6 l3 p-0 relative">';
            /* image */
            if ($item->special == 1) $html .= "<span class=\"special_cat\"></span>";
            /* image */
            if ($item->status == 1) $html .= "<span class=\"reserved_cat\"></span>";
            $html .= '<a href="#" style="background-image: url('.MEDIA_DIR.'uploads/cats/'.$item->picture.');">';
            $html .= ' <div class="special-cat hide-on-med-and-down"><i class="icon-white ic-locked"></i> Reservado</div>
                     <div class="special-cat hide-on-large-only"><i class="icon-white ic-locked"></i> Reservado</div>
                      <h1 class="text_13 bold upper m-t-0" style="bottom: 0;
    position: absolute;
    color: white;
    left: 10px;">'.$item->name.'</h1>';
            $html .= '<div class="shadow">';
            /* description */
            if(strlen(strip_tags($item->description)) > 100) $item->description = substr($item->description, 0, 100) . '...';
            /* cod */
            if ($item->status != 1) $html .= "<div class=\"cat_id\">".$item->cod."</div>";
                 
             $html .= '</div></a></div>';
            
            
            /* more */
            $html .= '</div>
               </li></div>';
           
            
            echo $html;
        }
        
        echo '</ul></section>';
    }
    
    public function godfathered()
    {
        $page = $this->get->page;
        
        Phalanx::loadClasses('Godfather');
         
        $response = Godfather::get_detailed();
        $result = array();
        echo '<section id="gatinhos-para-adocao"><ul class="row aug_grey">
        <h4 class="bold upper aug_blue p-10">Gatinhos para apadrinhamento</h4>';
        
        //ORIGINAL
        
        foreach($response as $item)
        {
            $item->godfathers_list = Godfather::get_names(unserialize($item->godfathers_list));
            $godfathers = "<br><strong>Meus padrinhos</strong>";
            $godfathers .= "<ul>";
            foreach($item->godfathers_list as $gf) { $godfathers .= "<li style='display:inline-block; width:50%;'>- ".($gf->nome)."</li>"; }
            $godfathers .= "</ul>";
            
           /* // header 
            
            $html = "<li class=\" col s12 m6 l4 sub-section cat tooltip godfathered\" ";            
            ($item->godfather_description) ? $html .= "" : $html .= "";
            $html .= " ><h4>".($item->name)."</h4>";
            $html .= "<img src=\"".MEDIA_DIR."uploads/cats/".$item->picture."\" />";
            
            // image 
            if ($item->special == 1) $html .= "<span class=\"special_cat\">Especial</span>";
            if ($item->godfathers_list < 1) $html .= "<span class=\"nogodfather_cat\"></span>";
            
            
            
            // description 
            if($item->godfather_description) $item->godfather_description = substr($item->godfather_description, 0, 300);
            $html .= "<span>".$this->closeUnclosedTags(utf8_encode($item->godfather_description))."</span>";
            // godfather 
            $html .= "<h6 style=\"cursor: pointer;\" title=\"".html_entity_decode($godfathers)."\">Meus padrinhos &raquo;</h6>";
            */
            
    $html = '<li class="col s12 m6 l4">
        <div class="card border_b_blue card-wrapper max-height-godfather">
        <div class="card-image card-image-godfather-large waves-effect waves-block waves-light">
            <div class="fix_image_card">
                <img src="'.MEDIA_DIR."uploads/cats/".$item->picture.'" class="activator"  />';
    if ($item->godfathers_list < 1) $html .= "<div class=\"no_godfather aug_blue_bg white-text bold upper text-right p-2\">Sem padrinhos</div>";
    $html .= '
    
        </div>
        </div>
        <div class="card-content">
          <span class="card-title activator white aug_blue bold upper truncate" style="text-shadow: none;">'.$item->name.'<i class="material-icons right" style="position: absolute; right: 15px;">more_vert</i></span>
        </div>
        <div class="card-content hide-on-large-only" style="height: 130px">
            '.strip_tags($item->godfather_description).'
        </div>
        <div class="card-reveal"><br><br>
          <span class="card-title white aug_blue" style="text-shadow: none;">'.$item->name.' <i class="gray-text material-icons right">close</i></span><br>
          ';
            
         $html .= '<p style="width:90%" class="hide-on-med-only hide-on-small-only">'.strip_tags($item->godfather_description).'</p>
          '.$godfathers;
             
           if ($item->godfathers_list < 1) $html .= '<span class=\"no_godfathers\">Sem padrinhos</span>
        </div>
      </div>
      </li>';
            
            
            
            echo $html;
        }
        echo '</ul></section>';
    }
}
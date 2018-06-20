<?php
/* controller do site novo em AjaxController2 */
class AjaxController extends Controller {
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
                    <li class="col s6 m6 l3 p-0"><!--<div class="cat_index"></div>-->';

            $_reservado = '<div class="reserved-cat hide-on-med-and-down" style="right:inherit; bottom:20px"><i class="icon-white ic-star"></i> Reservado</div>
                     <div class="reserved-cat hide-on-large-only"><i class="icon-white ic-star"></i></div>';
            $_adotado = '<div class="reserved-cat hide-on-med-and-down" style="right:inherit; bottom:20px"><i class="icon-white ic-locked"></i> Adotado</div>
                     <div class="reserved-cat hide-on-large-only"><i class="icon-white ic-locked"></i></div>';

            //reservado
            if ($item->status == 1) {
                $html .= $_reservado;
            }

            //adotado
            if ($item->status == 2) {
                $html .= $_adotado;
            }

             $html .= '<a href="'.HOST.'detalhes-gato/'.$item->id.'/'.strtolower(str_replace(' ', '-', htmlentities($item->name))). '" style="background-image: url('.MEDIA_DIR.'uploads/cats/'.$item->picture.');" class="cat-profile ';
            if ($item->status == 1 || $item->status == 2) {$html .= ' gray-filter '; }
                $html .= '">
                    <div class="hide-on-large-only" style="position: absolute; bottom: 10px; left: 10px;">
                        <i class="icon-white '. $gender. '"></i>
                </div>';
              if ($item->company == 1) {
                $html .= '<div class="company"></div>';
              }

            if ($item->special == 1) {
                $html .= '<div class="special-cat hide-on-med-and-down" style="right:0">
                <span class="upper bold" style="margin-right: 13px;bottom: 20px;">Especial</span><i class="icon-white ic-star"></i></div>

                     <div class="special-cat hide-on-large-only"><i class="icon-white ic-star"></i><span class="upper bold">Especial</span></div>';
                }

             $html .= ' <div class="texto hide-on-med-and-down">
                       <h1 class="text_13 bold upper m-t-0">'.$item->name.'</h1>




                       <p class="desc text_10 clear">';
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
                               <i class="icon-white '. $gender. '"></i>
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

                    <li class="col s6 m6 l3 p-0 relative"><!--<div class="cat_index"></div>-->
                    <a href="'.HOST.'detalhes-gato/'.$item->id.'/'.strtolower(str_replace(' ', '-', htmlentities($item->name))). '" style="background-image: url('.MEDIA_DIR.'uploads/cats/'.$item->picture.');" class="cat-profile">';
              if ($item->company == 1) {
                $html .= '<div class="company"></div>';
              }
          $html .= '<div class="hide-on-large-only" style="position: absolute;bottom: 10px;left: 10px;">
                               <i class="icon-white '. $gender. '"></i>
                           </div>

                     <div class="special-cat hide-on-med-and-down" style="right:0"><span class="upper bold" style="margin-right: 13px;">Especial</span><i class="icon-white ic-star"></i></div>
                     <div class="special-cat hide-on-large-only"><i class="icon-white ic-star"></i><span class="upper bold">Especial</span></div>';

            //reservado
            if ($item->status == 2) {
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
                               <i class="icon-white '. $gender. '"></i>
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


            $html .= '<a href="#" style="background-image: url('.MEDIA_DIR.'uploads/cats/'.$item->picture.');">';

            if ($item->status == 1) $html .= '<div class="reserved-cat hide-on-med-and-down"><i class="icon-white ic-locked"></i> Reservado</div>
                     <div class="reserved-cat hide-on-large-only"><i class="icon-white ic-locked"></i> Reservado</div>';
            if ($item->status == 2) $html .= '<div class="reserved-cat hide-on-med-and-down"><i class="icon-white ic-locked"></i> Adotado</div>
                     <div class="reserved-cat hide-on-large-only"><i class="icon-white ic-locked"></i> Adotado</div>';

            $html .= '<h1 class="text_13 bold upper m-t-0" style="bottom: 0;
    position: absolute;
    color: white;
    left: 10px;">'.$item->name. '</h1>';
            $html .= '<div class="shadow">';
            /* description */
            if(strlen(strip_tags($item->description)) > 100) $item->description = substr($item->description, 0, 100) . '...';
            /* cod */
            if ($item->status != 2) $html .= "<div class=\"cat_id\">".$item->cod."</div>";

             $html .= '</div></a></div>';


            /* more */
            $html .= '</div>
               </li></div>';


            echo $html;
        }

        echo '</ul></section>';

        $counting = Cats::counting();

//        echo '<span class="aug_blue_bg bold white-text bottom-msg" style="z-index:120">
//    <small class="text_10">Já encaminhamos '.($counting[0]->total).' gatinhos para adoção!</small>
//</span>';
        echo '<span class="aug_blue_bg bold white-text bottom-msg" style="z-index:120">
    <small class="text_10">Já encaminhamos '.($counting).' gatinhos para adoção!</small>
</span>';


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


    $html = '<li id="gato'.$item->id.'" class="modal">
    <div class="modal-content"><article class="p-20">
      <h4 class="text_15 aug_blue">'.$item->name.' <a href="#!" class="modal-action modal-close right"><i class="icon-purple ic-close-circle"></i></a></h4>

      <p>'.strip_tags($item->godfather_description).'</p>';
        if ($item->godfathers_list < 1) {
            $html .= '<p><br><br><img src="'.HOST.'/img/sadcat.png" width="100" height="71" style="width:auto; margin-right:30px;" class="left" /><br>Ainda não tenho padrinhos. <br>';
        } else {
            $html .= $godfathers. '<br><br>';
        }

    $html .= '<a href="'.HOST.'/apadrinhamento/cadastro/#'.$item->name.'" class="aug_purple"> Clique aqui para apadrinhar '.$item->name.'</a>.<br><br><br></p></article></div>

  </li>';
    $html .= '<li class="col s12 m6 l4">
        <div class="card border_b_blue card-wrapper max-height-godfather">
        <div class="card-image card-image-godfather-large waves-effect waves-block waves-light">
            <div class="fix_image_card">
                <a class="modal-trigger" style="display:block;position: relative;bottom: 0;" href="#gato'.$item->id.'"><img src="'.MEDIA_DIR."uploads/cats/".$item->picture.'"   /></a>';
    if ($item->godfathers_list < 1) $html .= "<div class=\"no_godfather aug_blue_bg white-text bold upper text-right p-2\">Sem padrinhos</div>";
    $html .= '

        </div>
        </div>
        <div class="card-content">
          <span class="card-title white aug_blue bold upper truncate" style="text-shadow: none; width:100%"><a class="modal-trigger aug_blue" style="display:block;position: relative;bottom: 0;" href="#gato'.$item->id.'">'.$item->name.'<i class="material-icons right" style="position: absolute; left: 92%;top: 12px;">more_vert</i></a></span>
        </div>
      </div>
      </li>';



            echo $html;
        }
        echo '</ul></section>';
    }
}

<?php

class CatsController extends Controller {

    private $get;
    private $post;
    private $views;

    public function init()
    {
        $this->get = Request::get();
        $this->post = Request::post();
    }

    public function godfathered()
    {
        Phalanx::loadClasses('Godfather');
        
        $this->views = new Views(new Template("public", "default.phtml"));
        //$this->views->cat_list = Godfather::get_detailed();
        $this->views->display('godfathered_cats.phtml');
    }
    
    public function godfathered_form()
    {
        $this->views = new Views(new Template("public", "default.phtml"));
        
        $this->views->display('godfathered_form.phtml');
    }

    public function godfathered_send()
    {
        $m = Model::Factory('newsletter');
        
        $m->name          = $this->post->nome;
        $m->email         = $this->post->email;
        $m->opt_in_date   = date('Y-m-d H:i:s');
        $insertion_status = $m->insert();
                        
        Phalanx::loadExtension('phpmailer');
        $mail = new PHPMailer(true);

        $mail->IsSMTP();
        $mail->SMTPAuth   = true;
        $mail->Host       = "smtp.adoteumgatinho.com.br";
        $mail->Port       = 587;
        $mail->Username   = "sistema@adoteumgatinho.com.br";
        $mail->Password   = "aussie00"; 
            
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';

        //$mail->SetFrom($this->post->email, $this->post->nome);
        $mail->SetFrom("apadrinhamento@adoteumgatinho.com.br", "Adote um Gatinho");
        $mail->AddReplyTo($this->post->email, $this->post->nome);
        $mail->AddAddress("apadrinhamento@adoteumgatinho.com.br");


        $mail->Subject = "Formulário de Apadrinhamento - AUG";
        $mail->MsgHTML(nl2br("Olá! Recebemos um cadastro para apadrinhamento:
            
        <em>Nome:</em> {$this->post->nome}
        <em>E-Mail:</em> {$this->post->email}
        <em>Endereço:</em> {$this->post->endereco}
        <em>Cidade/UF:</em> {$this->post->cidade}/{$this->post->estado}
        
        <em>Valor da Doação:</em> {$this->post->valor}
        <em>Dia da Doação:</em> {$this->post->dia}
        <em>Forma de Pagamento:</em> {$this->post->pagamento}
        
        No caso de depósito programado:
        <em>Período:</em> {$this->post->deposito_programado}
    
        <em>Gatos escolhidos:</em> {$this->post->gatos}
        
        <em>Comentários:</em> {$this->post->comentarios}
        --
        Adote um Gatinho
        ".date("d/m/Y H:i").""));

        //$mail->SMTPDebug = 1;
        
        if(!$mail->Send()) {
            echo 'Mailer error: ' . $mail->ErrorInfo;
        }

        Request::redirect(HOST . 'apadrinhamento/cadastrado');
    }
    
    public function godfathered_success()
    {
        $template = new Template("public", "/default.phtml");
        
        $template->og = new stdClass;
        
        $template->og->title = 'Adote um Gatinho';
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Acabo de adotar um gatinho! Adote você também! ' . HOST;
        
        $this->views = new Views($template);
        $this->views->display("/godfathered_success.phtml");
    }
    
    public function details()
    {
        Phalanx::loadClasses('Cats');
        
        $cat_data = Cats::get($this->get->cat_id);
        $template = new Template("public", "cats_full_page.phtml");
        $template->og = new stdClass;
        $template->og->title = $cat_data->name;
        $template->og->description = $cat_data->description;
        $template->og->img = MEDIA_DIR . 'uploads/cats/' . $cat_data->picture;

        $this->views = new Views($template);
        $this->views->data = $cat_data;
        $this->views->display("cat_detail.phtml");
    }

    public function form()
    {
        Phalanx::loadClasses('Cats');
        
        $user = Cats::get_responsible($this->get->cat_id);
        
        $this->views = new Views(new Template("public", "default.phtml"));
        $this->views->cat_id = $this->get->cat_id;
        $this->views->responsible_email = $user[0]->email;
        
        $this->views->display('adoption_form.phtml');
    }

    public function proccess()
    {
        Phalanx::loadClasses('Cats');
        
        $cat_id = $this->get->cat_id;
        
        $c = Model::Factory('cats');
        $c->where("id = {$cat_id}");
        $gato = $c->get();
        
        $m = Model::Factory('cats_interests');
        
        $m->cats_id                  = $this->post->cat_id;
        $m->name                     = $this->post->name;
        $m->email                    = $this->post->email;
        $m->telephone                = $this->post->telephone;
        $m->age                      = $this->post->age;
        $m->address                  = $this->post->address;
        $m->address_number           = $this->post->address_number;
        $m->address_complement       = $this->post->address_complement;
        $m->address_neighborhood     = $this->post->address_neighborhood;
        $m->address_city             = $this->post->address_city;
        $m->address_state            = $this->post->address_state;
        $m->number_of_adults_at_home = $this->post->number_of_adults_at_home;
        $m->number_of_kids_at_home   = $this->post->number_of_kids_at_home;
        $m->kids_age                 = $this->post->kids_age;
        $m->why_adopt_a_cat          = $this->post->why_adopt_a_cat;
        $m->owner_accept_pets        = $this->post->owner_accept_pets;
        $m->lives_in                 = $this->post->lives_in;

        $items_that_block_ur_cat = array();
        foreach($this->post->items_that_block_your_cat as $item)
        {
            $items_that_block_ur_cat[] = $item;
        }
        $m->items_that_block_your_cat  = implode("\n", $items_that_block_ur_cat);
        
        
        ////////AIEEE
        $have_other_petss = array();
        foreach($this->post->have_other_pets as $item)
        {
            $have_other_petss[] = $item;
        }
        $m->have_other_pets  = implode("\n", $have_other_petss);
        
        
        
        $items_that_your_house_have = array();
        foreach($this->post->items_that_your_house_have as $item)
        {
            $items_that_your_house_have[] = $item;
        }
        $m->items_that_your_house_have  = implode("\n", $items_that_your_house_have);
        
        $house_window_types = array();
        foreach($this->post->house_window_types as $item)
        {
            $house_window_types[] = $item;
        }
        $m->house_window_types  = implode("\n", $house_window_types);
        
        $m->already_had_a_cat          = $this->post->already_had_a_cat;
        $m->what_happened_to_your_cats = $this->post->what_happened_to_your_cats;
        $m->have_other_pets            = $this->post->have_other_pets;
        $m->cat_qtty                   = $this->post->cat_qtty;

        $m->have_monetary_conditions                    = $this->post->have_monetary_conditions;
        $m->someone_has_allergy                         = $this->post->someone_has_allergy;
        $m->what_youll_do_when_someone_gets_pregnant    = $this->post->what_youll_do_when_someone_gets_pregnant;
        $m->what_youll_do_if_the_cat_scratches_your_son = $this->post->what_youll_do_if_the_cat_scratches_your_son;
        $m->what_youll_do_if_you_lose_your_cat          = $this->post->what_youll_do_if_you_lose_your_cat;
        $m->what_youll_do_if_you_cant_take_care_of_the_cat_anymore = $this->post->what_youll_do_if_you_cant_take_care_of_the_cat_anymore;
        $m->cats_can_live_more_than_fifteen_years       = $this->post->cats_can_live_more_than_fifteen_years;

        $m->house_can_be_revisited       = $this->post->house_can_be_revisited;
        $m->deliver_the_cat_back         = $this->post->deliver_the_cat_back;
        $m->do_not_repass_the_cat        = $this->post->do_not_repass_the_cat;
        $m->tell_us_about_address_change = $this->post->tell_us_about_address_change;
        
        $m->sign_an_adoption_contract    = $this->post->sign_an_adoption_contract;
        $m->comments                     = $this->post->comments;

        $how_you_met_aug = array();
        foreach($this->post->how_you_met_aug as $item)
        {
            $how_you_met_aug[] = $item;
        }
        $m->how_you_met_aug = implode("\n", $how_you_met_aug);

        $status = $m->insert();

        if($status)
        {
            $msg = nl2br("Olá! Recebemos um pedido de adoção:

            Gato: {$gato->name}
                    
            <b>Sobre você e sua família</b>

            <em>Nome:</em> {$this->post->name}
            <em>E-Mail:</em> {$this->post->email}
            <em>Telefone:</em> {$this->post->telephone}
            <em>Idade:</em> {$this->post->age}
            <em>Endereço:</em> {$this->post->address}
            <em>Número:</em> {$this->post->address_number}
            <em>Complemento:</em> {$this->post->address_complement}
            <em>Bairro:</em> {$this->post->address_neighborhood}
            <em>Cidade:</em> {$this->post->address_city}
            <em>Estado:</em> {$this->post->address_state}
            <em>Número de adultos na casa:</em> {$this->post->number_of_adults_at_home}

            ");

            if($this->post->number_of_kids_at_home > 0)
            {
                $msg .= nl2br("<em>Tenho</em> {$this->post->number_of_kids_at_home} <em>crianças de</em> {$this->post->kids_age} <em>anos</em>
                ");
            }

            $msg .= nl2br("
            <em>Por que adotar um gatinho?</em>
            {$this->post->why_adopt_a_cat}

            <b>Sobre a sua casa</b>

            <em>Se sua casa é alugada, o proprietário permite animais?</em> {$this->post->owner_accept_pets}

            <em>Você mora em:</em> {$this->post->lives_in}
            ");

            if($this->post->lives_in == "CASA FECHADA")
            {
                $msg .= nl2br("
            <em>Itens que impedem o gatinho de sair para rua e telhados:</em>
            {$m->items_that_block_your_cat}
            ");
            }

            if($this->post->lives_in == "APARTAMENTO COM TELAS")
            {
                $msg .= nl2br("<em>Se assinalou \"Apartamento com telas\":</em>
            {$m->items_that_block_your_cat}
            ");
            }

            if($this->post->lives_in == "APARTAMENTO SEM TELAS")
            {
                $msg .= nl2br("<em>Se assinalou \"Apartamento sem telas\":</em>
            {$m->items_that_block_your_cat}
            ");
            }
            
            if($this->post->lives_in == "COBERTURA COM TELAS")
            {
                $msg .= nl2br("<em>Se assinalou \"Cobertura com telas\":</em>
            {$m->items_that_block_your_cat}
            ");
            }

            if($this->post->lives_in == "COBERTURA SEM TELAS")
            {
                $msg .= nl2br("<em>Se assinalou \"Cobertura sem telas\":</em>
            {$m->items_that_block_your_cat}
            ");
            }
            
            $msg .= nl2br("
            <em>Para qualquer tipo de casa ou apartamento, responda se você possui:</em>
            {$m->items_that_your_house_have}
            ");
            
            $msg .= nl2br("
            <em>E sobre as basculantes, elas são de que tipo:</em>
            {$m->house_window_types}
            ");
            
            $msg .= nl2br("
            <b>Seus animais</b>

            <em>Já teve gatos?</em> {$this->post->already_had_a_cat}
            ");

            if($this->post->already_had_a_cat == "SIM")
            {
                $msg .= nl2br("<em>Se você já teve gatos, o que aconteceu com eles?</em>
            {$this->post->what_happened_to_your_cats}

            ");
            }

            ////AIEE
//            $msg .= nl2br("<em>Tem outros animais em casa?</em> {$this->post->have_other_pets}
//            ");
            $msg .= nl2br("<em>Tem outros animais em casa?</em> {$m->have_other_petss}
            ");

            
            
            
            
            
            
            

            if($this->post->have_other_pets == "SIM GATO")
            {
                $msg .= nl2br("<em>Quantos gatos você tem?</em> {$this->post->cat_qtty}
            ");
            }

            $msg .= nl2br("
            <b>Adoção é compromisso e responsabilidade</b>

            <em>Você tem condições de acrescentar no seu orçamento os gastos que terá com alimentação de boa qualidade (aproximadamente R$70 por mês), vacinas e atendimento veterinário (aproximadamente R$180 anualmente)?</em>
            {$this->post->have_monetary_conditions}

            <em>Alguém em casa tem alergia?</em>
            {$this->post->someone_has_allergy}

            <em>O que fará com o gatinho se alguém na casa engravidar?</em>
            {$this->post->what_youll_do_when_someone_gets_pregnant}

            <em>O que fará se o gato arranhar o seu filho?</em>
            {$this->post->what_youll_do_if_the_cat_scratches_your_son}

            <em>O que fará se perder o gatinho?</em>
            {$this->post->what_youll_do_if_you_lose_your_cat}

            <em>O que fará se não puder cuidar mais do gatinho?</em>
            {$this->post->what_youll_do_if_you_cant_take_care_of_the_cat_anymore}
                
            <em>O que fará se tiver que mudar de cidade ou país?</em>
            {$this->post->what_youll_do_if_you_move_from_city_or_country}

            <em>Gatos podem viver 15 anos ou mais. Você está preparado para este compromisso?</em>
            {$this->post->cats_can_live_more_than_fifteen_years}

            <b>Condições</b>

            <em>Você concorda que sua casa seja vistoriada para averiguação das respostas acima?</em>
            {$this->post->house_can_be_revisited}

            <em>Você concorda em nos devolver o gatinho se por qualquer motivo não puder continuar com ele?</em>
            {$this->post->deliver_the_cat_back}

            <em>Você concorda em não repassar o gatinho a ninguém sem antes nos consultar?</em>
            {$this->post->do_not_repass_the_cat}

            <em>Você concorda em nos avisar em caso de alteração de endereço, telefone, etc?</em>
            {$this->post->tell_us_about_address_change}

            <em>Você concorda em assinar um contrato de adoção no ato da entrega, responsabilizando pelos cuidados com o animal e sua segurança?</em>
            {$this->post->sign_an_adoption_contract}

            <b>Comentários</b>

            <em>Escreva neste espaço tudo o que julgar necessário, inclusive qualquer dúvida que você tiver sobre a adoção:</em>
            {$this->post->comments}

            <em>Como você conheceu o AUG?</em>
            {$m->how_you_met_aug}

            --
            Adote um Gatinho
            ".date("d/m/Y H:i")."");
            
            
//            foreach($this->post->items_that_block_your_cat as $item)
//        {
//            $items_that_block_ur_cat[] = $item;
//        }

            $user = Cats::get_responsible($this->post->cat_id);
 
            Phalanx::loadExtension('phpmailer');
            $mail = new PHPMailer(true);
            
            $mail->IsSMTP();
            $mail->SMTPAuth   = true;
            $mail->Host       = "smtp.adoteumgatinho.com.br";
            $mail->Port       =  587;
            $mail->Username   = "sistema@adoteumgatinho.com.br";
            $mail->Password   = "aussie00"; 

            $mail->IsHTML(true); 
            $mail->CharSet = 'UTF-8';
            
            $mail->SetFrom("informacoes@adoteumgatinho.com.br", "Adote um Gatinho");
            $mail->AddReplyTo($this->post->email, $this->post->nome);
            $mail->AddAddress($user[0]->email);
            
            if(!$user) $mail->AddAddress("informacoes@adoteumgatinho.com.br");

            $mail->Subject = "Formulário de Adoção - Gato: {$gato->name} - AUG";
            $mail->MsgHTML($msg);

            //$mail->SMTPDebug = 1;
            
            if(!$mail->Send()) {
                echo 'Mailer error: ' . $mail->ErrorInfo;
            }
            
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();

            Request::redirect(HOST . 'pedido-processado-com-sucesso');
        }
        else
        {
            Request::redirect(HOST . 'falha-ao-processar-pedido');
        }
    }


    public function success_page()
    {
        $template = new Template("public", "default.phtml");
        
        $template->og = new stdClass;
        $template->og->title = 'Adote um Gatinho';
        $template->og->img = HOST.'templates/public/css/images/logo.png';
        $template->og->description = 'Acabo de adotar um gatinho! Adote você também! ' . HOST;
        
        $this->views = new Views($template);
        $this->views->display("adoption_success.phtml");
    }

    public function error_page()
    {
        $this->views = new Views(new Template("public", "default.phtml"));
        $this->views->display("adoption_error.phtml");
    }
}
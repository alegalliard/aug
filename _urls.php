<?php

    Phalanx::urlPatterns(
        array(
        
        ''			=> 'public.IndexController.cats',
        'pagina/(?P<page>\d+?)' => 'public.IndexController.cats',
        'quero-adotar'		=> 'public.IndexController.index',

        'adocoes-especiais'		       => 'public.IndexController.special_cats',
        'gatos-adotados'		       => 'public.IndexController.adopted_cats',
        'gatos-adotados/pagina/(?P<page>\d+?)' => 'public.IndexController.adopted_cats',

        'detalhes-gato/(?P<cat_id>\d+?)/(?P<cat_name>.*)'	 => 'public.CatsController.details',
        'formulario-de-adocao/(?P<cat_id>\d+?)/(?P<cat_name>.*)' => 'public.CatsController.form',
        'finalizar-processo-de-adocao'          => 'public.CatsController.proccess',
        'pedido-processado-com-sucesso'			         => 'public.CatsController.success_page',
        'falha-ao-processar-pedido'				 => 'public.CatsController.error_page',

        'buscar(?P<search_query>.*)'                  => 'public.SearchController.search',

        'materias'				      => 'public.NewsController.show_all',
        'materia/(?P<id>\d+?)/(?P<slug>.*)'	      => 'public.NewsController.show_specific',

        'aug-na-midia'				      => 'public.PressReleasesController.show_all',
        'aug-na-midia/(?P<id>\d+?)/(?P<slug>.*)'      => 'public.PressReleasesController.show_specific',

        'boletins'                                    => 'public.MailingController.show_all',
        'boletins/(?P<id>\d+?)/(?P<slug>.*)'          => 'public.MailingController.show_specific',

        'depoimentos'				      => 'public.TestimonialsController.show_all',
        'depoimentos/(?P<id>\d+?)/(?P<slug>.*)'	      => 'public.TestimonialsController.show_specific',

        'cartinhas'				      => 'public.TestimonialsController.show_all',
        'cartinhas/(?P<id>\d+?)/(?P<slug>.*)'	      => 'public.TestimonialsController.show_specific',
            
        'cadastre-se'				      => 'public.SignupController.form',
        'cadastre-se/confirmar'			      => 'public.SignupController.proccess',
        'cadastre-se/cadastro-finalizado-com-sucesso' => 'public.SignupController.success',
        'cadastre-se/erro-ao-finalizar-cadastro'      => 'public.SignupController.error',

        'apadrinhamento'                 => 'public.CatsController.godfathered',
        'apadrinhamento/cadastro'        => 'public.CatsController.godfathered_form',
        'apadrinhamento/cadastro/enviar' => 'public.CatsController.godfathered_send',
        'apadrinhamento/cadastrado'      => 'public.CatsController.godfathered_success',
            
        'prestacao-de-contas/contas'  => 'public.AccountingController.ShowDebit',
        'prestacao-de-contas/doacoes' => 'public.AccountingController.ShowCredit',
            
        /* ajax */
        'parser'   => 'public.AjaxController.parserInterests',
            
        'paginated'   => 'public.AjaxController.paginated',
        'special'     => 'public.AjaxController.special',
        'adopted'     => 'public.AjaxController.adopted',
        'godfathered' => 'public.AjaxController.godfathered',
        )
    );


    //Admin
    Phalanx::urlPatterns(
        array(
        'adm'		      => 'admin.IndexController.index',
        'adm/login'	      => 'admin.IndexController.login',
        'adm/logout'	      => 'admin.IndexController.logout',
        'adm/processar-login' => 'admin.IndexController.process_login'
        )
    );


    //Admin - Páginas Dinâmicas
    Phalanx::urlPatterns(
        array(
        'adm/paginas'			    	=> 'admin.PagesController.show',
        'adm/paginas/adicionar'		        => 'admin.PagesController.form',
        'adm/paginas/editar/(?P<page_id>\d+?)'  => 'admin.PagesController.form',
        'adm/paginas/salvar'		        => 'admin.PagesController.save',
        'adm/paginas/remover/(?P<page_id>\d+?)' => 'admin.PagesController.delete',	
        )
    );

    //Admin - Matérias
    Phalanx::urlPatterns(
        array(
        'adm/materias'			    => 'admin.NewsController.show',
        'adm/materias/adicionar'	    => 'admin.NewsController.form',
        'adm/materias/editar/(?P<id>\d+?)'  => 'admin.NewsController.form',
        'adm/materias/salvar'		    => 'admin.NewsController.save',
        'adm/materias/remover/(?P<id>\d+?)' => 'admin.NewsController.delete',	
        )
    );

    //Admin - AUG NA MÍDIA
    Phalanx::urlPatterns(
        array(
        'adm/aug-na-midia'			=> 'admin.PressReleasesController.show',
        'adm/aug-na-midia/adicionar'	        => 'admin.PressReleasesController.form',
        'adm/aug-na-midia/editar/(?P<id>\d+?)'	=> 'admin.PressReleasesController.form',
        'adm/aug-na-midia/salvar'		=> 'admin.PressReleasesController.save',
        'adm/aug-na-midia/remover/(?P<id>\d+?)' => 'admin.PressReleasesController.delete',	
        )
    );


    //Admin - DEPOIMENTOS
    Phalanx::urlPatterns(
        array(
        'adm/depoimentos'                      => 'admin.TestimonialsController.show',
        'adm/depoimentos/adicionar'	       => 'admin.TestimonialsController.form',
        'adm/depoimentos/editar/(?P<id>\d+?)'  => 'admin.TestimonialsController.form',
        'adm/depoimentos/salvar'	       => 'admin.TestimonialsController.save',
        'adm/depoimentos/remover/(?P<id>\d+?)' => 'admin.TestimonialsController.delete',	
        )
    );


    //Admin - Boletins
    Phalanx::urlPatterns(
        array(
        'adm/boletins'			    => 'admin.MailingController.show',
        'adm/boletins/adicionar'	    => 'admin.MailingController.form',
        'adm/boletins/editar/(?P<id>\d+?)'  => 'admin.MailingController.form',
        'adm/boletins/salvar'		    => 'admin.MailingController.save',
        'adm/boletins/remover/(?P<id>\d+?)' => 'admin.MailingController.delete',	
        )
    );

    //Admin - Usuários
    Phalanx::urlPatterns(
        array(
        'adm/usuarios'			     => 'admin.UsersController.show',
        'adm/usuarios/adicionar'	     => 'admin.UsersController.form',
        'adm/usuarios/editar/(?P<uid>\d+?)'  => 'admin.UsersController.form',
        'adm/usuarios/remover/(?P<uid>\d+?)' => 'admin.UsersController.delete',
        'adm/usuarios/salvar'		     => 'admin.UsersController.save'	
        )
    );

    //Admin - Usuários
    Phalanx::urlPatterns(
        array(
        'adm/querem-adotar'			 => 'admin.WantToAdoptController.show',
        'adm/querem-adotar/remover/(?P<id>\d+?)' => 'admin.WantToAdoptController.delete',	
        )
    );

    //Admin - Gatos
    Phalanx::urlPatterns(
        array(
        'adm/gatos/all'					    	=> 'admin.CatsController.show',
        'adm/gatos/all/(?P<page>\d+?)'                    	=> 'admin.CatsController.show',
        'adm/gatos/editar/(?P<cat_id>\d+?)'		    	=> 'admin.CatsController.form',
        'adm/gatos/adicionar'			   		=> 'admin.CatsController.form',
        'adm/gatos/salvar'				    	=> 'admin.CatsController.save',
        'adm/gatos/remover/(?P<cat_id>\d+?)'			=> 'admin.CatsController.delete_cat',
        'adm/gatos/ativar/(?P<cat_id>\d+?)'			=> 'admin.CatsController.activate',
        'adm/gatos/special/(?P<status>\d+?)/(?P<cat_id>\d+?)'   => 'admin.CatsController.special',			
        'adm/gatos/reservas'			    		=> 'admin.CatsController.reserved',
        'adm/gatos/reservas/(?P<page>\d+?)'     		=> 'admin.CatsController.reserved',
        'adm/gatos/adotados'                                    => 'admin.CatsController.adopted',
        'adm/gatos/adotados/(?P<page>\d+?)'			=> 'admin.CatsController.adopted',
        'adm/gatos/para-adocao'                                 => 'admin.CatsController.available_adoption',
        'adm/gatos/para-adocao/(?P<page>\d+?)'                  => 'admin.CatsController.available_adoption',
        'adm/gatos/para-apadrinhamento'                         => 'admin.CatsController.available_godfathering',
        'adm/gatos/para-apadrinhamento/(?P<page>\d+?)'  	=> 'admin.CatsController.available_godfathering',
        'adm/autorizar-adocao'					=> 'admin.CatsController.confirm',
        'adm/gatos/adotar/(?P<cat_id>\d+?)'                     => 'admin.CatsController.make_adoption',
        'adm/gatos/desadotar/(?P<cat_id>\d+?)'                  => 'admin.CatsController.undo_adoption',
        'adm/gatos/promover'					=> 'admin.CatsController.promote',
        'adm/gatos/reservar/(?P<status>\d+?)/(?P<cat_id>\d+?)'  => 'admin.CatsController.reservation',
        'adm/gatos/desativados'			    		=> 'admin.CatsController.deactivated',
        'adm/gatos/desativados/(?P<page>\d+?)'			=> 'admin.CatsController.deactivated',
        'adm/gatos/reordenar-gatos'				=> 'admin.CatsController.order_cats',
        'adm/gatos/reordenar-gatos/salvar'		  	=> 'admin.CatsController.order_cats_save',
        'adm/gatos/reordenar-apadrinhados'			=> 'admin.CatsController.order_cats_godfathered',
        'adm/gatos/reordenar-apadrinhados/salvar'	  	=> 'admin.CatsController.order_cats_godfathered_save',
        'adm/adocao-finalizada-com-sucesso'		    	=> 'admin.CatsController.display_success_message',
        'adm/adocao-nao-finalizada'			    	=> 'admin.CatsController.display_error_message',
        'adm/remover-pedido-de-adocao/(?P<cat_id>\d+?)' 	=> 'admin.CatsController.delete_adoption_interest',
        'adm/gatos/apadrinhados'				=> 'admin.CatsController.godfathered',
        'adm/gatos/apadrinhados/(?P<page>\d+?)' 		=> 'admin.CatsController.godfathered'
        )
    );

    Phalanx::urlPatterns(
        array(
        'adm/padrinhos'			     => 'admin.TheGodfatherController.show',
        'adm/padrinhos/adicionar'	     => 'admin.TheGodfatherController.form',
        'adm/padrinhos/editar/(?P<id>\d+?)'  => 'admin.TheGodfatherController.form',
        'adm/padrinhos/excluir/(?P<id>\d+?)' => 'admin.TheGodfatherController.delete',
        'adm/padrinhos/salvar'		     => 'admin.TheGodfatherController.save'
        )
    );

    //Admin - Destaques
    Phalanx::urlPatterns(
        array(
        'adm/destaques'			     => 'admin.BillBoardController.show',
        'adm/destaques/adicionar'	     => 'admin.BillBoardController.form',
        'adm/destaques/remover/(?P<id>\d+?)' => 'admin.BillBoardController.delete',
        'adm/destaques/salvar'		     => 'admin.BillBoardController.save'	
        )
    );

    //Admin - Newsletter
    Phalanx::urlPatterns(
        array(
        'adm/newsletter'		       => 'admin.NewsletterController.show',
        'adm/newsletter/adicionar-usuario'     => 'admin.NewsletterController.add',
        'adm/newsletter/salvar'                => 'admin.NewsletterController.save',
        'adm/newsletter/pagina-(?P<page>\d+?)' => 'admin.NewsletterController.show',
        'adm/newsletter/remover/(?P<id>\d+?)'  => 'admin.NewsletterController.delete',
        'adm/newsletter/extrair-relatorio'     => 'admin.NewsletterController.report'
        )
    );


    //Admin - prestação de contas
    Phalanx::urlPatterns(
        array(
        'adm/prestacao-de-contas'                      => 'admin.AccountingController.ShowAll',
        'adm/prestacao-de-contas/adicionar'            => 'admin.AccountingController.Add',
        'adm/prestacao-de-contas/salvar'               => 'admin.AccountingController.Save',
        'adm/prestacao-de-contas/remover/(?P<id>\d+?)' => 'admin.AccountingController.Delete'
        )
    );



    Phalanx::urlPatterns(
        array(
        '(?P<page_slug>.*)' => 'public.PagesController.display_page'
        )
    );
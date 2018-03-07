$(function(){
    
    $('#open_search').on('click touchstart', function(e){
        e.stopPropagation();
        $('#top_search').toggleClass('hide-on-med-and-up');
        $('#open_search').toggleClass('hide-on-med-and-up');
    });

    $('#botao_busca').on('click touchstart', function(e){
        if ($('#busca').value == ""){
        e.stopPropagation();
    }
    });
    

    
    /* ========================
    
        NEWSLETTER PARTS 
    
    ======================== */
    var validateEmail = function (email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    };

    var validateName = function(name) {
        var re = /^[A-Za-z\s]+$/;
        return re.test(name);
    };
    
    $('#newsletter-signup-form').on('submit', function(e){
        var news_name = $(this).find('#name').val();
        var news_mail = $(this).find('#email').val();
		if(!validateEmail(news_mail)){
            e.preventDefault();
            $('<span class="error err_mail">E-mail inválido</span>').insertAfter('#email');
        } else {
            $('.error.err_mail').remove();
        }
        if(!validateName(news_name) || news_name.length < 5){				
            $('<span class="error err_name">Insira seu nome</span>').insertAfter('#name');
            e.preventDefault();
        } else {
            $('.error.err_name').remove();
        }
    });
    $('#name, #email').on('blur', function(){
        $('#newsletter-signup-form').find('.error').remove();
    });
    
    
    
    /* ========================
    
        SEARCH PARTS 
    
    ======================== */
    $('.hidden_menu form, .search_container, #fixed_search').on('submit', function(e){
        var input = $(this).find('.search_field').val();
        if(input.length < 4){
            $('.search_field').css('color', 'red');
            e.preventDefault();
        } else {
            $('.search_field').removeAttr('style');
        }        
    });
    
    $('.search_field').on({
        'keyup': function(e){
            if(($(this).val()).length < 4){
                $('.search_field').css('color', 'red');
            } else {
                $('.search_field').removeAttr('style');
            }
        }
    });
    
    
    $('.collapsible').collapsible();
    

    //comportamento do menu
    $('#hide_menu').on('click', function(e){
        e.preventDefault();
        $('.hidden_menu').removeClass('open_menu active').addClass('hide_menu'); 
        $('body').css('overflow','auto');
    });
    
     $('#open_menu').on('click', function(){
        if(window.innerWidth < 993){                    
            $('.hidden_menu').removeClass('hide_menu').addClass('open_menu active');
            $('body').css('overflow','hidden');
        } else {
            $(this).find('menu').toggle();
        }
    });
    

    $('#open_menu').on('mouseenter', function(){
        if(window.innerWidth > 994){
            $(this).find('menu').show();
        }
        
    });
    $('#menu').on('mouseleave', function(){
        $(this).hide();
    });
    //fim do comportamento do menu
    
    $('#call-quero-adotar').on('click', function(e){
        e.preventDefault();
        $('.links_box').toggle();
        $('html, body').animate({scrollTop: $("#call-quero-adotar").offset().top}, 500);
    });
    
    $('#hide-sub').on('click touchstart', function(e){        
        e.preventDefault();
        $('.links_box').slideUp();
    });
    
    
    /*mural de gatos*/
    // var muralFix = function(){
    //     var mural = $('.mural');
        
    //     if(window.innerWidth > 621){
    //         var muralW = mural.find('li').width();
    //         mural.find('li').height(muralW);
    //     }
    // }
    
    // muralFix();

    
    // $( window ).resize(function() {
    //     muralFix();
    //     if(window.innerWidth < 1024) {
    //         $('#top_search').hide();
    //     } else {
    //         $('#top_search').removeAttr('style');
    //     }
    //     if(window.innerWidth < 621) {
    //         $('#menu').removeAttr('style');
    //     }
            
    // });
    
    
    
    
    
            
            $('.range').on('change', function(){
                var rangeValue = $(this).val();
                var icons = $(this).siblings('i');
                $.each(icons, function(index){
                    if(rangeValue <= index){
                         icons.eq(index+1).removeClass('icon-purple icon-grey').addClass('icon-grey');
                    } else {
                        
                        icons.eq(index+1).removeClass('icon-purple icon-grey').addClass('icon-purple');
                    }
                });
            });
//            $('.ghost').css('opacity', 0.5);
            $('.sexo').on('change', function(){
                $('.sexo').parent().find('i').removeClass('icon-purple').addClass('icon-grey');
                
                if($('.sexo').is(':checked')){
                    $('.sexo:checked').parent().find('i').removeClass('icon-grey').addClass('icon-purple');
                }
                
                switch($('.sexo:checked').size()){
                    case 3:
                        $('#gender').val('M F B');
                    break;
                    case 2:
                        var obj = $('.sexo:checked');
                        var final = '';
                        $.each(obj, function(index,value){
                            final += $(value).val()+' ';
                        });
                        $('#gender').val(final);
                        
                    break;
                    case 1:
                        var val = $('.sexo:checked').val();
                        $('#gender').val(val);
                    break;
                    default: $('#gender').val('0');
                }
                
                
                
            });
            
    
    //comportamento do filtro colapsado no breadcrumb
        $('.select.action').on('click', function(e){
            e.stopPropagation();
            if(window.innerWidth < 621){ //verifica a tela
                $('.target[data-target=open-sub]').slideToggle();
                
                //se já estiver aberto, colapsa
                if($('#fixed_search').hasClass('mobile_open')){ 
                
                $('#fixed_search').stop().animate({
                    bottom: "-=390"
                  }, 500, function() {
                     $(this).removeClass('mobile_open');
                    
                  });
                } else { // se estiver fechado, abre
                    $('#fixed_search').stop().animate({
                    bottom: "+=390"
                  }, 500, function() {
                        $(this).addClass('mobile_open');
                  });
                }
            } else {
                $('.target[data-target=open-sub]').slideToggle();
            }
        });
            
            $('.mural').find('a').on('click', function(){
                $('#overlay').fadeIn(300);
                $('.popover').delay(150).fadeIn(500);
                
            });
            
            $('.close, #overlay').on('click', function(){
                $('#overlay, .popover').fadeOut(300, function(){
                    $('#overlay, .popover').removeAttr('style');
                });
            });
    
    

    //blend roxo dos gatinhos
    //detecta a versão do navegador chrome
	function isChrome() {//a função busca pela versão que fica após o termo citado e converte em número inteiro para poder comparar
		var myNavChrome = navigator.userAgent.toLowerCase();
		return (myNavChrome.indexOf('chrome/') != -1) ? parseInt(myNavChrome.split('chrome/')[1]) : false;
	}
	//detecta a versão do navegador firefox e se é internet explorer
	function isFirefoxandIE() {
		var myNavFirefox = navigator.userAgent.toLowerCase();
		return (myNavFirefox.indexOf('rv:') != -1) ? parseInt(myNavFirefox.split('rv:')[1]) : false;
	}
		//como a função só funciona a partir da versão 35 do chrome e da versão 30 do firefox e não funciona no IE e no Edge, montei esta condicional que passou nos testes.
		if (isChrome() <= 35 && isChrome() != false || isFirefoxandIE() <= 30 && isFirefoxandIE() != false || navigator.userAgent.match(/Edge/) == "Edge") {

			    $(".meio_mural a").hover(function(){
			        $(this).prev().css("display", "inline-block");
			        }, function(){
			        $(this).prev().css("display", "none");
			    });
			
		}
    
    
  //remover acentos
    function removerAcentos( newStringComAcento ) {
  var string = newStringComAcento;
	var mapaAcentosHex 	= {
		a : /[\xE0-\xE6]/g,
		e : /[\xE8-\xEB]/g,
		i : /[\xEC-\xEF]/g,
		o : /[\xF2-\xF6]/g,
		u : /[\xF9-\xFC]/g,
		c : /\xE7/g,
		n : /\xF1/g
	};

	for ( var letra in mapaAcentosHex ) {
		var expressaoRegular = mapaAcentosHex[letra];
		string = string.replace( expressaoRegular, letra );
	}

	return string;
}
    
    /* ========================
    
        Geolocation por cidade
    
    ======================== */    
    
    function displayLocation(latitude,longitude){
        var request = new XMLHttpRequest();

        var method = 'GET';
        var url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='+latitude+','+longitude+'&sensor=true';
        var async = true;

        request.open(method, url, async);
        request.onreadystatechange = function(){
          if(request.readyState == 4 && request.status == 200){
            var data = JSON.parse(request.responseText);
            var address = data.results[0];
            var city = address.address_components[3].long_name;
              
              switch(removerAcentos(city).toLowerCase()){
                  case 'sao paulo':
                      console.log('Você está em São Paulo');
                  break;
                  case 'sao bernardo do campo':
                      console.log('Você está em São Bernardo do Campo');
                  break;
                  case 'sao caetano do sul': 
                      console.log('Você está em São Caetano do Sul');
                  break;
                  case 'santo andre': 
                      console.log('Você está em Santo André');
                  break;
                  default: showLocationMess();
              }
          }
        };
        request.send();
      };
    
      if(!window.localStorage.getItem('showGeoBlock')) 
      {
            localStorage.setItem('showGeoBlock', 1); 
      }     
      
      var showLocationMess = function(){
          var blockMsg = '<div id="nocat" class="geo-block-msg hide-on-small-and-down aug_orange_bg"><h5>O Adote um Gatinho somente doa para as cidades de São Paulo, Santo André, São Bernardo do Campo e São Caetano do Sul.</h5> Procure o Centro de Controle de Zoonoses ou associações na sua região caso esteja fora da nossa área de atuação.<br> Agradecemos a compreensão.</div>';

          if($('[data-block="location"]').length > 0){
                $('[data-block="location"]').css('opacity',0.5);
                $('body').append(blockMsg);

                window.setTimeout(function(){
                    window.localStorage.setItem('showGeoBlock',2);
                    $(document).find('#nocat').fadeOut(1000);
                },10000);
            }
      }
      
      var successCallback = function(position){
        var x = position.coords.latitude;
        var y = position.coords.longitude;
        displayLocation(x,y);
      };

      var errorCallback = function(error){
        var errorMessage = 'Unknown error';
        switch(error.code) {
          case 1:
            errorMessage = 'Geo: Permissão negada';
            break;
          case 2:
            errorMessage = 'Geo: Posição não disponível';
            break;
          case 3:
            errorMessage = 'Geo: Tempo esgotado';
            break;
        }
        console.log(errorMessage);
          showLocationMess();
      };

      var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
      };

      if($('[data-block="location"]').length > 0 && "geolocation" in navigator){
          if(window.localStorage.getItem('showGeoBlock') == 1){
              navigator.geolocation.getCurrentPosition(successCallback,errorCallback,options);
          }
     }
    
    
$(document).ready(function() {

        var galleryIndex = Math.floor((Math.random()*5)+1);
        $(".bg-image" + galleryIndex).css("opacity", "1");
        if (galleryIndex===4 || galleryIndex===5){
            $(".white-on-dark-bg").addClass("white-text");
            $(".white-on-dark-bg").removeClass("aug_blue aug_purple"); 
        }
        else {
            $(".blue-marker").addClass("aug_blue");
            $(".purple-marker").addClass("aug_purple");
        }
        
        setInterval(function(){
            if (galleryIndex===5){
                $(".bg-image" + galleryIndex).css("opacity", "");
                galleryIndex = 1;
                $(".bg-image" + galleryIndex).css("opacity", "1");
            }
            else{
                $(".bg-image" + galleryIndex).css("opacity", "");                
                galleryIndex++;
                $(".bg-image" + galleryIndex).css("opacity", "1");
            }
                if (galleryIndex===4 || galleryIndex===5){
                    $(".white-on-dark-bg").addClass("white-text");
                    $(".white-on-dark-bg").removeClass("aug_blue aug_purple"); 
                }
                else {
                    $(".blue-marker").addClass("aug_blue");
                    $(".purple-marker").addClass("aug_purple");
                }
        }, 20000);
    });

    $(document).scroll(function(){
        if ($(window).scrollTop() > 50){
            $(".title-cats").addClass('go-top');
        }
        else {
            $(".title-cats").removeClass('go-top'); 
        }               
    })
});
var cat_name = $('#cat-name').text();
var msg_approved = 'Olá,' +
  '\n'+
  '\n'+
  'Nós da Adote um Gatinho e da Petz estamos felizes em dizer que seu '+
  'cadastro foi aprovado. '+cat_name+' agora vai fazer parte da sua família. '+
  'Venha buscá-lo no endereço abaixo:'+
  '\n'+
  '\n'+
  'Em caso de desistência, nos notifique respondendo este e-mail o mais '+
  'rápido possível.'+
  '\n'+
  '\n'+
  'Miauto obrigada!'+
  '\n'+
  '\n'+
  'Adote um Gatinho e Petz.';

var msg_rejected = 'Olá,'+
  '\n'+
  '\n'+
  'Infelizmente seu cadastro para adotar '+cat_name+' não foi aprovado.'+
  '\n'+
  '\n'+
  'Miauto obrigada!'+
  '\n'+
  '\n'+
  'Adote um Gatinho e Petz.';

  var show_form = function(show = false) {
    var form = $('#petz-notification');
    if(show) {
      form.slideDown();
    } else {
      form.slideUp();
    }
  }

  var change_to_wait = function() {
    var statuses = $('.statuses');
    $.each(statuses, function(k,v) {
      if(!$(this).parent().parent().hasClass('active')) {
        if($(v).val() == 'APPROVED') {
          status_wait($(v).attr('data-id'));
          $(v).val('WAIT');
        }
      }
    });

    $('.active').removeClass('active');
  }

  var fill_current_user = function(current) {
    var name = current.attr('data-name');
    var email = current.attr('data-email');
    var id = current.attr('data-id');

    $('#current_user').val(name);
    $('#current_email').val(email);
    $('#current_id').val(id);
  }

  $('.statuses').on('change', function() {
    var status = $(this);
    var msg = $('#msg');
    var tipo_msg = $('#tipo');

    fill_current_user(status);

    switch(status.val()){
      case 'REJECTED':
        msg.val(msg_rejected);
        tipo_msg.val('REJECTED');
        show_form(true);
      break;
      case 'APPROVED':
        msg.val(msg_approved);
        tipo_msg.val('APPROVED');
        show_form(true);
      break;
      default:
        show_form(false);
        status_wait($(this).attr('data-id'));
    }
  });

  $('#tipo').on('change', function() {
    var selected = $(this).val();
    var msg = msg_approved;
    if(selected == 'REJECTED') {
      msg = msg_rejected;
    }

    $('#msg').val(msg);

  });

  $('.queue_list tbody').find('tr').on('click', function(e){
    $('.active').removeClass('active');
    $(this).addClass('active');
    e.stopPropagation();
  });

  $('.close').on('click', function(e) {
    e.preventDefault();
    $('#petz-notification').slideUp();
  })


  $('#petz-notification').on('submit', function(e){

    e.preventDefault();
    e.stopPropagation();

    var msg = $('#msg').val();
    var status = $('#tipo').val();
    var user = $('#user').val();
    var current_id = $('#current_id').val();
    var send_mail = $('#notify').val();

    var user_name = $('#current_user').val();
    var user_email = $('current_email').val();
    var data = {
      action: 'save',
      id: current_id,
      user: user_name,
      email: user_email,
      status: status,
      message: msg,
      send_mail: send_mail
    }

    $.ajax({
        type: "POST",
        url: "<?php echo HOST;?>adm/gatos/fila-de-espera/salvar",
        data: data
    });

    change_to_wait();
    show_form(false);
  });

  $('#notify').on('change', function(){
    var box = $('#email_box');
    if($(this).val() === 1)
      box.slideDown();
    else
      box.slideUp();
  });



  var status_wait = function(line) {
    $.ajax({
        type: "POST",
        url: "<?php echo HOST;?>adm/gatos/fila-de-espera/salvar",
        data: {
            action: 'single',
            id: line,
            status: 'WAIT'
        }
    });
  }

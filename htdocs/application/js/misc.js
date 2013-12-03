function email_focus() {
	if ($(this).val() == 'Ingresar Email') {
		$(this).val('')
		$(this).removeClass('faded');
	}
}

function email_blur() {
	if ($(this).val() == '') {
		$(this).val('Ingresar Email')
		$(this).addClass('faded');
	}	
}

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function subscribe_submit() {
	email = $('#email_field').val();
	
	if(email == 'Ingresar Email' || email == '') {
		displaymessage('Favor ingresar un email valido!', false);
		return false;
	}

	if(!validateEmail(email)) {
		displaymessage('Favor ingresar un email valido!', false);
		return false;
	}

	$.post(base_url + 'landing/ajax_subscribe', $('#subscribe_form').serialize(), subscribe_result, 'json');
	$('#loading').fadeIn('fast');
	return false;
}

function subscribe_result(data) {
	$('#loading').hide();
	if (data.success) {
		//display_message(data.error);
		displaymessage(data.message, true);
	} else {
		//display_message(data.info, 'info');
		displaymessage(data.message, false);
	}
}

function displaymessage(msg, state) {

	if(state == true) {
		$( "#dialog_title" ).html( 'Suscripcion Exitosa' );
	} else {
		$( "#dialog_title" ).html( 'Atencion!' );
	}
	
	$( "#dialog_text" ).html( msg );
	
	$( "#dialog_message" ).dialog( "destroy" );
	// Dialog
	$('#dialog_message').dialog({
		resizable: false,
		width: 600,
		modal: true,
		buttons: {
			"Ok": function() {
				$(this).dialog("close");
			}
		}
	});
	
	return false;
}

function display_message(msg, type) {

	if (!type) type = 'error';

	if (type == 'error') {
		$('#error_message').html(msg).fadeIn('slow');
		setTimeout('hide_error()', 4000);
	} else {
		$('#error_message').hide();
		$('#info_message').html(msg).fadeIn('slow');
	}
}

function hide_error() {
	$('#error_message').fadeOut('slow');
}

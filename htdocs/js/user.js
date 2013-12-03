$(document).ready(function(){
	var emailcheckresult = false;
	$.validator.addMethod("emailcheck", function(value) {
		$.ajax({
			type: "post",
			url: base_url+"front/user/emailcheck",
			dataType: "json",
			data: {
				'email': value
			},
			success: function(response) {
				if (response == true){ 
					emailcheckresult = false;
				} else {
					/*
					var errors = {};
					errors[element.name] =  response;
					validator.showErrors(errors);
					*/
					emailcheckresult = true;
				}
			}
		}); // End ajax method
		return emailcheckresult;
	}, 'The email already exist, please choose another');

	var usernamecheckresult = false;
	$.validator.addMethod("usernamecheck", function(value) {
		$.ajax({
			type: "post",
			url: base_url+"front/user/usernamecheck",
			dataType: "json",
			data: {
				'username': value
			},
			success: function(response) {
				if (response == true){ 
					usernamecheckresult = false;
				} else {
					/*
					var errors = {};
					errors[element.name] =  response;
					validator.showErrors(errors);
					*/
					usernamecheckresult = true;
				}
			}
		}); // End ajax method
		return usernamecheckresult;
	}, 'The username already exist, please choose another');

});
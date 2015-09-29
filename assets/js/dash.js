//document ready 
$(function() {

});

/**************
* submit add client account form 
***************/

$("#save_acc").click(function(e){
	//validate the add new client form
	validate_add_acc_form();
});

$("#edit-client-user-profile").click(function(e){
	//validate the add new client form
	validate_user_profile_form();
});

$("#edit-client-user-pw").click(function(e){
	//validate the add new client form
	validate_pw_form();
});

function validate_add_acc_form () {
	var validator = new FormValidator('add-acc', 
	[{
	    name: 'full_names',
	    display: 'full names',
	    rules: 'required'
	}, {
	    name: 'company',
	    rules: 'Enter your company name',
	    rules: 'required'
	}, {
	    name: 'phone',
	    display: 'enter valid phone number',
	    rules: 'required|numeric'
	}, {
	    name: 'email',
	    display: 'enter valid email address',
	    rules: 'required|valid_email'
	}, {
	    name: 'password',
	    display: 'password confirmation',
	    rules: 'required|min_length[8]'
	}, {
	    name: 'domain',
	    display: 'enter the valid domain name like http://www.example.com',
	    rules: 'required|valid_url'
	}, {
	    name: 'amount',
	    display: 'enter amount paid',
	    rules: 'required|numeric'
	}], 
	function(errors, evt) {
		var SELECTOR_ERRORS = $('.error_box');
	    
		if (errors.length > 0) {
	       show_errors(errors, SELECTOR_ERRORS);
	    } else {
	       //submit form for processing 
	       process_add_acc_form();
	    }

	    if (evt && evt.preventDefault) {
	        evt.preventDefault();
	    } else if (event) {
	        event.returnValue = false;
	    }

	});
}

function process_add_acc_form () {
	full_names = $('#full_names').val();
	company = $('#company').val();
	email = $('#email').val();
	phone = $('#phone').val();
	password = $('#password').val();

	domain = $('#domain').val();
	plan = $('#plan').val();
	acc_status = $('#acc_status').val();

	amount = $('#amount').val();
	date = $('#date').val();

	//do a post ajax request to the server, return json data
	$.post("/admin/add_acc", 
	{
		'full_names' : full_names,
		'company': company, 
		'email': email, 
		'phone': phone, 
		'password': password, 

		'domain': domain, 
		'plan': plan, 
		'acc_status': acc_status, 

		'amount': amount, 
		'date': date
	}, 
	function(data) {
		//redirect to account page
		var client_id = data.client_id;
		window.location = "/admin/view_acc/" + client_id;
	}, 
	"json"); 

}//close add_acc

function validate_user_profile_form () {
	var validator = new FormValidator('edit_client_user_profile', 
		[{
			name: 'full_names', 
			rules: 'required'
		}, {
			name: 'company', 
			rules: 'required'
		}, {
			name: 'phone', 
			rules: 'required|numeric'
		}], 
		function(errors, evt) {
			var SELECTOR_ERRORS = $('.user_profile_edit_errors');
			if (errors.length > 0) {
		       show_errors(errors, SELECTOR_ERRORS);
		    } else {
		       //submit form for processing 
		        full_names = $('#full_names').val();
				company = $('#company').val();
				email = $('#email').val();
				phone = $('#phone').val();
		        
		        process_user_profile_form(full_names, company, email, phone);
		    }

		    if (evt && evt.preventDefault) {
		        evt.preventDefault();
		    } else if (event) {
		        event.returnValue = false;
		    }

		});
}//close validate_user_profile_form

function process_user_profile_form(full_names, company, email, phone) {
	
	$.post("client/edit_profile", 
	{
		'full_names' : full_names,
		'company': company, 
		'email': email, 
		'phone': phone
	}, 
	function(data) {
		//just reload the page
		window.location.reload();
	}, 
	"html"); 
	
}//close edit_client_profile

function validate_pw_form () {
	var validator = new FormValidator('client_edit_user_pw', 
		[{
			name: 'old_pw', 
			rules: 'required|min_length[8]'
		}, {
			name: 'new_pw1', 
			display: 'first password',
			rules: 'required|min_length[8]'
		}, {
			name: 'new_pw2', 
			display: 'password confirmation',
			rules: 'required|min_length[8]|matches[new_pw1]'
		}], 
		function(errors, evt) {
			var SELECTOR_ERRORS = $('.client_edit_user_pw_errors');
		    if (errors.length > 0) {
		        // Show the errors
		        show_errors(errors, SELECTOR_ERRORS);
		    }else{
		    	//submit data for processing
		    	old_pw = $('#old_pw').val();
				new_pw1 = $('#new_pw1').val();
				new_pw2 = $('#new_pw2').val()

				process_pw_form(old_pw, new_pw1);
		    }

		    if (evt && evt.preventDefault) {
		        evt.preventDefault();
		    } else if (event) {
		        event.returnValue = false;
		    }
		});
}//close validate_pw_form

function process_pw_form(old_pw, new_pw) {

	$.post("/client/chg_pw", 
	{
		'old_pw': old_pw,
		'new_pw':new_pw
	}, 
	function(data) {
		//redirect to login page, so user can login with their new password
		window.location.href = "/logout";
	},	
	"html"); 

}//close edit_client_user_pw

function show_errors(errors, SELECTOR_ERRORS) {

    SELECTOR_ERRORS.empty();

    for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
    	console.log(errors[i].message);
        SELECTOR_ERRORS.append(errors[i].message + '<br />');
    }
    SELECTOR_ERRORS.css('display', 'block');
}//close show_errors

function clientmgt (action, url) { 
	
	switch (action) {
	case 'renew_acc':
		window.location = url;
		break;
	case 'act_acc':
		if (confirm("Activate this Account?")) {
			window.location = url;
		};
		break;
	case 'de_act_acc':
		if (confirm("De-Activate this Account?")) {
			window.location = url;
		};
		break;
	case 'del_acc':
		if (confirm("Delete this Account?")) {
			window.location = url;
		};
		
		break;
	}//close switch
	
}//close clientmgt
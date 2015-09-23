//document ready 
$(function() {

});

/**************
* submit add client account form 
***************/

$("#save_acc").click(function(e){
	//alert("you just clicked me");
	add_acc();
});

function add_acc () {
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
		//$('.client_acc_success').css('display', 'block');
		//redirect to another url
		var client_id = data.client_id;
		window.location = "/admin/view_acc/" + client_id;
	}, 
	"json"); 

}//close add_acc

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
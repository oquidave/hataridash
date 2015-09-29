<div class="container add_client_acc">
	
	<!-- show response message when form is submitted -->
	<div class="row client_acc_success" style="display: none">
		<div class="md-8">
			<div class="alert alert-success" role="alert">
				Well done. Client account saved! 
			  	<a href="/view_acc/2" class="alert-link">View client account</a>
			</div>
		</div>
	</div>
	
	<!--Add Account Admin -->
	<div class="row">
		<div class="col-md-8">
			<h2>Add Account Admin</h2>

			<div class="error_box"></div>
			
			<form name="add-acc" action="#" method="POST">
			  <div class="form-group">
			    <label for="full_names">Full Names</label>
			    <input type="text" name="full_names" class="form-control" id="full_names" placeholder="David Okwii">
			  </div>
			  <div class="form-group">
			    <label for="company">Company Name</label>
			    <input type="text" name="company" class="form-control" id="company" placeholder="HatariCloud LTD">
			  </div>
			  <div class="form-group">
			    <label for="phone">Phone</label>
			    <input type="text" name="phone" class="form-control" id="phone" placeholder="256778123456">
			  </div>
			  <div class="form-group">
			    <label for="email">Email</label>
			    <input type="email" name="email" class="form-control" id="email" placeholder="jane.doe@example.com">
			  </div>
			  <div class="form-group">
			    <label for="password">Password</label>
			    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
			  </div>
		</div><!-- close col -->
	</div><!--close add Account Admin -->

	<hr>

	<!--Add Account details -->
	<div class="row">
		<div class="col-md-8">
			<h2>Add Account Details</h2>
			
			  <div class="form-group">
			    <label for="domain">Domain Name</label>
			    <input type="text" name="domain" class="form-control" id="domain" placeholder="http://www.example.com">
			  </div>
			  <div class="form-group">
			  	<label for="plan">Select Hosting Package</label>
			  	<select name="plan" class="form-control" id="plan">
				  <option class="active">Copper</option>
				  <option>Aluminium</option>
				  <option>Tungsten</option>
				</select>
			  </div>
			  <div class="form-group">
			  	<input type="checkbox" name="acc_status"  id="acc_status"><label for="acc-status">Activate</label>
			  </div>
			 
		</div>
	</div><!--close add Account details -->
	
	<hr>

	<!--Add Account billing -->
	<div class="row">
		<div class="col-md-8">
			<h2>Add Account Billing</h2>
		
			  <div class="form-group">
			    <label for="amount">Amount Paid</label>
			    <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter amount paid">
			  </div> 
			  <div class="form-group">
			  	<label for="date">Pick Date</label>
			  	<input type="text" name="date" class="form-control" id="datepicker" placeholder="Date account is created">
			  </div>
		
		</div>
	</div><!--close Add Account billing -->
	
	<hr>

	<!-- submit form --> 
	<div class="row">
		<div class="col-md-8">
			<button id="save_acc" class="btn btn-primary btn-block btn-lg">Save Account</button>
		</div>
	</div>
</form>
</div> <!-- close container -->


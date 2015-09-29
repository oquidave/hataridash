
<div class="row">
	<div class="container">
		<!-- menu -->
		<div class="col-12">
			<ul class="nav nav-pills">
			  <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
			  <li><a href="#account" data-toggle="tab">Account</a></li>
			  <li><a href="#billing" data-toggle="tab">Billing</a></li>
			</ul>
			
			<!--display content here -->
		
			<div class="tab-content">

				<!-- profile tab -->
				<div class="row tab-pane active" id="profile">
					<h2>Edit your Account details</h2>
					<div class="col-md-6">
						<!-- show some validation errors here --> 
						<div class="user_profile_edit_errors alert alert-warning" style="display: none"></div>
						<!-- edit basic profile user info -->
						<div class="panel panel-default">
					        <div class="panel-heading">
					          <h3 class="panel-title">Change your profile details</h3>
					        </div>
							<form class="edit-client-user-profile" name="edit_client_user_profile" >
							  <div class="form-group">
							    <label for="full_names">Full Names</label>
							    <input type="text" class="form-control" name="full_names" id="full_names" 
							    placeholder="<?php echo $full_names; ?>" >
							  </div>
							  <div class="form-group">
							    <label for="phone">Phone</label>
							    <input type="text" class="form-control" name="phone" id="phone" 
							    placeholder=<?php echo $phone; ?> >
							  </div>
							  <div class="form-group">
							    <label for="email">Email</label>
							    <input type="text" class="form-control" name="email" id="email" 
							    placeholder=<?php echo $email; ?> >
							  </div>
							  <div class="form-group">
							    <label for="company">Company</label>
							    <input type="text" class="form-control" name="company" id="company" 
							    placeholder="<?php echo $company; ?>" >
							  </div>
							  <button id="edit-client-user-profile" class="btn btn-primary">Save changes</button>
							</form>
						</div>
					</div>

					<div class="col-md-6">
						<!-- show some validation errors here --> 
						<div class="client_edit_user_pw_errors alert alert-warning" style="display: none"></div>
						<!-- reset user password -->
						<div class="panel panel-default">
					        <div class="panel-heading">
					          <h3 class="panel-title">Change your password</h3>
					        </div>
							<form class="client-edit-user-pw" name="client_edit_user_pw" >
							  <div class="form-group">
							    <label for="old_pw">Old password</label>
							    <input type="password" class="form-control" name="old_pw" id="old_pw" placeholder="Old Password">
							  </div>
							  <div class="form-group">
							    <label for="new_pw1">New password</label>
							    <input type="password" class="form-control" name="new_pw1" id="new_pw1" placeholder="New Password">
							  </div>
							  <div class="form-group">
							    <label for="new_pw2">Confirm new password</label>
							    <input type="password" class="form-control" name="new_pw2" id="new_pw2" placeholder="Confirm new Password">
							  </div>
							  <button id="edit-client-user-pw" class="btn btn-primary">Update password</button>
							</form>
						</div>
					</div>
				</div><!-- close profile tab-pane -->
				
				<!-- account details tab -->
				<div class="tab-pane" id="account" >
					<h2>View your Account details</h2>
						<div class="panel panel-default panel-tweak">
						  <div class="panel-heading">
						    <h3 class="panel-title">Your Plan</h3>
						  </div>
						    <table class="table">
							  <thead>
							  	<tr class="tb-header">
							  		<td>Websites</td><td>Hosting Plan</td><td>Status</td>
							  	</tr>
							  </thead>
							  <tbody>
							  	<tr>
							  		<td><?php echo $domain; ?></td>
							  		<td><?php echo $plan; ?></td>
							  		<td><?php echo $acc_status; ?></td>
							  	</tr>
							  </tbody>
							</table>
						</div><!-- close panel-->
				</div> <!-- close account details tab -->

				<!-- billing details tab -->
				<div class="tab-pane"  id="billing" >
					<h2>View your Billing info</h2>
					<div class="panel panel-default panel-tweak">
						  <div class="panel-heading">
						    <h3 class="panel-title">Your Plan</h3>
						  </div>
						    <table class="table">
							  <thead>
							  	<tr class="tb-header">
							  		<td>Invoice</td><td>Amount</td><td>Date issued</td>
							  	</tr>
							  </thead>
							  <tbody>

							  	<?php foreach ($invoices as $invoice): ?>
							  	<tr>
							  		<td><?php echo $invoice->id ?></td>
							  		<td><?php echo $invoice->amount ?></td>
							  		<td><?php echo $invoice->date_paid ?></td>
							  	</tr>
							  	<?php endforeach; ?> 

							  </tbody>
							</table>
						</div><!-- close panel-->
				</div> <!-- billing details tab -->
			
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="container">
		<!-- menu -->
		<div class="col-12">
			<ul class="nav nav-pills">
			  <li><a href="#profile" data-toggle="tab">Admin Profile</a></li>
			  <li class="active"><a href="#account" data-toggle="tab">Account</a></li>
			  <li><a href="#billing" data-toggle="tab">Billing</a></li>
			</ul>
			
			<!--display content here -->
		
			<div class="tab-content">

				<!-- profile tab -->
				<div class="tab-pane" id="profile" >
					<h2>Admin profile</h2>
					<div class="thumbnail client-admin">
				      <img src="/assets/img/tom.jpg" alt="User profile">
				      <div class="caption">
				        <h3>Admin details</h3>
				        <ul class="client-admin-details">
				        	<li>
								<span class="glyphicon glyphicon-user client-key"></span>
							  	<span class="client-key">Full Names:</span>
							  	<strong> 
							  		<?php echo $client_admin_user->first_name.$client_admin_user->last_name;  ?> 
							  	</strong>
							</li>
				        	<li>
				        		<span class="glyphicon glyphicon glyphicon-globe client-key"></span>
				        		<span class="client-key">Phone No:</span>
				        		<strong> 
				        			<?php echo $client_admin_user->phone; ?>
				        		</strong>
				        	</li>
				        	<li>
				        		<span class="glyphicon glyphicon glyphicon glyphicon-envelope client-key"></span>
				        		<span class="client-key">Email:</span>
				        		<strong> 
				        			<?php echo $client_admin_user->email; ?>
				        		</strong>
				        	</li>
				        </ul>

				        <p>
				        <a href="#" class="btn btn-primary" role="button">Send Message</a> 
				        <a href="#" class="btn btn-danger" role="button">Delete</a>
				        </p>
				      </div>
				    </div>
				</div> <!-- close profile tab -->
				
				<!-- account details tab -->
				<div class="tab-pane active" id="account" >
					<h2>View your Account details</h2>
						<div class="panel panel-default panel-tweak">
						  <div class="panel-heading">
						    <h3 class="panel-title">Your Plan</h3>
						  </div>
						    <table class="table">
							  <thead>
							  	<tr class="tb-header">
							  		<td>Websites</td><td>Hosting Plan</td><td>Status</td><td>Options</td>
							  	</tr>
							  </thead>
							  <tbody>
							  	<tr>
							  		<td> 
							  			<?php echo $client->domain; ?>
							  		</td>
							  		<td>
							  			<?php echo $client->plan; ?>
							  		</td>

									<td class= <?php echo ($gui_acc_options['status'] == 'active')? 'active-status': 'inactive-status';?> >
										<?php $val = ($gui_acc_options['status'] == 'active')? 'Active': 'Inactive'; echo $val; ?>
									</td>

							  		<td>
							  			<a href="#" <?php $act = ($gui_acc_options['actions']['act1'] == 'renew')? 'renew_acc': 'act_acc';
							  				$url = "/admin/client_mgt/". $act. "/". $client->id;?> 
							  				onclick=clientmgt(<?php echo "'$act','$url'"; ?>);	class="acc-options acc-options-act">
							  				<span class="glyphicon glyphicon-edit"></span>
							  				<?php $val = ($gui_acc_options['actions']['act1'] == 'renew')? 'Renew': 'Activate'; echo $val; ?>
							  			</a>
							  			<a href="#" <?php $act = ($gui_acc_options['actions']['act2'] == 'deactivate')? 'de_act_acc': 'del_acc'; 
							  				$url = "/admin/client_mgt/". $act. "/". $client->id; ?> 
							  				onclick=clientmgt(<?php echo "'$act','$url'"; ?>);	class="acc-options acc-options-del">
							  				<span class="glyphicon glyphicon-off"></span>
							  				<?php $val = ($gui_acc_options['actions']['act2'] == 'deactivate')? 'De-Activate': 'Delete'; echo $val; ?>
							  			</a>
							  		</td>
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
						    <h3 class="panel-title">Your Billing History</h3>
						  </div>
						    <table class="table">
							  <thead>
							  	<tr class="tb-header">
							  		<td>Invoice No</td><td>Amount</td><td>Date issued</td>
							  	</tr>
							  </thead>
							  <tbody>
							  <?php foreach ($client_invoices as $client_invoice): ?>
							  	<tr>
							  		<td>
							  			#<?php echo $client_invoice->id; ?>
							  		</td>
							  		<td>
							  			<?php echo $client_invoice->amount; ?>
							  		</td>
							  		<td>
							  			<?php echo $client_invoice->date_paid; ?>
							  		</td>
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

<div class="container">

	<div class="row">
		<div class="col-md-4">
		  <h4>All Client Accounts </h4>
		</div>
		<div class="col-md-4 col-md-offset-4">
			<a href="/admin/add_acc" class="btn btn-primary">Add Account</a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8"> <!-- col-md-offset-2 -->
			<div class="panel panel-default panel-tweak">
			  <div class="panel-heading">
			    <h3 class="panel-title">Current clients</h3>
			  </div>
			    <table class="table">
				  <thead>
				  	<tr class="tb-header">
				  		<td>Account</td><td>Status</td><td>Options</td>
				  	</tr>
				  </thead>
				  <tbody>

				  	 <?php foreach ($clients as $client): ?>

				  	<tr>
				  		<td>
				  			<?php echo $client->company; ?>
				  		</td>
				  		<td>Active</td>
				  		<td class="client-actions">
				  			<a class="client-actions-view" href= <?php echo "/admin/view_acc/". $client->id; ?> > 
				  				<span class="glyphicon glyphicon-info-sign"></span>View
				  			</a>
				  			<a href="#" class="client-actions-del"
				  			 <?php $url="/admin/client_mgt/del_acc/". $client->id; ?> 
				  			 onclick=clientmgt(<?php echo "'del_acc','$url'";  ?>); > 
				  				<span class="glyphicon glyphicon-remove-circle"></span>Delete
				  			</a>
				  		</td>
				  	</tr>

				  	<?php endforeach; ?> 
				  	
				  </tbody>
				</table>
			</div><!-- close panel-->
		</div>
		
	</div>
</div>
<div class="container">
	<div class="row">
		<h2>Renew Account</h2>
		<form class="form-horizontal" method="post" 
			action=<?php echo "/admin/client_mgt/renew_acc/".$client_id ?> >
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Account</label>
		    <div class="col-sm-10">
		      <p class="form-control-static"> <?php echo $company ?> </p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="domain" class="col-sm-2 control-label">Domain</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="domain" placeholder=<?php echo $domain ?> readonly>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="amount" class="col-sm-2 control-label">Amount</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter amount paid" >
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="plan" class="col-sm-2 control-label">Current Plan</label>
		    <div class="col-sm-10">
		    	<select class="form-control" name="plan" id="plan">
				  <option>Copper</option>
				  <option>Aluminium</option>
				  <option>Tungsten</option>
				</select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="date" class="col-sm-2 control-label">Date</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="date" id="date" placeholder="Date of renewal">
		    </div>
		  </div>
		  <div class="form-group">
		  	<div class="col-sm-2 col-sm-offset-10">
		  	 <button type="submit" class="btn btn-primary">Renew Account</button>
		  	</div>
		  </div>
		</form>
	</div>
</div>
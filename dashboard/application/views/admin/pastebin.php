<td class= <?php echo ($gui_acc_options['status'] == 'active')? 'active-status': 'inactive-status';?> >
<?php $val = ($gui_acc_options['status'] == 'active')? 'Active': 'Inactive'; echo $val; ?>
</td>

	<td>
		<a href=<?php $act = ($gui_acc_options['actions']['act1'] == 'renew')? 'renew_acc': 'act_acc';
			echo "/admin/client_mgt/". $act. "/". $client->id;?> class="acc-options acc-options-act">
			<span class="glyphicon glyphicon-edit"></span>
			<?php $val = ($gui_acc_options['actions']['act1'] == 'renew')? 'Renew': 'Activate'; echo $val; ?>
		</a>
		<a href=<?php $act = ($gui_acc_options['actions']['act2'] == 'deactivate')? 'de_act_acc': 'del_acc'; 
			echo "/admin/client_mgt/". $act. "/". $client->id; ?> class="acc-options acc-options-del">
			<span class="glyphicon glyphicon-off"></span>
			<?php $val = ($gui_acc_options['actions']['act2'] == 'deactivate')? 'De-Activate': 'Delete'; echo $val; ?>
		</a>
	</td>



<tr>
  		<td> 
  			<?php echo $client->domain; ?>
  		</td>
  		<td>
  			<?php echo $client->plan; ?>
  		</td>
  		<td class="active-status">Active</td>
  		<td>
  			<a href="/admin/renew_acc" class="acc-options acc-options-act">
  				<span class="glyphicon glyphicon-edit"></span>Renew
  			</a>
  			<a href="#" class="acc-options acc-options-del">
  				<span class="glyphicon glyphicon-off"></span>De-activate
  			</a>
  		</td>
  	</tr>
  	<tr>
  		<td>HatariCloud</td><td>Tungsten</td><td class="inactive-status">Inactive</td>
  		<td>
  			<a href="" class="acc-options acc-options-act">
  				<span class="glyphicon glyphicon-edit"></span>Activate
  			</a>
  			<a href="" class="acc-options acc-options-del">
  				<span class="glyphicon glyphicon-remove-circle"></span>Delete
  			</a>
  		</td>
  	</tr>
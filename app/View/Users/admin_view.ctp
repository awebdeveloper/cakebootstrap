<div class="users view">
	<div class="page-header">
		<h1>
			<?php echo __('User'); ?>
			<div class="pull-right">
				<?php 
	    			echo $this->Form->postLink(__('Reset Password'), array('action' => 'passwordreset', $user['User']['id'],'admin'=> TRUE), 
												 array('class'=>'btn btn-warning'), __('Are you sure you want to reset ')); 
	    		?>
	    		<?php
	    			if(strtolower($_USER['UserType']) === 'dev' || !in_array(strtolower($user['UserType']['name']),array('dev','admin')))
	    			{
	    				if($user['User']['status'] === 'active')
						{
							echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id'],'admin'=> TRUE), 
												 array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $user['User']['username'])); 
						}
						else if($user['User']['status'] === 'active')
						{
							echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id'],'admin'=> TRUE), 
												 array('class'=>'btn btn-danger'), __('Are you sure you want to delete # %s?', $user['User']['username'])); 
						}
					}
				?>
	    	</div> 
		</h1>
  	</div>
	<ul class="breadcrumb">
		<li>
		    <?php  echo $this -> Html -> link(__('Dashboard'), array(
					'controller' => 'users',
					'action' 	 => 'dashboard',
					'prefix' 	 => false
				), array('title' => 'Dashboard'));
			?>
		    <span class="divider">/</span>
		</li>
		<li> 
			<?php  echo $this -> Html -> link(__('User'), array(
					'controller' => '<?php echo User; ?>',
					'action' 	 => 'index'
				), array('title' => '<?php echo User; ?>'));
			?>
		    <span class="divider">/</span>
		</li>
		<li>
		    User
		</li>
	</ul>
	<div>
		<div class="span9">
			<h2>#<?php echo h($user['User']['id']); ?></h2>
			<table class="table table-striped">
				<tr>
					<td><strong><?php echo __('Id'); ?></strong></td>
					<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
				</tr>
				<tr>
					<td><strong><?php  echo __('User Type');  ?></strong></td>
					<td>
						<?php echo $this->Html->link($user['UserType']['name'], 
							array('controller' => 'user_types', 'action' => 'view', $user['UserType']['id'])); ?>&nbsp;
					</td>
				</tr>			
				<tr>
					<td><strong><?php echo __('Username'); ?></strong></td>
					<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
				</tr>			
				<tr>
					<td><strong><?php echo __('Email'); ?></strong></td>
					<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
				</tr>						
				<tr>
					<td><strong><?php echo __('Status'); ?></strong></td>
					<td><?php echo h($user['User']['status']); ?>&nbsp;</td>
				</tr>			
				<tr>
					<td><strong><?php echo __('Created'); ?></strong></td>
					<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
				</tr>			
				<tr>
					<td><strong><?php echo __('Modified'); ?></strong></td>
					<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
				</tr>		
			</table>
		</div>
		<div class="span3">
			<div class="accordion" id="accordion2">
				<div class="accordion-group">
					<div class="accordion-heading">
						<span class="accordion-toggle black-heading" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
							<i class="icon-bookmark icon-white"></i> 
							<span class="divider-vertical"></span> Analytics 
						</span>
					</div>
					<div id="collapseOne" class="accordion-body collapse" style="height: 0px; ">
						<table class="table table-striped">
							<tbody>
								<tr>
									<td><?php  echo $this -> Html -> link(__('Logins'), array(
												'controller' => 'UserLogins',
												'action' 	 => 'user_index',
												$user['User']['id']
											), array('title' => 'View User Logins'));
									?></td>
									<td><?php echo intval($user['User']['user_login_count']); ?></td>
								</tr>
								<tr>
									<td><?php  echo $this -> Html -> link(__('Shares'), array(
											'controller' => 'Shares',
											'action' 	 => 'index',
											'admin'		 => true,
											'?' 		 => array('user' => $user['User']['id'])
											), array('title' => 'View User Comments'));
										?></td>
									<td><?php echo intval($user['User']['user_share_count']); ?></td>
								</tr>
								<tr>
									<td colspan="2"><?php  echo $this -> Html -> link(__('Tickets'), array(
												'controller' => 'tickets',
												'action' 	 => 'index',
												'admin'		 => true,
												'tickettype' => 'all',
												'assignee' 	 => 'all',
												'?' 		 => array('email' => urlencode($user['User']['email']))
											), array('title' => 'View User Tickets'));
									?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
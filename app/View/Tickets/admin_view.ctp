<div class="tickets view">
	<div class="page-header">
		<h1>
			<?php echo __('Ticket'); ?>
			<div class="pull-right">
				<?php echo $this->Html->link(__('Edit'), 
	 								array('action' => 'edit', $ticket['Ticket']['id']),
	 								array('class'=>'btn btn-success')); ?>
	 			<a href="#" class="btn btn-inverse js-back"> Back </a>
				
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
			<?php  echo $this -> Html -> link(__('Ticket'), array(
					'controller' => '<?php echo Ticket; ?>',
					'action' 	 => 'index'
				), array('title' => '<?php echo Ticket; ?>'));
			?>
		    <span class="divider">/</span>
		</li>
		<li>
		    Ticket
		</li>
	</ul>

	<div>
		<div class="span9">
			<h2>#<?php echo h($ticket['Ticket']['id']); ?></h2>
			<hr class="seperator" />
			<div class="clearfix well">
				<div class="span3" align="center">
					<div class="thumbnail">
							<img src="<?php echo ASSETURL ?>img/user.png" />
					</div>
					<?php 
							$asker = $ticket['User']['id'];
							echo ife(!empty($ticket['User']['username']), $ticket['User']['username'], 
									substr(h($ticket['Ticket']['email']),0,15).'...'); 
					?><br />
				</div>
				<div class="span7">
					<?php echo h($ticket['Ticket']['created']); ?><br />
					<?php echo h($ticket['Ticket']['description']); ?>
				</div>
			</div>	
			<?php
				if (!empty($ticket['Ticketcomment'])){
					foreach ($ticket['Ticketcomment'] as $ticketcomment){ ?>
					<hr class="seperator" />
					<div class="clearfix <?php echo ife($asker == $ticketcomment['User'],'well') ?>">

						<div class="span3" align="center">
							<div class="thumbnail">
									<img src="<?php echo ASSETURL ?>img/user.png" />
							</div>
							<?php echo $ticketcomment['User']['username']; ?><br />
						</div>
						<div class="span7">
							<?php echo h($ticketcomment['created']); ?><br />
							<?php echo h($ticketcomment['description']); ?>
						</div>
					</div>
				<?php 
					}
				} 
			?> 
			<hr class="seperator" />
			<div>
				<?php echo $this->Form->create('Ticket',array('url'=>array('action'=>'comment',$ticket['Ticket']['id']),'class'=>'form-horizontal',
																'inputDefaults' => array('label' => false,'div' => false)));?>
					<h3><?php echo __('Reply');?></h3>	
					<?php echo $this->Form->input('Ticketcomment.description',array('class'=>'span9'));	 ?>				
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				<?php echo $this->Form->end(); ?>
			</div>	
		</div>
		<div class="span3">
			<div class="accordion" id="accordion2">
				<div class="accordion-group">
					<div class="accordion-heading">
						<span class="accordion-toggle black-heading" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
							<i class="icon-bookmark icon-white"></i> 
							<span class="divider-vertical"></span> Details 
						</span>
					</div>
					<div id="collapseOne" class="accordion-body collapse" style="height: 0px; ">
						<table class="table table-striped">
							<tbody>
								<tr>
									<td><strong><?php echo __('User'); ?></strong></td>
									<td><?php echo ife(!empty($ticket['User']['username']), h($ticket['User']['username']), 
										str_replace('@', '<wbr>@', h($ticket['Ticket']['email']))); ?>&nbsp;</td>
								</tr>
								<tr>
									<td><strong><?php echo __('Assignee'); ?></strong></td>
									<td><?php echo h($ticket['Assignee']['username']); ?>&nbsp;</td>
								</tr>
								<tr>
									<td><strong><?php  echo __('Category');  ?></strong></td>
									<td><?php echo h($ticket['Ticketcategory']['name']); ?>&nbsp;</td>
								</tr>			
								<tr>
									<td><strong><?php echo __('Status'); ?></strong></td>
									<td><?php echo $allTicketStatus[$ticket['Ticket']['ticketstatus']]; ?>&nbsp;</td>
								</tr>						
								<tr>
									<td><strong><?php echo __('Created'); ?></strong></td>
									<td><?php echo h($ticket['Ticket']['created']); ?>&nbsp;</td>
								</tr>
								<tr>
									<td><strong><?php echo __('Modified'); ?></strong></td>
									<td><?php echo h($ticket['Ticket']['modified']); ?>&nbsp;</td>
								</tr>	
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="tickets index">
	<div class="page-header">
		<h1>
			<?php echo Inflector::humanize($tickettype.'  Tickets'); ?>
			<div class="pull-right">
				<?php echo $this->Html->link(__('Add'), array('action' => 'add'), array('class'=>'btn btn-success')); ?>
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
		    Tickets
		    <span class="divider">/</span>
		</li>
		<li>
		    <?php echo Inflector::humanize($tickettype); ?>
		</li>
	</ul>
	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
	<tr>
			<th><?php echo $this->Paginator->sort('id','#'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('ticketcategory_id','Category'); ?></th>
			<th><?php echo $this->Paginator->sort('ticketstatus','Status'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('assignee_id','Assignee'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified','Updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php	foreach ($tickets as $ticket): ?>
	<tr>
		<td><?php echo h($ticket['Ticket']['id']); ?>&nbsp;</td>
		<td><?php echo h(substr($ticket['Ticket']['description'],0,30)); ?>...&nbsp;</td>
		<td><?php echo h($ticket['Ticketcategory']['name']); ?>&nbsp;</td>
		<td><?php echo $allTicketStatus[$ticket['Ticket']['ticketstatus']]; ?>&nbsp;</td>
		<td>
			<span title="<?php echo h($ticket['Ticket']['email']); ?>">
				<?php 
					if(filter_var($ticket['Ticket']['email'], FILTER_VALIDATE_EMAIL))
						echo str_replace('@', '<wbr>@', h($ticket['Ticket']['email']));
					else

					echo '<span class="label label-important">Error</span>'; 
				?>
			</span>
		</td>
		<td>
			<?php 
				echo ife(($ticket['Ticket']['assignee_id'] == 0),'<span class="label label-warning">Unassigned</span>', h($ticket['Assignee']['username'])); 
			?>
		</td>
		<td>
			<span title="<?php echo h($ticket['Ticket']['created']); ?>">
				<?php echo h(substr($ticket['Ticket']['created'],0,10)); ?>&nbsp;
			</span>
		</td>
		<td>
			<span title="<?php echo h($ticket['Ticket']['modified']); ?>">
				<?php echo h(substr($ticket['Ticket']['modified'],0,10)); ?>&nbsp;
			</span>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), 
									array('action' => 'view', $ticket['Ticket']['id']),
									array('class'=>'btn')); ?>
			<?php echo $this->Html->link(__('Edit'), 
	 								array('action' => 'edit', $ticket['Ticket']['id']),
	 								array('class'=>'btn btn-success')); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<p>
		<?php
		echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?>
	</p>

	<div class="pagination pagination-centered">
		<ul>
			<?php echo $this->Paginator->numbers(array('separator'=>'','currentClass'=>'active','tag'=>'li')); ?>
		</ul>
	</div>
</div>

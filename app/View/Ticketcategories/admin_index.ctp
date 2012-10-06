<div class="ticketcategories index">
	<div class="page-header">
		<h1>
			<?php echo __('Ticketcategories'); ?>
			<div class="pull-right">
				<?php echo $this->Html->link(__('Add'), 
								array('action' => 'add'),
								array('class'=>'btn btn-success')); ?>
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
		    Ticketcategory
		</li>
	</ul>
	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
	<tr>
			<th><?php echo $this->Paginator->sort('id','#'); ?></th>
			<th width="30%"><?php echo $this->Paginator->sort('name'); ?></th>
			<th width="30%"><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php	foreach ($ticketcategories as $ticketcategory): ?>
	<tr>
		<td><?php echo h($ticketcategory['Ticketcategory']['id']); ?>&nbsp;</td>
		<td><?php echo h($ticketcategory['Ticketcategory']['name']); ?>&nbsp;</td>
		<td><?php echo $ticketcategory['ParentTicketcategory']['name']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), 
									array('controller'=>'ticket','action' => 'index', $ticketcategory['Ticketcategory']['id']),
									array('class'=>'btn')); ?>
			<?php echo $this->Html->link(__('Edit'), 
	 								array('action' => 'edit', $ticketcategory['Ticketcategory']['id']),
	 								array('class'=>'btn btn-success')); ?>
			<?php echo $this->Form->postLink(__('Delete'), 
		 							array('action' => 'delete', $ticketcategory['Ticketcategory']['id']), 
		 							array('class'=>'btn btn-danger'), 
		 							__('Are you sure you want to delete # %s?', $ticketcategory['Ticketcategory']['id'])); ?>
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

<div class="configurations index">
	<div class="page-header">
		<h1>
			<?php echo __('Configurations'); ?>
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
		    Configuration
		</li>
	</ul>
	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('value'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('allowedvalues'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php	foreach ($configurations as $configuration): ?>
	<tr>
		<td><?php echo h($configuration['Configuration']['id']); ?>&nbsp;</td>
		<td><?php echo h($configuration['Configuration']['name']); ?>&nbsp;</td>
		<td><?php echo h($configuration['Configuration']['code']); ?>&nbsp;</td>
		<td><?php echo h($configuration['Configuration']['value']); ?>&nbsp;</td>
		<td><?php echo h($configuration['Configuration']['type']); ?>&nbsp;</td>
		<td><?php echo h($configuration['Configuration']['allowedvalues']); ?>&nbsp;</td>
		<td title="<?php echo h($configuration['Configuration']['created']); ?>">
			<?php echo h(substr($configuration['Configuration']['created'],0,10)); ?>
		</td>
		<td title="<?php echo h($configuration['Configuration']['modified']); ?>">
			<?php echo h(substr($configuration['Configuration']['modified'],0,10)); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), 
	 								array('action' => 'edit', $configuration['Configuration']['id']),
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
